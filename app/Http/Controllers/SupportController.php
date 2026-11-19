<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Throwable;

class SupportController extends Controller
{
    public function create()
    {
        $payments = collect(config('support.payments', []))
            ->map(function ($payment, $key) {
                return (object) [
                    'id' => $key,
                    'name' => $payment['label'] ?? $key,
                    'account_number' => $payment['account_number'] ?? '',
                    'account_name' => $payment['account_name'] ?? '',
                    'description' => $payment['description'] ?? '',
                ];
            });

        return view('supports.create', compact('payments'));
    }

    public function store(Request $request)
    {
        $paymentOptions = config('support.payments', []);

        $isSponsorship = $request->input('type') === 'sponsorship';

        $validated = $request->validate([
            'is_anonymous' => [
                'nullable',
                'boolean',
            ],

            'donor_name' => [
                Rule::requiredIf(!$request->boolean('is_anonymous')),
                'nullable',
                'string',
                'max:100',
            ],

            'origin_rantau' => [
                'required',
                'string',
                'max:150',
            ],

            'type' => [
                'required',
                Rule::in(['barang', 'sponsorship']),
            ],

            'item_details' => [
                'required',
                'string',
                'max:2000',
            ],

            'payment_method' => [
                Rule::requiredIf($isSponsorship),
                'nullable',
                Rule::in(array_keys($paymentOptions)),
            ],

            'transfer_amount' => [
                Rule::requiredIf($isSponsorship),
                'nullable',
                'integer',
                'min:1000',
                'max:1000000000',
            ],

            'proof' => [
                Rule::requiredIf($isSponsorship),
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'message' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ], [
            'donor_name.required' => 'Nama pendukung wajib diisi jika tidak memilih anonim.',
            'origin_rantau.required' => 'Asal daerah wajib diisi.',
            'type.required' => 'Jenis dukungan wajib dipilih.',
            'item_details.required' => 'Detail dukungan wajib diisi.',
            'payment_method.required' => 'Metode pembayaran wajib dipilih.',
            'payment_method.in' => 'Metode pembayaran tidak valid.',
            'transfer_amount.required' => 'Nominal transfer wajib diisi.',
            'transfer_amount.min' => 'Nominal transfer minimal Rp1.000.',
            'proof.required' => 'Bukti transfer wajib diunggah.',
            'proof.image' => 'Bukti transfer harus berupa gambar.',
            'proof.max' => 'Ukuran bukti transfer maksimal 5 MB.',
        ]);

        $proofPath = null;

        try {
            if ($isSponsorship && $request->hasFile('proof')) {
                $proofPath = $request->file('proof')
                    ->store('supports', 'public');

                if (!$proofPath) {
                    return back()
                        ->withInput()
                        ->withErrors([
                            'proof' => 'Bukti transfer gagal disimpan.',
                        ]);
                }
            }

            $support = Support::create([
                'is_anonymous' => $request->boolean('is_anonymous'),

                'donor_name' => $request->boolean('is_anonymous')
                    ? null
                    : $validated['donor_name'],

                'origin_rantau' => $validated['origin_rantau'],
                'type' => $validated['type'],
                'item_details' => $validated['item_details'],

                'payment_method' => $isSponsorship
                    ? $validated['payment_method']
                    : null,

                'transfer_amount' => $isSponsorship
                    ? $validated['transfer_amount']
                    : null,

                'proof_path' => $proofPath,

                'message' => $validated['message'] ?? null,

                'status' => 'MENUNGGU_VERIFIKASI',
            ]);

            $paymentLabel = $isSponsorship
                ? ($paymentOptions[$support->payment_method]['label']
                    ?? $support->payment_method)
                : 'Tidak menggunakan pembayaran';

            $donorName = $support->is_anonymous
                ? 'Pendukung Anonim'
                : $support->donor_name;

            $message = implode("\n", [
                '*KONFIRMASI DUKUNGAN SIGAP MUARA*',
                '',
                'ID Dukungan: #' . $support->id,
                'Nama: ' . $donorName,
                'Asal: ' . $support->origin_rantau,
                'Jenis: ' . ucfirst($support->type),
                'Metode Pembayaran: ' . $paymentLabel,
                'Nominal: ' . (
                    $isSponsorship
                        ? 'Rp' . number_format(
                            $support->transfer_amount,
                            0,
                            ',',
                            '.'
                        )
                        : '-'
                ),
                'Detail: ' . $support->item_details,
                '',
                'Saya sudah mengisi formulir dukungan melalui website SIGAP Kecamatan Muara. Mohon dilakukan pemeriksaan.',
            ]);

            $whatsappNumber = preg_replace(
                '/[^0-9]/',
                '',
                (string) config('support.whatsapp_number')
            );

            if ($whatsappNumber !== '' && str_starts_with($whatsappNumber, '0')) {
                $whatsappNumber = '62' . substr($whatsappNumber, 1);
            }

            $whatsappUrl = $whatsappNumber
                ? 'https://wa.me/' . $whatsappNumber
                    . '?text=' . urlencode($message)
                : null;

            return redirect()
                ->route('supports.create')
                ->with(
                    'success',
                    'Dukungan berhasil dikirim dan sedang menunggu verifikasi admin.'
                )
                ->with('whatsapp_url', $whatsappUrl);

        } catch (Throwable $e) {
            if ($proofPath && Storage::disk('public')->exists($proofPath)) {
                Storage::disk('public')->delete($proofPath);
            }

            report($e);

            return back()
                ->withInput()
                ->withErrors([
                    'general' => 'Terjadi kesalahan saat menyimpan dukungan. Silakan coba kembali.',
                ]);
        }
    }

    public function summary()
    {
        $supports = Support::whereIn('status', [
            'TERVERIFIKASI',
            'DIGUNAKAN',
            'DITUTUP',
        ])
            ->latest()
            ->get();

        return view('supports.summary', compact('supports'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ReportController extends Controller
{
    /**
     * Menampilkan halaman formulir laporan.
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Menyimpan laporan baru.
     */
    public function store(Request $request)
    {
        $request->merge([
            'is_anonymous' => $request->boolean('is_anonymous'),
        ]);

        // Validasi data laporan.
        $validated = $request->validate([
            'is_anonymous' => 'required|boolean',

            'reporter_name' => 'required_if:is_anonymous,0|nullable|string|max:255',
            'reporter_phone' => 'required_if:is_anonymous,0|nullable|string|max:20',

            'location_name' => 'required|string|max:255',
            'address_details' => 'required|string|max:2000',

            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',

            'density_level' => 'required|in:ringan,sedang,berat',

            'impacts' => 'nullable|array',
            'impacts.*' => 'string|in:perahu,nelayan,bau,lingkungan',

            'photo' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',

            'notes' => 'nullable|string|max:5000',
        ]);

        $photoPath = null;

        try {
            /*
             * UPLOAD FOTO
             *
             * Laravel membuat nama file secara otomatis.
             * Hasil store() langsung disimpan ke variabel photoPath.
             */
            if (!$request->hasFile('photo')) {
                throw ValidationException::withMessages([
                    'photo' => 'Foto laporan wajib diunggah.',
                ]);
            }

            $photoPath = $request->file('photo')->store(
                'reports',
                'public'
            );

            // Pastikan path foto berhasil dibuat.
            if (
                !$photoPath ||
                !Storage::disk('public')->exists($photoPath)
            ) {
                throw new \RuntimeException(
                    'Foto gagal disimpan ke storage.'
                );
            }

            /*
             * SIMPAN DATA LAPORAN
             */
            $report = DB::transaction(function () use (
                $validated,
                $photoPath
            ) {
                $year = now()->year;

                $lastReport = Report::whereYear('created_at', $year)
                    ->orderByDesc('id')
                    ->lockForUpdate()
                    ->first();

                $nextNumber = $lastReport
                    ? ((int) substr($lastReport->ticket_number, -4)) + 1
                    : 1;

                $ticketNumber = 'SM-' . $year . '-' .
                    str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

                $report = Report::create([
                    'ticket_number' => $ticketNumber,

                    'is_anonymous' => $validated['is_anonymous'],

                    'reporter_name' => $validated['is_anonymous']
                        ? null
                        : $validated['reporter_name'],

                    'reporter_phone' => $validated['is_anonymous']
                        ? null
                        : $validated['reporter_phone'],

                    // Simpan path asli hasil Storage.
                    'photo_path' => $photoPath,

                    // Simpan koordinat sesuai input.
                    'latitude' => $validated['latitude'] ?? null,
                    'longitude' => $validated['longitude'] ?? null,

                    'location_name' => $validated['location_name'],
                    'address_details' => $validated['address_details'],

                    'density_level' => $validated['density_level'],

                    'impacts' => $validated['impacts'] ?? [],

                    'notes' => $validated['notes'] ?? null,

                    'status' => 'BARU',
                ]);

                // Buat riwayat status pertama.
                $report->statusHistories()->create([
                    'status' => 'BARU',
                    'description' => 'Laporan berhasil dikirim dan menunggu verifikasi.',
                ]);

                return $report;
            });

            return redirect()
                ->route('reports.success', $report->ticket_number);

        } catch (\Throwable $e) {

            /*
             * Jika penyimpanan database gagal,
             * hapus foto yang sudah terlanjur diunggah.
             */
            if ($photoPath) {
                Storage::disk('public')->delete($photoPath);
            }

            Log::error('Gagal menyimpan laporan SIGAP MUARA', [
                'error' => $e->getMessage(),
            ]);

            return back()
                ->withInput()
                ->with('error', 'Laporan gagal disimpan. Silakan coba kembali.');
        }
    }

    /**
     * Halaman sukses setelah mengirim laporan.
     */
    public function success($ticket_number)
    {
        $report = Report::where('ticket_number', $ticket_number)
            ->firstOrFail();

        return view('reports.success', compact('report'));
    }

    /**
     * Halaman utama pelacakan laporan.
     */
    public function trackForm(Request $request)
    {
        if ($request->filled('ticket')) {
            $ticket = strtoupper(trim($request->ticket));

            return redirect()->route(
                'reports.track.result',
                $ticket
            );
        }

        $reportTickets = Report::select('id', 'ticket_number')
            ->latest('created_at')
            ->paginate(10, ['*'], 'tickets_page');

        $completedReports = Report::where('status', 'SELESAI')
            ->latest('updated_at')
            ->take(5)
            ->get();

        return view('reports.track-form', compact(
            'reportTickets',
            'completedReports'
        ));
    }

    /**
     * Detail laporan berdasarkan nomor tiket.
     */
    public function trackResult($ticket_number)
    {
        $report = Report::with([
            'statusHistories',
            'comments',
        ])
            ->where('ticket_number', strtoupper(trim($ticket_number)))
            ->first();

        if (!$report) {
            return redirect()
                ->route('reports.track')
                ->with(
                    'error',
                    'Nomor tiket tidak ditemukan. Silakan periksa kembali.'
                );
        }

        // Periksa apakah foto tersedia di storage.
        $report->photo_exists = $report->photo_path
            ? Storage::disk('public')->exists($report->photo_path)
            : false;

        // URL foto untuk tampilan Blade.
        $report->photo_url = $report->photo_exists
            ? asset('storage/' . $report->photo_path)
            : null;

        return view('reports.track-result', compact('report'));
    }

    /**
     * Mencari laporan berdasarkan nomor HP.
     */
    public function trackByPhone(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
        ]);

        $phone = trim($validated['phone']);

        $reports = Report::where('reporter_phone', $phone)
            ->orderByDesc('created_at')
            ->get();

        if ($reports->isEmpty()) {
            return redirect()
                ->route('reports.track')
                ->with(
                    'error',
                    'Tidak ada laporan yang terdaftar dengan Nomor HP tersebut.'
                );
        }

        if ($reports->count() === 1) {
            return redirect()->route(
                'reports.track.result',
                $reports->first()->ticket_number
            );
        }

        return view('reports.track-history', compact(
            'reports',
            'phone'
        ));
    }

    /**
     * Menyimpan komentar dari warga.
     */
    public function storeComment(Request $request, $ticket_number)
    {
        $validated = $request->validate([
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:2000',
        ]);

        $report = Report::where('ticket_number', $ticket_number)
            ->firstOrFail();

        // Verifikasi nomor HP pelapor.
        if (
            $report->is_anonymous ||
            !hash_equals(
                (string) $report->reporter_phone,
                trim((string) $validated['phone'])
            )
        ) {
            return back()
                ->withInput()
                ->with('error', 'Verifikasi nomor HP tidak berhasil.');
        }

        $report->comments()->create([
            'sender_type' => 'WARGA',
            'sender_name' => $report->reporter_name,
            'message' => $validated['message'],
        ]);

        return redirect()
            ->route('reports.track.result', $ticket_number)
            ->with('success', 'Komentar berhasil dikirim.');
    }
}

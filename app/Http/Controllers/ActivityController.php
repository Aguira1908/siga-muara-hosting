<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ActivityController extends Controller
{
    /**
     * Halaman daftar kegiatan publik.
     */
    public function index()
    {
        $activities = Activity::where('status', 'published')
            ->withCount('volunteers')
            ->orderBy('date', 'asc')
            ->get();

        return view('activities.index', compact('activities'));
    }

    /**
     * Halaman detail kegiatan.
     */
    public function show($id)
    {
        $activity = Activity::where('status', 'published')
            ->withCount('volunteers')
            ->findOrFail($id);

        return view('activities.show', compact('activity'));
    }

    /**
     * Proses pendaftaran relawan.
     */
    public function register(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',

            'phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9+\-\s]+$/',
            ],

            'origin' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:13|max:120',

            'role' => 'required|in:pengangkut,pencatat,dokumentasi,logistik,alat',

            'health_statement' => 'accepted',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'phone.required' => 'Nomor HP wajib diisi.',
            'phone.regex' => 'Format nomor HP tidak valid.',
            'age.integer' => 'Usia harus berupa angka.',
            'age.min' => 'Usia minimal pendaftaran adalah 13 tahun.',
            'age.max' => 'Usia tidak valid.',
            'role.required' => 'Silakan pilih peran relawan.',
            'role.in' => 'Pilihan peran relawan tidak valid.',
            'health_statement.accepted' => 'Anda harus menyetujui pernyataan keselamatan.',
        ]);

        DB::transaction(function () use ($validated, $id) {

            // Mengunci kegiatan agar kuota tidak terlampaui
            // ketika beberapa orang mendaftar bersamaan.
            $activity = Activity::where('status', 'published')
                ->lockForUpdate()
                ->findOrFail($id);

            // Menutup pendaftaran jika tanggal kegiatan sudah lewat.
            if ($activity->date < now()->toDateString()) {
                throw ValidationException::withMessages([
                    'activity' => 'Pendaftaran ditutup karena kegiatan sudah melewati tanggal pelaksanaan.',
                ]);
            }

            // Status yang masih menggunakan kuota.
            $registered = $activity->volunteers()
                ->whereIn('status', [
                    'MENDAFTAR',
                    'DIKONFIRMASI',
                    'HADIR',
                    'SELESAI',
                ])
                ->count();

            $quota = (int) $activity->volunteer_needed;

            if ($quota <= 0 || $registered >= $quota) {
                throw ValidationException::withMessages([
                    'activity' => 'Mohon maaf, kuota relawan kegiatan ini sudah penuh.',
                ]);
            }

            // Mencegah nomor HP mendaftar berulang kali.
            // Pendaftaran yang sudah ditolak tidak menghalangi pendaftaran ulang.
            $alreadyRegistered = $activity->volunteers()
                ->where('phone', $validated['phone'])
                ->where('status', '!=', 'DITOLAK')
                ->exists();

            if ($alreadyRegistered) {
                throw ValidationException::withMessages([
                    'phone' => 'Nomor HP ini sudah terdaftar pada kegiatan tersebut.',
                ]);
            }

            // Menyimpan pendaftaran relawan.
            $activity->volunteers()->create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'origin' => $validated['origin'] ?? null,
                'age' => $validated['age'] ?? null,
                'role' => $validated['role'],
                'health_statement' => true,
                'status' => 'MENDAFTAR',
            ]);
        });

        return redirect()
            ->route('activities.show', $id)
            ->with(
                'success',
                'Pendaftaran berhasil! Operator akan menghubungi Anda melalui WhatsApp atau telepon.'
            );
    }
}

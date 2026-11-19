<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Report;
use App\Models\Support;

/**
 * Controller halaman beranda.
 * Menyiapkan data ringkas untuk ditampilkan di beranda:
 * statistik, kegiatan terdekat, laporan, dan dukungan terverifikasi.
 *
 * Letakkan di: app/Http/Controllers/HomeController.php
 *
 * Catatan: sesuaikan nama model (Activity, Report, Support) dan nama view
 * ('beranda') dengan yang dipakai di proyek Anda.
 */
class HomeController extends Controller
{
    public function index()
    {
        // Status relawan yang dihitung sebagai "terdaftar aktif" (sama seperti halaman Kegiatan)
        $activeVolunteerStatuses = ['MENDAFTAR', 'DIKONFIRMASI', 'HADIR', 'SELESAI'];

        // Status dukungan yang boleh tampil ke publik (sudah diverifikasi admin)
        $publicSupportStatuses = ['TERVERIFIKASI', 'DIGUNAKAN', 'DITUTUP'];

        // 3 kegiatan terdekat yang sudah dipublikasikan dan belum lewat tanggalnya
        $upcomingActivities = Activity::where('status', 'published')
            ->whereDate('date', '>=', now()->toDateString())
            ->withCount([
                'volunteers as active_volunteers_count' => fn ($q) => $q->whereIn('status', $activeVolunteerStatuses),
            ])
            ->orderBy('date')
            ->orderBy('time')
            ->take(3)
            ->get();

        // 2 laporan yang sudah selesai ditangani (terbaru lebih dulu)
        $completedReports = Report::where('status', 'SELESAI')
            ->latest('updated_at')
            ->take(2)
            ->get();

        // 5 laporan terbaru yang masuk (hanya tiket, lokasi, dan status yang ditampilkan)
        $latestReports = Report::latest()
            ->take(5)
            ->get();

        // 3 dukungan terverifikasi terbaru
        $supports = Support::whereIn('status', $publicSupportStatuses)
            ->latest()
            ->take(3)
            ->get();

        // Angka ringkasan di bagian atas beranda
        $stats = [
            'reports'    => Report::count(),
            'done'       => Report::where('status', 'SELESAI')->count(),
            'activities' => Activity::whereIn('status', ['published', 'done'])->count(),
            'volunteers' => Activity::withCount('volunteers')->get()->sum('volunteers_count'),
        ];

        return view('home', compact(
            'upcomingActivities',
            'completedReports',
            'latestReports',
            'supports',
            'stats'
        ));
    }
}
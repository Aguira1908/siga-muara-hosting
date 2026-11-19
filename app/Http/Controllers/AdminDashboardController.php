<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use App\Models\Report;
use App\Models\Activity;
use App\Models\Support;
use App\Models\VolunteerRegistration;
use App\Models\PaymentMethod;
class AdminDashboardController extends Controller
{
    // ==========================================
    // 1. DASHBOARD LAPORAN
    // ==========================================

    public function index()
    {
        $reports = Report::with([
            'comments',
            'statusHistories'
        ])
        ->orderBy('created_at', 'desc')
        ->get();

        return view('admin.dashboard', compact('reports'));
    }

    // ==========================================
    // 2. UPDATE STATUS LAPORAN
    // ==========================================

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:BARU,DIVERIFIKASI,DIJADWALKAN,DITANGANI,SELESAI,DITOLAK,DITUNDA,BUTUH_DUKUNGAN',
        ]);

        $report = Report::findOrFail($id);

        if ($report->status !== $validated['status']) {
            $report->update([
                'status' => $validated['status']
            ]);

            $report->statusHistories()->create([
                'status' => $validated['status'],
                'description' => 'Status laporan diperbarui oleh admin.',
            ]);
        }

        return back()->with(
            'success',
            'Status laporan berhasil diperbarui!'
        );
    }

    // ==========================================
    // 3. HAPUS LAPORAN
    // ==========================================

    public function destroyReport($id)
    {
        $report = Report::findOrFail($id);

        if (
            $report->photo_path &&
            Storage::disk('public')->exists($report->photo_path)
        ) {
            Storage::disk('public')->delete($report->photo_path);
        }

        $report->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('success', 'Laporan berhasil dihapus!');
    }

    // ==========================================
    // 4. DAFTAR KEGIATAN DAN RELAWAN
    // ==========================================

    public function activities()
    {
        $activities = Activity::with('volunteers')
            ->withCount('volunteers')
            ->orderBy('date', 'desc')
            ->get();

        return view('admin.activities', compact('activities'));
    }

    // ==========================================
    // 5. FORM TAMBAH KEGIATAN
    // ==========================================

    public function createActivity()
    {
        return view('admin.activities-create');
    }

    // ==========================================
    // 6. SIMPAN KEGIATAN
    // ==========================================

    public function storeActivity(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'meeting_point' => 'required|string|max:255',
            'volunteer_needed' => 'required|integer|min:0',
            'pic_name' => 'required|string|max:255',
            'pic_phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9+\-\s]+$/',
            ],
            'safety_notes' => 'nullable|string',
            'status' => 'required|in:draft,published,done,cancelled',
        ]);

        Activity::create($validated);

        return redirect()
            ->route('admin.activities')
            ->with('success', 'Kegiatan berhasil ditambahkan!');
    }

    // ==========================================
    // 7. FORM EDIT KEGIATAN
    // ==========================================

    public function editActivity($id)
    {
        $activity = Activity::findOrFail($id);

        return view('admin.activities-edit', compact('activity'));
    }

    // ==========================================
    // 8. UPDATE KEGIATAN
    // ==========================================

    public function updateActivity(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location_name' => 'required|string|max:255',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'meeting_point' => 'required|string|max:255',
            'volunteer_needed' => 'required|integer|min:0',
            'pic_name' => 'required|string|max:255',
            'pic_phone' => [
                'required',
                'string',
                'max:20',
                'regex:/^[0-9+\-\s]+$/',
            ],
            'safety_notes' => 'nullable|string',
            'status' => 'required|in:draft,published,done,cancelled',
        ]);

        $activity = Activity::findOrFail($id);

        $activeVolunteers = $activity->volunteers()
            ->whereIn('status', [
                'MENDAFTAR',
                'DIKONFIRMASI',
                'HADIR',
                'SELESAI',
            ])
            ->count();

        if ($validated['volunteer_needed'] < $activeVolunteers) {
            return back()
                ->withInput()
                ->withErrors([
                    'volunteer_needed' =>
                        'Kuota tidak boleh lebih kecil dari jumlah relawan yang sudah terdaftar dan masih menggunakan kuota (' .
                        $activeVolunteers . ' orang).'
                ]);
        }

        $activity->update($validated);

        return redirect()
            ->route('admin.activities')
            ->with('success', 'Kegiatan berhasil diperbarui!');
    }

    // ==========================================
    // 9. HAPUS KEGIATAN
    // ==========================================

    public function destroyActivity($id)
    {
        $activity = Activity::findOrFail($id);

        $activity->delete();

        return redirect()
            ->route('admin.activities')
            ->with('success', 'Kegiatan berhasil dihapus!');
    }

    // ==========================================
    // 10. UPDATE STATUS RELAWAN
    // ==========================================

    public function updateVolunteerStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:MENDAFTAR,DIKONFIRMASI,HADIR,SELESAI,DAFTAR_TUNGGU,TIDAK_HADIR,DITOLAK',
        ]);

        DB::transaction(function () use ($validated, $id) {

            $volunteer = VolunteerRegistration::findOrFail($id);

            $activity = Activity::lockForUpdate()
                ->findOrFail($volunteer->activity_id);

            $quotaStatuses = [
                'MENDAFTAR',
                'DIKONFIRMASI',
                'HADIR',
                'SELESAI',
            ];

            $oldStatusUsesQuota = in_array(
                $volunteer->status,
                $quotaStatuses,
                true
            );

            $newStatusUsesQuota = in_array(
                $validated['status'],
                $quotaStatuses,
                true
            );

            if (!$oldStatusUsesQuota && $newStatusUsesQuota) {

                $registered = $activity->volunteers()
                    ->whereIn('status', $quotaStatuses)
                    ->count();

                if (
                    $activity->volunteer_needed <= 0 ||
                    $registered >= $activity->volunteer_needed
                ) {
                    throw ValidationException::withMessages([
                        'status' =>
                            'Kuota kegiatan sudah penuh. Relawan tidak dapat dipindahkan ke status tersebut.'
                    ]);
                }
            }

            $volunteer->update([
                'status' => $validated['status']
            ]);
        });

        return back()->with(
            'success',
            'Status relawan berhasil diperbarui!'
        );
    }

    // ==========================================
    // 11. DATA DUKUNGAN
    // ==========================================

   public function supports()
{
    $supports = Support::orderBy('created_at', 'desc')->get();

    $paymentMethods = PaymentMethod::all()->keyBy('id');

    return view('admin.supports', compact(
        'supports',
        'paymentMethods'
    ));
}

    // ==========================================
    // 12. UPDATE STATUS DUKUNGAN
    // ==========================================

    public function updateSupportStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:MENUNGGU_VERIFIKASI,TERVERIFIKASI,DIGUNAKAN,DITUTUP,DITOLAK',
            ],
        ]);

        $support = Support::findOrFail($id);

        // Periksa bukti transfer sebelum verifikasi.
        if (
            $validated['status'] === 'TERVERIFIKASI' &&
            (
                !$support->proof_path ||
                !Storage::disk('public')->exists($support->proof_path)
            )
        ) {
            return back()->withErrors([
                'status' => 'Dukungan tidak dapat diverifikasi karena bukti transfer tidak tersedia.',
            ]);
        }

        $support->update([
            'status' => $validated['status'],
        ]);

        $statusLabel = str_replace('_', ' ', $validated['status']);

        return back()->with(
            'success',
            'Status dukungan #' . $support->id . ' berhasil diubah menjadi ' . $statusLabel . '!'
        );

        
    }

    // ==========================================
    // 13. HAPUS DUKUNGAN
    // ==========================================

    public function destroySupport($id)
    {
        $support = Support::findOrFail($id);

        if (
            $support->proof_path &&
            Storage::disk('public')->exists($support->proof_path)
        ) {
            Storage::disk('public')->delete($support->proof_path);
        }

        $support->delete();

        return redirect()
            ->route('admin.supports')
            ->with('success', 'Data dukungan berhasil dihapus!');
    }

    // ==========================================
    // 14. ADMIN MEMBALAS KOMENTAR
    // ==========================================

    public function replyComment(Request $request, $id)
    {
        $validated = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $report = Report::findOrFail($id);

        $report->comments()->create([
            'sender_type' => 'ADMIN',
            'sender_name' => auth()->user()->name ?? 'Admin',
            'message' => $validated['message'],
            'user_id' => auth()->id(),
        ]);

        return back()->with(
            'success',
            'Balasan berhasil dikirim kepada warga!'
        );
    }
}

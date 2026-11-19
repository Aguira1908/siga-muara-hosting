
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Warga — SIGAP KECAMATAN MUARA Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #10B981;
            --dark-green: #064E3B;
        }

        body {
            background: linear-gradient(135deg, #ECFDF5, #D1FAE5);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #064E3B, #0F766E);
            box-shadow: 0 4px 15px rgba(6,78,59,.2);
        }

        .glass-card {
            background: rgba(255,255,255,.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.5);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(16,185,129,.1);
            overflow: hidden;
        }

        .table thead th {
            background: #F0FDF4;
            color: var(--dark-green);
            text-transform: uppercase;
            font-size: .8rem;
            letter-spacing: .5px;
            border-bottom: 2px solid #D1FAE5;
            padding: 15px;
        }

        .table tbody tr:hover {
            background: #F8FAFC;
        }

        .btn-custom {
            background: var(--primary-green);
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background: var(--dark-green);
            color: white;
        }

        .chat-warga {
            background: #F0FDF4;
            border: 1px solid #D1FAE5;
            border-radius: 14px 14px 14px 3px;
        }

        .chat-admin {
            background: #E0F2FE;
            border: 1px solid #BAE6FD;
            border-radius: 14px 14px 3px 14px;
        }

        .history-item {
            border-left: 3px solid #10B981;
            padding-left: 15px;
            margin-bottom: 15px;
        }

        /* TOMBOL LIHAT FOTO */
        .btn-photo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            padding: 7px 14px;
            border: 1px solid #10B981;
            border-radius: 50px;
            background: white;
            color: #059669;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: .2s;
        }

        .btn-photo:hover {
            background: #10B981;
            color: white;
            transform: translateY(-2px);
        }

        .photo-unavailable {
            color: #9CA3AF;
            font-size: 13px;
        }

        @media(max-width:768px) {
            .navbar-custom .container-fluid {
                gap: 10px;
            }

            .navbar-brand {
                font-size: 15px !important;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand navbar-dark navbar-custom px-3 px-md-4 py-3 mb-4 sticky-top">
    <div class="container-fluid">

        <a class="navbar-brand fw-bold fs-5" href="/">
            <i class="bi bi-shield-check me-2 text-warning"></i>SIGAP Admin
        </a>

        <div class="d-flex ms-auto gap-2 flex-wrap justify-content-center">

            <a href="{{ route('admin.dashboard') }}"
               class="btn {{ request()->routeIs('admin.dashboard') ? 'btn-light text-success fw-bold' : 'btn-outline-light' }} btn-sm">
                <i class="bi bi-file-earmark-text me-1"></i>Laporan
            </a>

            <a href="{{ route('admin.activities') }}"
               class="btn {{ request()->routeIs('admin.activities') ? 'btn-light text-success fw-bold' : 'btn-outline-light' }} btn-sm">
                <i class="bi bi-people me-1"></i>Relawan
            </a>

            <a href="{{ route('admin.supports') }}"
               class="btn {{ request()->routeIs('admin.supports') ? 'btn-light text-success fw-bold' : 'btn-outline-light' }} btn-sm">
                <i class="bi bi-box2-heart me-1"></i>Dukungan
            </a>

            <a href="{{ route('admin.galeri.index') }}"
               class="btn {{ request()->routeIs('admin.galeri.index') ? 'btn-light text-success fw-bold' : 'btn-outline-light' }} btn-sm">
                <i class="bi bi-images me-1"></i>Galeri
            </a>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i>Logout
                </button>
            </form>

        </div>
    </div>
</nav>

<!-- KONTEN DASHBOARD -->
<div class="container-fluid px-3 px-md-4 pb-5">

    <h4 class="mb-4 fw-bold" style="color:var(--dark-green);">
        <i class="bi bi-inbox-fill me-2"></i>Laporan Masuk Warga
    </h4>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger rounded-4">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- TABEL LAPORAN -->
    <div class="glass-card">
        <div class="table-responsive">

            <table class="table table-hover mb-0 text-nowrap align-middle">

                <thead>
                    <tr>
                        <th class="ps-4">Tiket</th>
                        <th>Pelapor</th>
                        <th>Lokasi</th>
                        <th>Foto</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Komentar</th>
                        <th>Riwayat</th>
                        <th class="pe-4 text-end">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($reports as $r)

                        <tr>

                            <!-- NOMOR TIKET -->
                            <td class="ps-4 fw-bold text-success">
                                {{ $r->ticket_number }}
                            </td>

                            <!-- PELAPOR -->
                            <td>
                                {{ $r->is_anonymous ? 'Anonim' : ($r->reporter_name ?? 'Tidak dicantumkan') }}
                            </td>

                            <!-- LOKASI -->
                            <td>
                                <div class="fw-bold text-dark">
                                    {{ $r->location_name }}
                                </div>

                                <small class="text-muted">
                                    {{ $r->latitude ?? '-' }},
                                    {{ $r->longitude ?? '-' }}
                                </small>
                            </td>

                            <!-- FOTO LAPORAN -->
                            <td>
                                @if($r->photo_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($r->photo_path))

                                    <a href="{{ asset('storage/' . $r->photo_path) }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="btn-photo">

                                        <i class="bi bi-image"></i>
                                        Lihat

                                    </a>

                                @else

                                    <span class="photo-unavailable">
                                        <i class="bi bi-image me-1"></i>
                                        Tidak tersedia
                                    </span>

                                @endif
                            </td>

                            <!-- DESKRIPSI -->
                            <td style="max-width:220px; white-space:normal;">
                                {{ \Illuminate\Support\Str::limit($r->notes ?? '-', 70) }}
                            </td>

                            <!-- STATUS -->
                            <td>
                                @php
                                    $badgeColor = match($r->status) {
                                        'BARU' => 'primary',
                                        'DIVERIFIKASI' => 'warning text-dark',
                                        'DIJADWALKAN', 'DITANGANI' => 'info text-dark',
                                        'SELESAI' => 'success',
                                        'DITOLAK' => 'danger',
                                        'DITUNDA' => 'secondary',
                                        'BUTUH_DUKUNGAN' => 'warning text-dark',
                                        default => 'secondary'
                                    };
                                @endphp

                                <span class="badge bg-{{ $badgeColor }} rounded-pill px-3 py-2">
                                    {{ str_replace('_', ' ', $r->status) }}
                                </span>
                            </td>

                            <!-- KOMENTAR -->
                            <td>
                                <button class="btn btn-sm btn-outline-success rounded-pill"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#diskusi{{ $r->id }}">
                                    <i class="bi bi-chat-dots me-1"></i>
                                    {{ $r->comments->count() }}
                                </button>
                            </td>

                            <!-- RIWAYAT -->
                            <td>
                                <button class="btn btn-sm btn-outline-primary rounded-pill"
                                        type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#riwayat{{ $r->id }}">
                                    <i class="bi bi-clock-history me-1"></i>
                                    {{ $r->statusHistories->count() }}
                                </button>
                            </td>

                            <!-- AKSI -->
                            <td class="pe-4 text-end">

                                <div class="d-flex justify-content-end align-items-center gap-2">

                                    <!-- UPDATE STATUS -->
                                    <form action="{{ route('admin.reports.update-status', $r->id) }}"
                                          method="POST"
                                          class="d-flex gap-2 m-0">

                                        @csrf

                                        <select name="status"
                                                class="form-select form-select-sm"
                                                style="width:155px;">

                                            @foreach([
                                                'BARU' => 'Baru',
                                                'DIVERIFIKASI' => 'Diverifikasi',
                                                'DIJADWALKAN' => 'Dijadwalkan',
                                                'DITANGANI' => 'Ditangani',
                                                'SELESAI' => 'Selesai',
                                                'DITOLAK' => 'Ditolak',
                                                'DITUNDA' => 'Ditunda',
                                                'BUTUH_DUKUNGAN' => 'Butuh Dukungan'
                                            ] as $value => $label)

                                                <option value="{{ $value }}"
                                                    {{ $r->status === $value ? 'selected' : '' }}>
                                                    {{ $label }}
                                                </option>

                                            @endforeach

                                        </select>

                                        <button type="submit"
                                                class="btn btn-sm btn-custom"
                                                title="Perbarui status">
                                            <i class="bi bi-arrow-repeat"></i>
                                        </button>

                                    </form>

                                    <!-- HAPUS LAPORAN -->
                                    <form action="{{ route('admin.reports.destroy', $r->id) }}"
                                          method="POST"
                                          class="m-0"
                                          onsubmit="return confirm('Yakin ingin menghapus laporan ini secara permanen?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                title="Hapus laporan">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                        <!-- RIWAYAT STATUS -->
                        <tr class="border-0">
                            <td colspan="9" class="p-0 border-0">

                                <div class="collapse" id="riwayat{{ $r->id }}">
                                    <div class="p-4 bg-light border-top">

                                        <h6 class="fw-bold text-primary mb-3">
                                            <i class="bi bi-clock-history me-2"></i>
                                            Riwayat Status {{ $r->ticket_number }}
                                        </h6>

                                        @forelse($r->statusHistories as $history)

                                            <div class="history-item">

                                                <div class="fw-bold">
                                                    {{ str_replace('_', ' ', $history->status) }}
                                                </div>

                                                <div class="text-muted small">
                                                    {{ $history->description ?? 'Tidak ada keterangan.' }}
                                                </div>

                                                <small class="text-muted">
                                                    {{ $history->created_at->format('d M Y, H:i') }}
                                                </small>

                                            </div>

                                        @empty

                                            <p class="text-muted mb-0">
                                                Belum ada riwayat status.
                                            </p>

                                        @endforelse

                                    </div>
                                </div>

                            </td>
                        </tr>

                        <!-- AREA DISKUSI -->
                        <tr class="border-0">
                            <td colspan="9" class="p-0 border-0">

                                <div class="collapse" id="diskusi{{ $r->id }}">
                                    <div class="p-4 bg-light border-top">

                                        <h6 class="fw-bold text-success mb-3">
                                            <i class="bi bi-chat-square-text-fill me-2"></i>
                                            Diskusi Tiket {{ $r->ticket_number }}
                                        </h6>

                                        <div class="bg-white rounded-4 p-3 mb-3">

                                            @forelse($r->comments as $comment)

                                                <div class="d-flex mb-3 {{ $comment->sender_type === 'ADMIN' ? 'justify-content-end' : 'justify-content-start' }}">

                                                    <div class="p-3 {{ $comment->sender_type === 'ADMIN' ? 'chat-admin' : 'chat-warga' }}"
                                                         style="max-width:75%;">

                                                        <div class="fw-bold small mb-2">

                                                            @if($comment->sender_type === 'ADMIN')
                                                                <i class="bi bi-shield-check text-primary me-1"></i>
                                                                {{ $comment->sender_name ?? 'Admin' }}
                                                            @else
                                                                <i class="bi bi-person-circle text-success me-1"></i>
                                                                {{ $comment->sender_name ?? 'Warga' }}
                                                            @endif

                                                        </div>

                                                        <div style="white-space:pre-wrap;overflow-wrap:anywhere;">
                                                            {{ $comment->message }}
                                                        </div>

                                                        <small class="text-muted d-block text-end mt-2">
                                                            {{ $comment->created_at->format('d M Y, H:i') }}
                                                        </small>

                                                    </div>
                                                </div>

                                            @empty

                                                <p class="text-muted text-center mb-0 py-3">
                                                    Belum ada komentar.
                                                </p>

                                            @endforelse

                                        </div>

                                        <!-- FORM BALASAN ADMIN -->
                                        <form action="{{ route('admin.reports.comments.reply', $r->id) }}"
                                              method="POST">

                                            @csrf

                                            <label class="form-label fw-bold">
                                                Balas Pesan Warga
                                            </label>

                                            <textarea name="message"
                                                      class="form-control rounded-3 mb-2"
                                                      rows="3"
                                                      maxlength="2000"
                                                      placeholder="Tuliskan balasan untuk warga..."
                                                      required></textarea>

                                            <button type="submit"
                                                    class="btn btn-custom rounded-pill px-4">
                                                <i class="bi bi-send-fill me-2"></i>Kirim Balasan
                                            </button>

                                        </form>

                                    </div>
                                </div>

                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-2 opacity-50"></i>
                                Belum ada laporan masuk.
                            </td>
                        </tr>

                    @endforelse

                </tbody>
            </table>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

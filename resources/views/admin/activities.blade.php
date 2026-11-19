
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Relawan — SIGAP KECAMATAN MUARA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #10B981;
            --dark-green: #064E3B;
            --deep-green: #0F766E;
            --light-green: #D1FAE5;
            --soft-green: #ECFDF5;
        }

        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #ECFDF5, #D1FAE5);
            min-height: 100vh;
            color: #1F2937;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #064E3B, #0F766E);
            box-shadow: 0 4px 15px rgba(6,78,59,.2);
        }

        .navbar-brand {
            font-weight: 800;
        }

        .navbar-custom .btn {
            font-size: 12px;
            font-weight: 700;
            border-radius: 8px;
        }

        .page-title {
            color: var(--dark-green);
            font-weight: 800;
        }

        .glass-card {
            background: rgba(255,255,255,.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.5);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(16,185,129,.1);
            overflow: hidden;
        }

        .card-header-custom {
            background: #F0FDF4;
            border-bottom: 1px solid #D1FAE5;
        }

        .table thead th {
            background: #F0FDF4;
            color: var(--dark-green);
            font-size: .76rem;
            text-transform: uppercase;
            letter-spacing: .4px;
            white-space: nowrap;
            border-bottom: 2px solid #D1FAE5;
            padding: 14px;
        }

        .table td {
            vertical-align: middle;
            font-size: 13px;
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

        .text-green {
            color: var(--dark-green);
        }

        .stat-card {
            border: 1px solid #D1FAE5;
            border-radius: 15px;
            background: white;
            padding: 20px;
            height: 100%;
            box-shadow: 0 5px 15px rgba(16,185,129,.05);
            transition: .2s;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(16,185,129,.12);
        }

        .stat-icon {
            width: 43px;
            height: 43px;
            display: grid;
            place-items: center;
            background: #D1FAE5;
            color: #047857;
            border-radius: 12px;
            font-size: 20px;
        }

        .btn-add {
            background: var(--primary-green);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 13px;
            padding: 11px 22px;
            transition: .2s;
        }

        .btn-add:hover {
            background: var(--dark-green);
            color: white;
            transform: translateY(-2px);
        }

        .btn-outline-green {
            color: #059669;
            border: 1px solid var(--primary-green);
            background: white;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
        }

        .btn-outline-green:hover {
            background: var(--primary-green);
            color: white;
        }

        .form-select {
            border-radius: 9px;
            border-color: #D1D5DB;
            font-size: 12px;
        }

        .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 .2rem rgba(16,185,129,.15);
        }

        .alert {
            border-radius: 14px;
            border: none;
            font-size: 13px;
        }

        .activity-title {
            color: var(--dark-green);
            font-weight: 800;
        }

        .empty-state {
            background: rgba(255,255,255,.9);
            border: 1px solid #D1FAE5;
            border-radius: 20px;
            padding: 55px 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(16,185,129,.08);
        }

        @media(max-width:768px) {
            .navbar-custom .container-fluid {
                gap: 10px;
            }

            .navbar-brand {
                font-size: 15px !important;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-card h4 {
                font-size: 20px;
            }

            .activity-actions {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom py-3 sticky-top">
    <div class="container-fluid px-3 px-md-4">

        <a class="navbar-brand text-white" href="/">
            <i class="bi bi-shield-check me-2 text-warning"></i>SIGAP Admin
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNav">
            <div class="navbar-nav ms-auto align-items-lg-center gap-2 mt-3 mt-lg-0">

                <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-file-earmark-text me-1"></i>Laporan
                </a>

                <a href="{{ route('admin.activities') }}" class="btn btn-light text-success fw-bold btn-sm">
                    <i class="bi bi-people me-1"></i>Relawan
                </a>

                <a href="{{ route('admin.supports') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-box2-heart me-1"></i>Dukungan
                </a>

                <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-images me-1"></i>Galeri
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </button>
                </form>

            </div>
        </div>
    </div>
</nav>

<!-- KONTEN -->
<div class="container-fluid px-3 px-md-4 py-4">

    <!-- HEADER -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h3 class="page-title mb-1">
                <i class="bi bi-people-fill me-2"></i>Kelola Kegiatan & Relawan
            </h3>

            <p class="text-muted mb-0">
                Kelola jadwal kegiatan dan pendaftaran relawan SIGAP Kecamatan Muara.
            </p>
        </div>

        <a href="{{ route('admin.activities.create') }}" class="btn btn-add">
            <i class="bi bi-plus-circle me-2"></i>Tambah Kegiatan
        </a>

    </div>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- DAFTAR KEGIATAN -->
    @forelse($activities as $activity)

        @php
            $activeCount = $activity->active_volunteers_count
                ?? $activity->volunteers->whereIn('status', [
                    'MENDAFTAR', 'DIKONFIRMASI', 'HADIR', 'SELESAI'
                ])->count();

            $quota = (int) $activity->volunteer_needed;
            $remaining = max(0, $quota - $activeCount);

            $activityStatus = [
                'draft' => ['Draft', 'secondary'],
                'published' => ['Dipublikasikan', 'success'],
                'done' => ['Selesai', 'primary'],
                'cancelled' => ['Dibatalkan', 'danger'],
            ][$activity->status] ?? [$activity->status, 'secondary'];
        @endphp

        <div class="glass-card mb-4">

            <!-- HEADER KEGIATAN -->
            <div class="card-header-custom p-3 p-md-4">

                <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">

                    <div>
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">

                            <h5 class="activity-title mb-0">
                                {{ $activity->title }}
                            </h5>

                            <span class="badge bg-{{ $activityStatus[1] }} rounded-pill px-3 py-2">
                                {{ $activityStatus[0] }}
                            </span>

                        </div>

                        <div class="small text-muted">

                            <span class="me-3">
                                <i class="bi bi-calendar-event me-1 text-success"></i>
                                {{ \Carbon\Carbon::parse($activity->date)->format('d M Y') }}
                            </span>

                            <span class="me-3">
                                <i class="bi bi-clock me-1 text-success"></i>
                                {{ \Carbon\Carbon::parse($activity->time)->format('H:i') }}
                            </span>

                            <span>
                                <i class="bi bi-geo-alt me-1 text-success"></i>
                                {{ $activity->location_name }}
                            </span>

                        </div>
                    </div>

                    <!-- AKSI KEGIATAN -->
                    <div class="d-flex gap-2 align-items-start flex-wrap activity-actions">

                        <a href="{{ route('admin.activities.edit', $activity->id) }}"
                           class="btn btn-sm btn-outline-green px-3">
                            <i class="bi bi-pencil-square me-1"></i>Edit
                        </a>

                        <form action="{{ route('admin.activities.destroy', $activity->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus kegiatan ini beserta data relawannya?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                <i class="bi bi-trash me-1"></i>Hapus
                            </button>

                        </form>

                    </div>

                </div>

                <!-- STATISTIK -->
                <div class="row g-3 mt-2">

                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Kuota</small>
                                    <h4 class="fw-bold text-green mb-0">{{ $quota }}</h4>
                                </div>
                                <div class="stat-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Terdaftar Aktif</small>
                                    <h4 class="fw-bold text-green mb-0">{{ $activeCount }}</h4>
                                </div>
                                <div class="stat-icon">
                                    <i class="bi bi-person-check"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Sisa Kuota</small>
                                    <h4 class="fw-bold text-green mb-0">{{ $remaining }}</h4>
                                </div>
                                <div class="stat-icon">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">Total Pendaftar</small>
                                    <h4 class="fw-bold text-green mb-0">{{ $activity->volunteers_count }}</h4>
                                </div>
                                <div class="stat-icon">
                                    <i class="bi bi-clipboard-data"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- DAFTAR RELAWAN -->
            <div class="p-3 p-md-4">

                <h6 class="fw-bold text-green mb-3">
                    <i class="bi bi-person-lines-fill me-2"></i>Daftar Relawan
                </h6>

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>
                            <tr>
                                <th>Nama Relawan</th>
                                <th>Kontak</th>
                                <th>Asal</th>
                                <th>Usia</th>
                                <th>Peran</th>
                                <th>Status</th>
                                <th class="text-end">Ubah Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($activity->volunteers as $v)

                                @php
                                    $badgeColor = match($v->status) {
                                        'MENDAFTAR' => 'warning text-dark',
                                        'DIKONFIRMASI' => 'info text-dark',
                                        'HADIR', 'SELESAI' => 'success',
                                        'DITOLAK' => 'danger',
                                        'DAFTAR_TUNGGU' => 'secondary',
                                        'TIDAK_HADIR' => 'dark',
                                        default => 'secondary'
                                    };
                                @endphp

                                <tr>

                                    <td class="fw-semibold">
                                        {{ $v->name }}
                                    </td>

                                    <td>{{ $v->phone }}</td>

                                    <td>{{ $v->origin ?: '-' }}</td>

                                    <td>{{ $v->age ? $v->age . ' tahun' : '-' }}</td>

                                    <td class="text-capitalize">
                                        {{ $v->role }}
                                    </td>

                                    <td>
                                        <span class="badge bg-{{ $badgeColor }} rounded-pill px-3 py-2">
                                            {{ str_replace('_', ' ', $v->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <form action="{{ route('admin.volunteers.update-status', $v->id) }}"
                                              method="POST"
                                              class="d-flex justify-content-end gap-2">

                                            @csrf

                                            <select name="status"
                                                    class="form-select form-select-sm"
                                                    style="min-width:145px;">

                                                @foreach([
                                                    'MENDAFTAR' => 'Mendaftar',
                                                    'DIKONFIRMASI' => 'Dikonfirmasi',
                                                    'HADIR' => 'Hadir',
                                                    'SELESAI' => 'Selesai',
                                                    'DAFTAR_TUNGGU' => 'Daftar Tunggu',
                                                    'TIDAK_HADIR' => 'Tidak Hadir',
                                                    'DITOLAK' => 'Ditolak'
                                                ] as $value => $label)

                                                    <option value="{{ $value }}"
                                                        {{ $v->status == $value ? 'selected' : '' }}>
                                                        {{ $label }}
                                                    </option>

                                                @endforeach

                                            </select>

                                            <button type="submit" class="btn btn-sm btn-custom">
                                                <i class="bi bi-arrow-repeat"></i>
                                            </button>

                                        </form>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <i class="bi bi-person-x fs-2 d-block mb-2"></i>
                                        Belum ada relawan yang mendaftar.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>
            </div>

        </div>

    @empty

        <!-- JIKA BELUM ADA KEGIATAN -->
        <div class="empty-state">

            <i class="bi bi-calendar-x display-3 text-success opacity-50"></i>

            <h5 class="fw-bold text-green mt-3">
                Belum Ada Kegiatan
            </h5>

            <p class="text-muted">
                Silakan tambahkan jadwal kegiatan gotong royong.
            </p>

            <a href="{{ route('admin.activities.create') }}" class="btn btn-add px-4">
                <i class="bi bi-plus-circle me-2"></i>Buat Kegiatan
            </a>

        </div>

    @endforelse

</div>

<footer class="text-center text-muted small py-4">
    &copy; {{ date('Y') }} SIGAP Kecamatan Muara. Semua Hak Dilindungi.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

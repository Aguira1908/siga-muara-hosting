
@php
    use Illuminate\Support\Facades\Storage;

    $supports = collect($supports ?? []);
    $paymentMethods = collect(config('support.payments', []));

    $totalSupports = $supports->count();

    $waitingSupports = $supports
        ->where('status', 'MENUNGGU_VERIFIKASI')
        ->count();

    $verifiedStatuses = [
        'TERVERIFIKASI',
        'DIGUNAKAN',
        'DITUTUP',
    ];

    $verifiedSupports = $supports
        ->whereIn('status', $verifiedStatuses)
        ->count();

    $totalAmount = $supports
        ->whereIn('status', $verifiedStatuses)
        ->sum('transfer_amount');

    $statusColors = [
        'MENUNGGU_VERIFIKASI' => 'warning',
        'TERVERIFIKASI' => 'primary',
        'DIGUNAKAN' => 'success',
        'DITUTUP' => 'secondary',
        'DITOLAK' => 'danger',
    ];

    $statusLabels = [
        'MENUNGGU_VERIFIKASI' => 'Menunggu Verifikasi',
        'TERVERIFIKASI' => 'Terverifikasi',
        'DIGUNAKAN' => 'Digunakan',
        'DITUTUP' => 'Ditutup',
        'DITOLAK' => 'Ditolak',
    ];
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Verifikasi Dukungan — SIGAP KECAMATAN MUARA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #10B981;
            --dark-green: #064E3B;
            --gradient-start: #ECFDF5;
            --gradient-mid: #D1FAE5;
            --text-dark: #24352c;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-mid));
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            color: var(--text-dark);
            font-size: 13px;
        }

        /* NAVBAR */
        .navbar-custom {
            background: linear-gradient(90deg, #064E3B, #0F766E);
            box-shadow: 0 3px 12px rgba(6, 78, 59, .15);
            padding-top: 9px !important;
            padding-bottom: 9px !important;
        }

        .navbar-brand {
            font-size: 16px !important;
        }

        .nav-actions .btn {
            font-size: 11px;
            padding: 6px 10px;
            border-radius: 7px;
        }

        /* KONTEN */
        .container-fluid {
            max-width: 1600px;
        }

        .page-title {
            color: var(--dark-green);
            font-weight: 800;
            font-size: 21px;
        }

        .page-title + div {
            font-size: 11px !important;
        }

        /* CARD */
        .glass-card {
            background: rgba(255,255,255,.97);
            border: 1px solid rgba(255,255,255,.8);
            border-radius: 13px;
            box-shadow: 0 5px 18px rgba(16,185,129,.08);
            overflow: hidden;
        }

        .stat-card {
            padding: 14px !important;
            transition: transform .2s ease, box-shadow .2s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 9px 20px rgba(16,185,129,.13);
        }

        .stat-card .text-secondary {
            font-size: 11px !important;
        }

        .stat-card .fs-3 {
            font-size: 24px !important;
        }

        .stat-card .fs-5 {
            font-size: 17px !important;
        }

        .stat-icon {
            font-size: 19px;
        }

        /* TABEL */
        .table {
            margin-bottom: 0;
            min-width: 1100px;
        }

        .table thead th {
            background: #F0FDF4;
            color: var(--dark-green);
            text-transform: uppercase;
            font-size: 10px;
            letter-spacing: .3px;
            border-bottom: 2px solid #D1FAE5;
            padding: 11px 9px;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 10px 9px;
            font-size: 11px;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background-color: #F8FAFC;
        }

        .detail-text {
            max-width: 190px;
            white-space: normal;
            line-height: 1.5;
            font-size: 10px;
        }

        .amount-text {
            color: var(--dark-green);
            font-weight: 800;
            white-space: nowrap;
            font-size: 11px;
        }

        /* TOMBOL */
        .btn {
            transition: all .2s ease;
        }

        .btn-custom {
            background-color: var(--primary-green);
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: var(--dark-green);
            color: white;
        }

        .btn-sm {
            font-size: 10px;
            padding: 5px 9px;
        }

        /* STATUS */
        .status-badge {
            display: inline-block;
            border-radius: 30px;
            padding: 5px 8px;
            font-size: 9px;
            font-weight: 800;
            white-space: nowrap;
        }

        /* FILTER */
        .filter-box {
            background: white;
            border: 1px solid #dcece0;
            border-radius: 12px;
            padding: 13px;
        }

        .filter-box .form-control,
        .filter-box .form-select,
        .action-form .form-select {
            border-radius: 8px;
            font-size: 11px;
            padding: 7px 10px;
        }

        .filter-box .form-label,
        .action-form .form-label {
            font-size: 11px;
        }

        .filter-box .form-control:focus,
        .filter-box .form-select:focus,
        .action-form .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 .15rem rgba(16,185,129,.12);
        }

        .filter-count {
            font-size: 10px;
            color: #64748b;
        }

        /* AKSI */
        .action-form {
            min-width: 155px;
        }

        .action-form .btn {
            font-size: 10px;
            padding: 5px 7px;
        }

        /* MODAL */
        .modal-content {
            border: 0;
            border-radius: 14px;
            overflow: hidden;
        }

        .modal-header {
            background: var(--dark-green);
            color: white;
            padding: 12px 16px;
        }

        .modal-title {
            font-size: 15px;
        }

        .modal-body {
            font-size: 12px;
            padding: 16px;
        }

        .proof-modal-image {
            max-width: 100%;
            max-height: 70vh;
            object-fit: contain;
            border-radius: 8px;
        }

        /* LAINNYA */
        .anonymous-label {
            display: inline-block;
            padding: 3px 7px;
            background: #f1f5f9;
            color: #64748b;
            border-radius: 20px;
            font-size: 9px;
            font-weight: 700;
        }

        .empty-state {
            padding: 35px 15px;
            text-align: center;
            color: #718078;
        }

        .empty-state i {
            font-size: 32px;
            color: #9bb9a3;
        }

        .empty-state h6 {
            font-size: 13px;
        }

        .empty-state p {
            font-size: 11px;
        }

        .alert {
            font-size: 12px;
            padding: 10px 14px;
            border-radius: 10px;
        }

        footer {
            font-size: 10px;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .page-title {
                font-size: 18px;
            }

            .navbar-brand {
                font-size: 14px !important;
            }

            .nav-actions {
                justify-content: flex-start !important;
                width: 100%;
                margin-left: 0 !important;
            }

            .nav-actions .btn {
                font-size: 10px;
                padding: 5px 8px;
            }

            .action-form {
                min-width: 145px;
            }

            .table {
                min-width: 1050px;
            }
        }
    </style>
</head>

<body>

{{-- NAVBAR ADMIN --}}
<nav class="navbar navbar-expand navbar-dark navbar-custom px-3 px-md-4 py-3 mb-4 sticky-top">
    <div class="container-fluid flex-wrap gap-2">

        <a class="navbar-brand fw-bold fs-5" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-shield-check me-2 text-warning"></i>
            SIGAP Admin
        </a>

        <div class="d-flex ms-auto gap-2 flex-wrap justify-content-center nav-actions">

            <a href="{{ route('admin.dashboard') }}"
               class="btn {{ request()->routeIs('admin.dashboard') ? 'btn-light text-success fw-bold' : 'btn-outline-light' }} btn-sm">
                <i class="bi bi-file-earmark-text me-1"></i>
                Laporan
            </a>

            <a href="{{ route('admin.activities') }}"
               class="btn {{ request()->routeIs('admin.activities') ? 'btn-light text-success fw-bold' : 'btn-outline-light' }} btn-sm">
                <i class="bi bi-people me-1"></i>
                Relawan
            </a>

            <a href="{{ route('admin.supports') }}"
               class="btn {{ request()->routeIs('admin.supports') ? 'btn-light text-success fw-bold' : 'btn-outline-light' }} btn-sm">
                <i class="bi bi-box2-heart me-1"></i>
                Dukungan
            </a>

            <a href="{{ route('admin.galeri.index') }}"
               class="btn {{ request()->routeIs('admin.galeri.*') ? 'btn-light text-success fw-bold' : 'btn-outline-light' }} btn-sm">
                <i class="bi bi-images me-1"></i>
                Galeri
            </a>

            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="bi bi-box-arrow-right me-1"></i>
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav>

{{-- KONTEN --}}
<div class="container-fluid px-3 px-md-4 pb-5">

    {{-- JUDUL --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>
            <h4 class="page-title mb-1">
                <i class="bi bi-box2-heart-fill me-2"></i>
                Verifikasi Dukungan Masyarakat
            </h4>

            <div class="text-secondary small">
                Periksa bukti transfer dan kelola status dukungan warga.
            </div>
        </div>

        <a href="{{ route('supports.summary') }}"
           target="_blank"
           rel="noopener noreferrer"
           class="btn btn-outline-success btn-sm rounded-pill">
            <i class="bi bi-eye me-1"></i>
            Lihat Ringkasan Publik
        </a>

    </div>

    {{-- NOTIFIKASI --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}

            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            {{ session('error') }}

            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0">
            <strong>
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Terjadi kesalahan:
            </strong>

            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close"
                    data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-6 col-lg-3">
            <div class="glass-card stat-card h-100">
                <div class="text-secondary small">Total Dukungan</div>
                <div class="fs-3 fw-bold text-success">
                    {{ number_format($totalSupports, 0, ',', '.') }}
                </div>
                <i class="bi bi-box2-heart text-success stat-icon"></i>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="glass-card stat-card h-100">
                <div class="text-secondary small">Menunggu Verifikasi</div>
                <div class="fs-3 fw-bold text-warning">
                    {{ number_format($waitingSupports, 0, ',', '.') }}
                </div>
                <i class="bi bi-hourglass-split text-warning stat-icon"></i>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="glass-card stat-card h-100">
                <div class="text-secondary small">Terverifikasi</div>
                <div class="fs-3 fw-bold text-primary">
                    {{ number_format($verifiedSupports, 0, ',', '.') }}
                </div>
                <i class="bi bi-patch-check text-primary stat-icon"></i>
            </div>
        </div>

        <div class="col-6 col-lg-3">
            <div class="glass-card stat-card h-100">
                <div class="text-secondary small">Total Dana Terverifikasi</div>
                <div class="fs-5 fw-bold text-success">
                    Rp{{ number_format((float) $totalAmount, 0, ',', '.') }}
                </div>
                <i class="bi bi-cash-stack text-success stat-icon"></i>
            </div>
        </div>

    </div>

    {{-- PENCARIAN DAN FILTER --}}
    <div class="filter-box mb-3">

        <div class="row g-2 align-items-end">

            <div class="col-md-5">
                <label for="searchSupport" class="form-label fw-bold">
                    <i class="bi bi-search me-1"></i>
                    Cari Pendukung
                </label>

                <input type="text"
                       id="searchSupport"
                       class="form-control"
                       placeholder="Cari nama, asal, atau detail dukungan..."
                       autocomplete="off">
            </div>

            <div class="col-md-4">
                <label for="filterStatus" class="form-label fw-bold">
                    <i class="bi bi-funnel me-1"></i>
                    Filter Status
                </label>

                <select id="filterStatus" class="form-select">
                    <option value="">Semua Status</option>

                    @foreach($statusLabels as $statusValue => $statusText)
                        <option value="{{ $statusValue }}">
                            {{ $statusText }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <button type="button"
                        class="btn btn-outline-secondary w-100"
                        id="resetFilter">
                    <i class="bi bi-arrow-counterclockwise me-1"></i>
                    Reset Filter
                </button>
            </div>

        </div>

        <div class="filter-count mt-2" id="filterCount">
            Menampilkan {{ $totalSupports }} data dukungan.
        </div>

    </div>

    {{-- TABEL DATA --}}
    <div class="glass-card">

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 p-3 border-bottom">

            <div class="fw-bold text-success">
                <i class="bi bi-list-ul me-2"></i>
                Data Dukungan Masuk
            </div>

            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                {{ $totalSupports }} Data
            </span>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Pendukung</th>
                        <th>Asal</th>
                        <th>Jenis Dukungan</th>
                        <th>Metode Pembayaran</th>
                        <th>Jumlah</th>
                        <th>Bukti Transfer</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($supports as $s)

                        @php
                            $paymentConfig = $paymentMethods->get(
                                (string) $s->payment_method,
                                []
                            );

                            $paymentLabel = $paymentConfig['label']
                                ?? $s->payment_method
                                ?? '-';

                            $isSponsorship = $s->type === 'sponsorship';

                            $proofExists = $isSponsorship
                                && !empty($s->proof_path)
                                && Storage::disk('public')->exists($s->proof_path);

                            $proofUrl = $proofExists
                                ? Storage::disk('public')->url($s->proof_path)
                                : null;

                            $rawStatus = strtoupper((string) ($s->status ?? ''));

                            $statusLabel = $statusLabels[$rawStatus]
                                ?? str_replace('_', ' ', $rawStatus);

                            $statusColor = $statusColors[$rawStatus] ?? 'secondary';

                            $typeLabel = match (strtolower((string) $s->type)) {
                                'sponsorship' => 'Sponsorship',
                                'barang' => 'Barang',
                                default => ucfirst((string) ($s->type ?? '-')),
                            };

                            $searchValue = implode(' ', [
                                $s->is_anonymous ? 'anonim' : ($s->donor_name ?? ''),
                                $s->origin_rantau ?? '',
                                $typeLabel,
                                $s->item_details ?? '',
                                $paymentLabel,
                                $statusLabel,
                            ]);
                        @endphp

                        <tr class="support-row"
                            data-search="{{ strtolower($searchValue) }}"
                            data-status="{{ $rawStatus }}">

                            <td class="text-secondary">
                                {{ $loop->iteration }}
                            </td>

                            <td class="text-nowrap">
                                {{ $s->created_at ? $s->created_at->format('d/m/Y') : '-' }}

                                <div class="small text-muted">
                                    {{ $s->created_at ? $s->created_at->format('H:i') : '' }}
                                </div>
                            </td>

                            <td>
                                @if($s->is_anonymous)
                                    <strong>Anonim</strong>

                                    <div>
                                        <span class="anonymous-label">
                                            <i class="bi bi-incognito me-1"></i>
                                            Privat
                                        </span>
                                    </div>
                                @else
                                    <strong>
                                        {{ $s->donor_name ?: 'Tidak diketahui' }}
                                    </strong>
                                @endif
                            </td>

                            <td>
                                {{ $s->origin_rantau ?: '-' }}
                            </td>

                            <td>
                                <div class="fw-semibold">
                                    {{ $typeLabel }}
                                </div>

                                <div class="detail-text text-secondary">
                                    {{ $s->item_details ?: '-' }}
                                </div>
                            </td>

                            <td>
                                @if($isSponsorship)
                                    {{ $paymentLabel }}
                                @else
                                    -
                                @endif
                            </td>

                            <td class="amount-text">
                                @if($isSponsorship && $s->transfer_amount)
                                    Rp{{ number_format((float) $s->transfer_amount, 0, ',', '.') }}
                                @else
                                    -
                                @endif
                            </td>

                            <td>
                                @if($proofExists)
                                    <button type="button"
                                            class="btn btn-sm btn-outline-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#proofModal{{ $s->id }}">
                                        <i class="bi bi-image me-1"></i>
                                        Lihat
                                    </button>
                                @else
                                    <span class="text-muted small">
                                        <i class="bi bi-dash-circle me-1"></i>
                                        Tidak tersedia
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span class="status-badge bg-{{ $statusColor }}-subtle text-{{ $statusColor }}">
                                    {{ $statusLabel }}
                                </span>
                            </td>

                            <td>
                                <div class="action-form">

                                    {{-- UBAH STATUS --}}
                                    <form action="{{ route('admin.supports.update-status', $s->id) }}"
                                          method="POST">

                                        @csrf

                                        <label class="form-label fw-bold mb-1">
                                            Ubah Status
                                        </label>

                                        <select name="status"
                                                class="form-select form-select-sm mb-2"
                                                required>

                                            @foreach($statusLabels as $statusValue => $statusText)
                                                <option value="{{ $statusValue }}"
                                                    {{ $rawStatus === $statusValue ? 'selected' : '' }}>
                                                    {{ $statusText }}
                                                </option>
                                            @endforeach

                                        </select>

                                        <button type="submit"
                                                class="btn btn-custom btn-sm w-100">
                                            <i class="bi bi-save me-1"></i>
                                            Simpan Status
                                        </button>

                                    </form>

                                    {{-- LIHAT PESAN --}}
                                    @if(!empty($s->message))
                                        <button type="button"
                                                class="btn btn-outline-info btn-sm w-100 mt-2"
                                                data-bs-toggle="modal"
                                                data-bs-target="#messageModal{{ $s->id }}">
                                            <i class="bi bi-chat-left-text me-1"></i>
                                            Lihat Pesan
                                        </button>
                                    @endif

                                    {{-- HAPUS DATA --}}
                                    <form action="{{ route('admin.supports.destroy', $s->id) }}"
                                          method="POST"
                                          class="mt-2 delete-support-form">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-outline-danger btn-sm w-100">
                                            <i class="bi bi-trash me-1"></i>
                                            Hapus Data
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="10">
                                <div class="empty-state">
                                    <i class="bi bi-inbox"></i>

                                    <h6 class="fw-bold mt-3">
                                        Belum Ada Dukungan
                                    </h6>

                                    <p class="small mb-0">
                                        Data dukungan masyarakat akan muncul di sini.
                                    </p>
                                </div>
                            </td>
                        </tr>

                    @endforelse

                    @if($totalSupports > 0)
                        <tr id="noFilterResult" style="display:none;">
                            <td colspan="10">
                                <div class="empty-state">
                                    <i class="bi bi-search"></i>

                                    <h6 class="fw-bold mt-3">
                                        Data Tidak Ditemukan
                                    </h6>

                                    <p class="small mb-0">
                                        Coba gunakan kata kunci atau filter lainnya.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>

        </div>

        {{-- MODAL BUKTI TRANSFER --}}
        @foreach($supports as $s)

            @php
                $proofExists = $s->type === 'sponsorship'
                    && !empty($s->proof_path)
                    && Storage::disk('public')->exists($s->proof_path);

                $proofUrl = $proofExists
                    ? Storage::disk('public')->url($s->proof_path)
                    : null;
            @endphp

            @if($proofExists)

                <div class="modal fade"
                     id="proofModal{{ $s->id }}"
                     tabindex="-1"
                     aria-labelledby="proofModalLabel{{ $s->id }}"
                     aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered modal-lg">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title fw-bold"
                                    id="proofModalLabel{{ $s->id }}">
                                    <i class="bi bi-receipt me-2"></i>
                                    Bukti Transfer #{{ $s->id }}
                                </h5>

                                <button type="button"
                                        class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"
                                        aria-label="Tutup"></button>

                            </div>

                            <div class="modal-body text-center p-4">

                                <img src="{{ $proofUrl }}"
                                     class="proof-modal-image"
                                     alt="Bukti transfer dukungan"
                                     loading="lazy">

                                <div class="mt-3 small text-muted">
                                    Pendukung:
                                    {{ $s->is_anonymous ? 'Anonim' : ($s->donor_name ?: 'Tidak diketahui') }}
                                </div>

                                <div class="fw-bold text-success mt-1">
                                    Rp{{ number_format((float) $s->transfer_amount, 0, ',', '.') }}
                                </div>

                                <a href="{{ $proofUrl }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="btn btn-outline-success btn-sm mt-3">
                                    <i class="bi bi-box-arrow-up-right me-1"></i>
                                    Buka Gambar Asli
                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @endif

        @endforeach

        {{-- MODAL PESAN PENDUKUNG --}}
        @foreach($supports as $s)

            @if(!empty($s->message))

                <div class="modal fade"
                     id="messageModal{{ $s->id }}"
                     tabindex="-1"
                     aria-labelledby="messageModalLabel{{ $s->id }}"
                     aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered">

                        <div class="modal-content">

                            <div class="modal-header">

                                <h5 class="modal-title fw-bold"
                                    id="messageModalLabel{{ $s->id }}">
                                    <i class="bi bi-chat-left-text me-2"></i>
                                    Pesan Pendukung
                                </h5>

                                <button type="button"
                                        class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"
                                        aria-label="Tutup"></button>

                            </div>

                            <div class="modal-body">

                                <div class="small text-muted mb-2">
                                    Dari:
                                    <strong>
                                        {{ $s->is_anonymous ? 'Anonim' : ($s->donor_name ?: 'Tidak diketahui') }}
                                    </strong>
                                </div>

                                <div class="p-3 rounded-3 bg-light"
                                     style="line-height:1.8; white-space:pre-line;">
                                    {{ $s->message }}
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            @endif

        @endforeach

    </div>

    {{-- FOOTER --}}
    <div class="text-center text-muted small mt-4">
        © {{ date('Y') }} SIGAP Kecamatan Muara — Panel Verifikasi Dukungan
    </div>

</div>

{{-- JAVASCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchSupport');
    const statusFilter = document.getElementById('filterStatus');
    const resetButton = document.getElementById('resetFilter');
    const supportRows = document.querySelectorAll('.support-row');
    const noResult = document.getElementById('noFilterResult');
    const filterCount = document.getElementById('filterCount');

    function filterSupports() {

        const keyword = (searchInput?.value || '').toLowerCase().trim();
        const selectedStatus = (statusFilter?.value || '').toUpperCase();

        let visibleCount = 0;

        supportRows.forEach(function (row) {

            const searchText = (row.dataset.search || '').toLowerCase();
            const status = (row.dataset.status || '').toUpperCase();

            const matchesKeyword = searchText.includes(keyword);
            const matchesStatus = !selectedStatus || status === selectedStatus;

            const visible = matchesKeyword && matchesStatus;

            row.style.display = visible ? '' : 'none';

            if (visible) {
                visibleCount++;
            }

        });

        if (noResult) {
            noResult.style.display = visibleCount === 0 ? '' : 'none';
        }

        if (filterCount) {
            filterCount.textContent =
                'Menampilkan ' + visibleCount + ' dari ' +
                supportRows.length + ' data dukungan.';
        }

    }

    if (searchInput) {
        searchInput.addEventListener('input', filterSupports);
    }

    if (statusFilter) {
        statusFilter.addEventListener('change', filterSupports);
    }

    if (resetButton) {
        resetButton.addEventListener('click', function () {

            if (searchInput) {
                searchInput.value = '';
            }

            if (statusFilter) {
                statusFilter.value = '';
            }

            filterSupports();

        });
    }

    document.querySelectorAll('.delete-support-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {

            const confirmation = confirm(
                'Apakah Anda yakin ingin menghapus data dukungan ini? Data yang dihapus tidak dapat dikembalikan.'
            );

            if (!confirmation) {
                event.preventDefault();
            }

        });

    });

    filterSupports();

});
</script>

</body>
</html>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Metode Pembayaran — SIGAP Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #effbf5;
            color: #183b32;
        }

        .navbar-custom {
            background: linear-gradient(110deg, #075c49, #087b6d);
            padding: 18px 3%;
        }

        .navbar-brand {
            color: white;
            font-size: 23px;
            font-weight: 800;
        }

        .navbar-custom a {
            text-decoration: none;
        }

        .page-container {
            max-width: 1250px;
            margin: 35px auto;
            padding: 0 18px;
        }

        .card-custom {
            background: white;
            border: 1px solid #dceee5;
            border-radius: 18px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(20, 90, 65, .06);
            margin-bottom: 25px;
        }

        .section-title {
            font-weight: 800;
            color: #087b5e;
        }

        .form-control {
            border-radius: 10px;
            padding: 11px 13px;
            border-color: #d8e8df;
        }

        .form-control:focus {
            border-color: #0ba879;
            box-shadow: 0 0 0 .2rem rgba(11, 168, 121, .12);
        }

        .btn-green {
            background: #0bad79;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 11px 18px;
            font-weight: 700;
        }

        .btn-green:hover {
            background: #078b64;
            color: white;
        }

        .table thead th {
            background: #effaf4;
            color: #075c49;
            white-space: nowrap;
            padding: 16px;
        }

        .table tbody td {
            padding: 16px;
            vertical-align: middle;
        }

        .status-active {
            background: #d8f8e9;
            color: #07834f;
            padding: 7px 13px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 800;
        }

        .status-inactive {
            background: #f1f3f5;
            color: #68747c;
            padding: 7px 13px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 800;
        }

        .btn-outline-green {
            border: 1px solid #0ba879;
            color: #078b64;
            border-radius: 9px;
            font-weight: 700;
        }

        .btn-outline-green:hover {
            background: #0ba879;
            color: white;
        }

        .payment-active {
            border: 1px solid #a9e8c9;
            background: #f4fff8;
            border-radius: 14px;
            padding: 18px;
        }
    </style>
</head>
<body>

<nav class="navbar-custom">
    <div class="container-fluid d-flex flex-wrap align-items-center justify-content-between gap-3">
        <a href="{{ route('admin.dashboard') }}" class="navbar-brand">
            <i class="bi bi-shield-check text-warning me-2"></i>
            SIGAP Admin
        </a>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light">
                <i class="bi bi-house me-1"></i> Dashboard
            </a>

            <a href="{{ route('admin.supports') }}" class="btn btn-outline-light">
                <i class="bi bi-heart me-1"></i> Dukungan
            </a>

            <a href="{{ route('admin.payment-methods.index') }}" class="btn btn-light text-success fw-bold">
                <i class="bi bi-credit-card me-1"></i> Metode Pembayaran
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<div class="page-container">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger rounded-3">
            <strong>Periksa kembali data berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="mb-4">
        <h3 class="section-title">
            <i class="bi bi-credit-card-2-front me-2"></i>
            Pengaturan Metode Pembayaran
        </h3>
        <p class="text-secondary mb-0">
            Kelola rekening atau e-wallet yang digunakan untuk menerima dukungan warga.
        </p>
    </div>

    @php
        $activePayment = $paymentMethods->firstWhere('is_active', true);
    @endphp

    <div class="card-custom">
        <h5 class="section-title mb-3">
            <i class="bi bi-broadcast me-2"></i>Metode yang Ditampilkan kepada Warga
        </h5>

        @if($activePayment)
            <div class="payment-active">
                <div class="d-flex justify-content-between flex-wrap gap-2">
                    <div>
                        <span class="status-active">AKTIF</span>
                        <h5 class="fw-bold mt-3 mb-1">{{ $activePayment->name }}</h5>
                        <div class="text-secondary">
                            {{ $activePayment->account_name }}
                        </div>
                        <div class="fs-4 fw-bold mt-2">
                            {{ $activePayment->account_number }}
                        </div>
                        @if($activePayment->description)
                            <div class="text-secondary small mt-2">
                                {{ $activePayment->description }}
                            </div>
                        @endif
                    </div>
                    <div class="text-success fs-2">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning mb-0">
                Belum ada metode pembayaran aktif. Tambahkan metode pembayaran dan aktifkan salah satunya.
            </div>
        @endif
    </div>

    <div class="card-custom">
        <h5 class="section-title mb-4">
            <i class="bi bi-plus-circle me-2"></i>Tambah Metode Pembayaran
        </h5>

        <form action="{{ route('admin.payment-methods.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Bank / E-Wallet</label>
                    <input type="text" name="name" class="form-control"
                           placeholder="Contoh: Bank BCA / DANA"
                           value="{{ old('name') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nama Pemilik Rekening</label>
                    <input type="text" name="account_name" class="form-control"
                           placeholder="Nama pemilik rekening"
                           value="{{ old('account_name') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Nomor Rekening / Nomor E-Wallet</label>
                    <input type="text" name="account_number" class="form-control"
                           placeholder="Masukkan nomor rekening"
                           value="{{ old('account_number') }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-semibold">Keterangan (Opsional)</label>
                    <input type="text" name="description" class="form-control"
                           placeholder="Contoh: Transfer sesuai nominal dukungan"
                           value="{{ old('description') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-green mt-4">
                <i class="bi bi-plus-lg me-1"></i> Tambahkan Metode
            </button>
        </form>
    </div>

    <div class="card-custom">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <h5 class="section-title mb-0">
                <i class="bi bi-list-ul me-2"></i>Daftar Metode Pembayaran
            </h5>
            <span class="badge rounded-pill text-bg-success">
                {{ $paymentMethods->count() }} Metode
            </span>
        </div>

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Metode</th>
                        <th>Nama Pemilik</th>
                        <th>Nomor Rekening</th>
                        <th>Status</th>
                        <th style="min-width: 230px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paymentMethods as $index => $payment)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="fw-bold">{{ $payment->name }}</td>
                            <td>{{ $payment->account_name }}</td>
                            <td>{{ $payment->account_number }}</td>
                            <td>
                                @if($payment->is_active)
                                    <span class="status-active">AKTIF</span>
                                @else
                                    <span class="status-inactive">NONAKTIF</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex flex-wrap gap-2">
                                    @if(!$payment->is_active)
                                        <form action="{{ route('admin.payment-methods.activate', $payment->id) }}"
                                              method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-sm btn-outline-green"
                                                    onclick="return confirm('Aktifkan metode ini? Metode aktif sebelumnya akan dinonaktifkan.')">
                                                <i class="bi bi-check-circle"></i> Aktifkan
                                            </button>
                                        </form>
                                    @endif

                                    <button type="button" class="btn btn-sm btn-outline-primary"
                                            data-bs-toggle="modal"
                                            data-bs-target="#editPayment{{ $payment->id }}">
                                        <i class="bi bi-pencil"></i> Edit
                                    </button>

                                    <form action="{{ route('admin.payment-methods.destroy', $payment->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus metode pembayaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="editPayment{{ $payment->id }}" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 rounded-4">
                                    <form action="{{ route('admin.payment-methods.update', $payment->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Edit Metode Pembayaran</h5>
                                            <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <label class="form-label">Nama Bank / E-Wallet</label>
                                            <input type="text" name="name" class="form-control mb-3"
                                                   value="{{ $payment->name }}" required>

                                            <label class="form-label">Nama Pemilik</label>
                                            <input type="text" name="account_name" class="form-control mb-3"
                                                   value="{{ $payment->account_name }}" required>

                                            <label class="form-label">Nomor Rekening</label>
                                            <input type="text" name="account_number" class="form-control mb-3"
                                                   value="{{ $payment->account_number }}" required>

                                            <label class="form-label">Keterangan</label>
                                            <textarea name="description" class="form-control"
                                                      rows="3">{{ $payment->description }}</textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Batal</button>
                                            <button class="btn btn-green">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-secondary py-4">
                                Belum ada metode pembayaran.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @foreach($paymentMethods as $payment)
    <div class="modal fade" id="editPayment{{ $payment->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-4">
                <form action="{{ route('admin.payment-methods.update', $payment->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Edit Metode Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <label class="form-label">Nama Bank / E-Wallet</label>
                        <input type="text" name="name" class="form-control mb-3"
                               value="{{ $payment->name }}" required>

                        <label class="form-label">Nama Pemilik</label>
                        <input type="text" name="account_name" class="form-control mb-3"
                               value="{{ $payment->account_name }}" required>

                        <label class="form-label">Nomor Rekening</label>
                        <input type="text" name="account_number" class="form-control mb-3"
                               value="{{ $payment->account_number }}" required>

                        <label class="form-label">Keterangan</label>
                        <textarea name="description" class="form-control" rows="3">{{ $payment->description }}</textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-success">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

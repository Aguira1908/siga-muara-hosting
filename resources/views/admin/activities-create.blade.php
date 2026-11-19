<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Jadwal — SIGAP KECAMATAN MUARA</title>

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
            --bg: #F7FAF8;
        }

        * {
            box-sizing: border-box;
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

        .navbar-brand {
            font-size: 16px;
            letter-spacing: -.3px;
        }

        .form-card {
            background: rgba(255,255,255,.96);
            border: 1px solid rgba(255,255,255,.7);
            border-radius: 22px;
            box-shadow: 0 10px 30px rgba(6,78,59,.10);
            overflow: hidden;
        }

        .card-heading {
            background: linear-gradient(120deg, #064E3B, #0F766E);
            color: white;
            padding: 25px;
        }

        .card-heading h5 {
            font-weight: 800;
        }

        .form-label {
            color: var(--dark-green);
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .form-control,
        .form-select {
            border-radius: 11px;
            padding: 11px 13px;
            border: 1px solid #D1E7DD;
            font-size: 14px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-green);
            box-shadow: 0 0 0 .2rem rgba(16,185,129,.15);
        }

        .btn-green {
            background: var(--primary-green);
            color: white;
            border: none;
            border-radius: 11px;
            font-weight: 700;
            transition: .2s;
        }

        .btn-green:hover {
            background: var(--dark-green);
            color: white;
            transform: translateY(-1px);
        }

        .btn-cancel {
            border-radius: 11px;
            font-weight: 600;
            padding: 10px 22px;
        }

        .section-title {
            color: var(--dark-green);
            font-weight: 800;
            font-size: 15px;
            border-bottom: 1px solid #E5F3EB;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .required-mark {
            color: #DC3545;
        }

        .alert {
            border-radius: 13px;
        }

        @media(max-width: 576px) {
            .card-heading {
                padding: 20px;
            }

            .form-body {
                padding: 22px !important;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark navbar-custom py-3">
    <div class="container">

        <a href="{{ route('admin.activities') }}" class="navbar-brand fw-bold">
            <i class="bi bi-arrow-left-circle me-2"></i>
            Kembali ke Kegiatan
        </a>

        <span class="text-white small fw-semibold">
            <i class="bi bi-shield-check me-1"></i>
            SIGAP Admin
        </span>

    </div>
</nav>

<div class="container py-5">

    <div class="form-card mx-auto" style="max-width: 850px;">

        <div class="card-heading">
            <h5 class="mb-2">
                <i class="bi bi-calendar-plus me-2"></i>
                Buat Jadwal Gotong Royong
            </h5>

            <small class="opacity-75">
                Lengkapi informasi kegiatan yang akan dilaksanakan.
            </small>
        </div>

        <div class="form-body p-4 p-md-5">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        Periksa kembali data berikut:
                    </strong>

                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.activities.store') }}" method="POST">
                @csrf

                {{-- INFORMASI KEGIATAN --}}
                <h6 class="section-title">
                    <i class="bi bi-info-circle me-2"></i>
                    Informasi Kegiatan
                </h6>

                <div class="mb-4">
                    <label class="form-label">
                        Judul Kegiatan <span class="required-mark">*</span>
                    </label>

                    <input type="text"
                           name="title"
                           class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}"
                           placeholder="Contoh: Gotong Royong Membersihkan Muara"
                           required>

                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Deskripsi Kegiatan</label>

                    <textarea name="description"
                              rows="4"
                              class="form-control @error('description') is-invalid @enderror"
                              placeholder="Jelaskan kegiatan yang akan dilaksanakan...">{{ old('description') }}</textarea>

                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- JADWAL DAN LOKASI --}}
                <h6 class="section-title mt-4">
                    <i class="bi bi-calendar-event me-2"></i>
                    Jadwal dan Lokasi
                </h6>

                <div class="row g-3 mb-4">

                    <div class="col-md-6">
                        <label class="form-label">
                            Tanggal Kegiatan <span class="required-mark">*</span>
                        </label>

                        <input type="date"
                               name="date"
                               class="form-control @error('date') is-invalid @enderror"
                               value="{{ old('date') }}"
                               required>

                        @error('date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Waktu Kegiatan <span class="required-mark">*</span>
                        </label>

                        <input type="time"
                               name="time"
                               class="form-control @error('time') is-invalid @enderror"
                               value="{{ old('time') }}"
                               required>

                        @error('time')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Lokasi Spesifik <span class="required-mark">*</span>
                        </label>

                        <input type="text"
                               name="location_name"
                               class="form-control @error('location_name') is-invalid @enderror"
                               value="{{ old('location_name') }}"
                               placeholder="Contoh: Kawasan Muara"
                               required>

                        @error('location_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Titik Kumpul <span class="required-mark">*</span>
                        </label>

                        <input type="text"
                               name="meeting_point"
                               class="form-control @error('meeting_point') is-invalid @enderror"
                               value="{{ old('meeting_point') }}"
                               placeholder="Contoh: Kantor Desa"
                               required>

                        @error('meeting_point')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- RELAWAN DAN STATUS --}}
                <h6 class="section-title mt-4">
                    <i class="bi bi-people me-2"></i>
                    Relawan dan Status Kegiatan
                </h6>

                <div class="row g-3 mb-4">

                    <div class="col-md-6">
                        <label class="form-label">
                            Kuota Relawan <span class="required-mark">*</span>
                        </label>

                        <input type="number"
                               name="volunteer_needed"
                               class="form-control @error('volunteer_needed') is-invalid @enderror"
                               value="{{ old('volunteer_needed', 20) }}"
                               min="0"
                               required>

                        @error('volunteer_needed')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Status Kegiatan <span class="required-mark">*</span>
                        </label>

                        <select name="status"
                                class="form-select @error('status') is-invalid @enderror"
                                required>

                            <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>
                                Draft
                            </option>

                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>
                                Dipublikasikan
                            </option>

                            <option value="done" {{ old('status') == 'done' ? 'selected' : '' }}>
                                Selesai
                            </option>

                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                Dibatalkan
                            </option>

                        </select>

                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- PENANGGUNG JAWAB --}}
                <h6 class="section-title mt-4">
                    <i class="bi bi-person-badge me-2"></i>
                    Penanggung Jawab
                </h6>

                <div class="row g-3 mb-4">

                    <div class="col-md-6">
                        <label class="form-label">
                            Nama PIC <span class="required-mark">*</span>
                        </label>

                        <input type="text"
                               name="pic_name"
                               class="form-control @error('pic_name') is-invalid @enderror"
                               value="{{ old('pic_name') }}"
                               required>

                        @error('pic_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">
                            Nomor HP PIC <span class="required-mark">*</span>
                        </label>

                        <input type="text"
                               name="pic_phone"
                               class="form-control @error('pic_phone') is-invalid @enderror"
                               value="{{ old('pic_phone') }}"
                               placeholder="08xxxxxxxxxx"
                               required>

                        @error('pic_phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- KESELAMATAN --}}
                <h6 class="section-title mt-4">
                    <i class="bi bi-shield-check me-2"></i>
                    Informasi Keselamatan
                </h6>

                <div class="mb-4">
                    <label class="form-label">Catatan Keselamatan</label>

                    <textarea name="safety_notes"
                              rows="3"
                              class="form-control @error('safety_notes') is-invalid @enderror"
                              placeholder="Tuliskan informasi keselamatan dan pengawasan kegiatan...">{{ old('safety_notes') }}</textarea>

                    @error('safety_notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- BUTTON --}}
                <div class="d-flex flex-column flex-md-row gap-2 mt-4">

                    <button type="submit" class="btn btn-green px-4 py-3 flex-grow-1">
                        <i class="bi bi-save me-2"></i>
                        Simpan Jadwal
                    </button>

                    <a href="{{ route('admin.activities') }}"
                       class="btn btn-outline-secondary btn-cancel px-4 py-3">
                        <i class="bi bi-x-circle me-1"></i>
                        Batal
                    </a>

                </div>

            </form>
        </div>
    </div>

    <div class="text-center mt-4">
        <small class="text-muted">
            <i class="bi bi-shield-check me-1"></i>
            SIGAP Kecamatan Muara — Sistem Informasi dan Gerakan Aspirasi Publik
        </small>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
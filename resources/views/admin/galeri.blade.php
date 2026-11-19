
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Galeri — SIGAP KECAMATAN MUARA Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-green: #10B981;
            --dark-green: #064E3B;
            --light-green: #ECFDF5;
        }

        * {
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #ECFDF5, #D1FAE5);
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            color: #1F2937;
        }

        .navbar-custom {
            background: linear-gradient(90deg, #064E3B, #0F766E);
            box-shadow: 0 4px 15px rgba(6,78,59,.2);
        }

        .glass-card {
            background: rgba(255,255,255,.94);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,.7);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(16,185,129,.09);
            overflow: hidden;
        }

        .page-title {
            color: var(--dark-green);
            font-weight: 800;
        }

        .card-heading {
            background: linear-gradient(90deg, #10B981, #059669);
            color: white;
            padding: 18px 22px;
            font-weight: 800;
        }

        .form-label {
            font-weight: 700;
            font-size: .85rem;
            color: #374151;
        }

        .form-control,
        .form-select {
            border-radius: 11px;
            padding: 11px 13px;
            border-color: #D1D5DB;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #10B981;
            box-shadow: 0 0 0 .2rem rgba(16,185,129,.13);
        }

        .btn-custom {
            background: var(--primary-green);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px;
            font-weight: 700;
            transition: .2s;
        }

        .btn-custom:hover {
            background: var(--dark-green);
            color: white;
            transform: translateY(-2px);
        }

        .upload-preview {
            display: none;
            margin-top: 15px;
            padding: 12px;
            background: #F0FDF4;
            border: 1px dashed #86EFAC;
            border-radius: 14px;
        }

        .upload-preview img,
        .upload-preview video {
            width: 100%;
            max-height: 220px;
            object-fit: contain;
            border-radius: 10px;
            background: #111827;
        }

        .preview-title {
            font-size: .8rem;
            font-weight: 700;
            color: #047857;
            margin-bottom: 10px;
        }

        .table thead th {
            background: #F0FDF4;
            color: var(--dark-green);
            text-transform: uppercase;
            font-size: .76rem;
            letter-spacing: .4px;
            padding: 16px 12px;
            border-bottom: 2px solid #D1FAE5;
            white-space: nowrap;
        }

        .table tbody td {
            padding: 14px 12px;
            vertical-align: middle;
        }

        .media-preview {
            width: 110px;
            height: 78px;
            object-fit: cover;
            border-radius: 10px;
            background: #E5E7EB;
        }

        .video-preview {
            width: 110px;
            height: 78px;
            object-fit: cover;
            background: #111827;
            border-radius: 10px;
        }

        .category-badge {
            display: inline-block;
            padding: 6px 10px;
            background: #D1FAE5;
            color: #047857;
            border-radius: 50px;
            font-size: .7rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .type-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 50px;
            font-size: .7rem;
            font-weight: 700;
        }

        .type-photo {
            background: #DBEAFE;
            color: #1D4ED8;
        }

        .type-video {
            background: #FCE7F3;
            color: #BE185D;
        }

        .empty-state {
            padding: 45px 20px;
            text-align: center;
            color: #9CA3AF;
        }

        .empty-state i {
            font-size: 3rem;
            color: #6EE7B7;
        }

        .section-caption {
            color: #6B7280;
            font-size: .85rem;
        }

        @media(max-width:768px) {
            .navbar-custom .container-fluid {
                gap: 10px;
            }

            .navbar-brand {
                font-size: 15px !important;
            }

            .page-title {
                font-size: 1.25rem;
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
               class="btn btn-light text-success fw-bold btn-sm">
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

<!-- KONTEN -->
<div class="container-fluid px-3 px-md-4 pb-5">

    <div class="mb-4">
        <h4 class="page-title mb-1">
            <i class="bi bi-images me-2"></i>Kelola Galeri SIGAP KECAMATAN MUARA
        </h4>
        <p class="section-caption mb-0">
            Tambahkan dan kelola dokumentasi foto maupun video yang akan ditampilkan pada halaman galeri pengunjung.
        </p>
    </div>

    <!-- NOTIFIKASI -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm rounded-4">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger rounded-4 shadow-sm">
            <strong><i class="bi bi-exclamation-circle me-2"></i>Periksa kembali data berikut:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        <!-- FORM TAMBAH MEDIA -->
        <div class="col-12 col-lg-4">

            <div class="glass-card">

                <div class="card-heading">
                    <i class="bi bi-cloud-arrow-up-fill me-2"></i>
                    Tambah Media Baru
                </div>

                <div class="card-body p-4">

                    <form action="{{ route('admin.galeri.store') }}"
                          method="POST"
                          enctype="multipart/form-data"
                          id="galleryForm">

                        @csrf

                        <!-- JUDUL -->
                        <div class="mb-3">
                            <label class="form-label">Judul Media</label>
                            <input type="text"
                                   name="title"
                                   class="form-control"
                                   value="{{ old('title') }}"
                                   placeholder="Contoh: Keindahan Muara Danau Toba"
                                   maxlength="255"
                                   required>
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="description"
                                      class="form-control"
                                      rows="3"
                                      placeholder="Tuliskan keterangan dokumentasi..."
                                      maxlength="2000">{{ old('description') }}</textarea>
                        </div>

                        <!-- TIPE MEDIA -->
                        <div class="mb-3">
                            <label class="form-label">Tipe Media</label>
                            <select name="type" id="mediaType" class="form-select" required>
                                <option value="video" {{ old('type', 'video') === 'video' ? 'selected' : '' }}>
                                    Video (MP4)
                                </option>
                                <option value="photo" {{ old('type') === 'photo' ? 'selected' : '' }}>
                                    Foto (JPG/PNG/WEBP)
                                </option>
                            </select>
                        </div>

                        <!-- KATEGORI -->
                        <div class="mb-3">
                            <label class="form-label">Kategori Galeri</label>
                            <select name="category" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>

                                <option value="pelabuhan" {{ old('category') === 'pelabuhan' ? 'selected' : '' }}>
                                    Keindahan Muara
                                </option>

                                <option value="eceng_gondok" {{ old('category') === 'eceng_gondok' ? 'selected' : '' }}>
                                    Kondisi Eceng Gondok
                                </option>

                                <option value="gotong_royong" {{ old('category') === 'gotong_royong' ? 'selected' : '' }}>
                                    Aksi Gotong Royong
                                </option>
                            </select>

                            <small class="text-muted">
                                Pilih kategori agar media muncul pada bagian galeri yang sesuai.
                            </small>
                        </div>

                        <!-- FILE -->
                        <div class="mb-3">
                            <label class="form-label">Pilih File Foto / Video</label>

                            <input type="file"
                                   name="file"
                                   id="mediaFile"
                                   class="form-control"
                                   accept="video/mp4"
                                   required>

                            <small class="text-muted d-block mt-2">
                                <i class="bi bi-info-circle me-1"></i>
                                Video: MP4. Foto: JPG, JPEG, PNG, atau WEBP. Maksimal 50 MB.
                            </small>
                        </div>

                        <!-- PREVIEW -->
                        <div class="upload-preview" id="uploadPreview">

                            <div class="preview-title">
                                <i class="bi bi-eye me-1"></i>Preview Media
                            </div>

                            <img id="imagePreview" alt="Preview foto" style="display:none;">

                            <video id="videoPreview" controls style="display:none;"></video>

                            <div class="small text-muted mt-2" id="fileName"></div>

                        </div>

                        <!-- TOMBOL -->
                        <button type="submit" class="btn btn-custom w-100 mt-4">
                            <i class="bi bi-cloud-arrow-up me-2"></i>Upload Media
                        </button>

                    </form>

                </div>
            </div>

            <!-- PETUNJUK -->
            <div class="glass-card mt-4 p-4">

                <h6 class="fw-bold text-success mb-3">
                    <i class="bi bi-lightbulb-fill me-2"></i>Petunjuk Upload
                </h6>

                <div class="small text-muted">
                    <p class="mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        Isi judul media dengan jelas.
                    </p>

                    <p class="mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        Pilih kategori yang sesuai.
                    </p>

                    <p class="mb-2">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        Pastikan file sesuai dengan tipe media.
                    </p>

                    <p class="mb-0">
                        <i class="bi bi-check-circle-fill text-success me-2"></i>
                        Media yang berhasil diunggah akan ditampilkan pada galeri pengunjung sesuai kategorinya.
                    </p>
                </div>

            </div>

        </div>

        <!-- DAFTAR MEDIA -->
        <div class="col-12 col-lg-8">

            <div class="glass-card">

                <div class="p-4 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">

                    <div>
                        <h5 class="fw-bold text-success mb-1">
                            <i class="bi bi-collection-fill me-2"></i>Daftar Media Galeri
                        </h5>

                        <p class="section-caption mb-0">
                            Semua foto dan video yang telah diunggah.
                        </p>
                    </div>

                    <span class="badge rounded-pill px-3 py-2"
                          style="background:#D1FAE5;color:#047857;">
                        {{ $medias->count() }} Media
                    </span>

                </div>

                <div class="table-responsive">

                    <table class="table table-hover mb-0">

                        <thead>
                            <tr>
                                <th class="ps-4">Preview</th>
                                <th>Informasi Media</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($medias as $m)

                                <tr>

                                    <!-- PREVIEW -->
                                    <td class="ps-4">

                                        @if($m->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($m->file_path))

                                            @if($m->type === 'video')

                                                <video class="video-preview" controls preload="metadata">
                                                    <source src="{{ asset('storage/'.$m->file_path) }}" type="video/mp4">
                                                    Browser tidak mendukung video.
                                                </video>

                                            @else

                                                <a href="{{ asset('storage/'.$m->file_path) }}"
                                                   target="_blank"
                                                   rel="noopener noreferrer">

                                                    <img src="{{ asset('storage/'.$m->file_path) }}"
                                                         class="media-preview"
                                                         alt="{{ $m->title }}"
                                                         loading="lazy">
                                                </a>

                                            @endif

                                        @else

                                            <div class="media-preview d-flex align-items-center justify-content-center">
                                                <i class="bi bi-image text-secondary fs-3"></i>
                                            </div>

                                        @endif

                                    </td>

                                    <!-- INFORMASI -->
                                    <td>

                                        <div class="fw-bold text-dark mb-2">
                                            {{ $m->title }}
                                        </div>

                                        <span class="category-badge">
                                            {{ [
                                                'pelabuhan' => 'Keindahan Muara',
                                                'eceng_gondok' => 'Eceng Gondok',
                                                'gotong_royong' => 'Gotong Royong'
                                            ][$m->category] ?? str_replace('_', ' ', $m->category) }}
                                        </span>

                                        <br>

                                        <span class="type-badge {{ $m->type === 'video' ? 'type-video' : 'type-photo' }}">
                                            <i class="bi {{ $m->type === 'video' ? 'bi-camera-video' : 'bi-image' }} me-1"></i>
                                            {{ strtoupper($m->type) }}
                                        </span>

                                        @if($m->description)
                                            <p class="small text-muted mt-2 mb-0">
                                                {{ \Illuminate\Support\Str::limit($m->description, 90) }}
                                            </p>
                                        @endif

                                    </td>

                                    <!-- AKSI -->
                                    <td class="text-end pe-4">

                                        <form action="{{ route('admin.galeri.destroy', $m->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus media {{ addslashes($m->title) }}?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm rounded-pill px-3">
                                                <i class="bi bi-trash me-1"></i>Hapus
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="3">
                                        <div class="empty-state">
                                            <i class="bi bi-images d-block mb-3"></i>
                                            <h6 class="fw-bold text-secondary">Belum Ada Media</h6>
                                            <p class="small mb-0">
                                                Silakan unggah foto atau video melalui formulir di sebelah kiri.
                                            </p>
                                        </div>
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const mediaType = document.getElementById('mediaType');
    const mediaFile = document.getElementById('mediaFile');
    const uploadPreview = document.getElementById('uploadPreview');
    const imagePreview = document.getElementById('imagePreview');
    const videoPreview = document.getElementById('videoPreview');
    const fileName = document.getElementById('fileName');

    let previewUrl = null;

    function updateAcceptedFiles() {
        if (mediaType.value === 'video') {
            mediaFile.accept = 'video/mp4';
        } else {
            mediaFile.accept = 'image/jpeg,image/png,image/webp';
        }

        mediaFile.value = '';
        clearPreview();
    }

    function clearPreview() {
        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
            previewUrl = null;
        }

        uploadPreview.style.display = 'none';
        imagePreview.style.display = 'none';
        videoPreview.style.display = 'none';

        imagePreview.removeAttribute('src');
        videoPreview.removeAttribute('src');
        videoPreview.load();

        fileName.textContent = '';
    }

    mediaType.addEventListener('change', updateAcceptedFiles);

    mediaFile.addEventListener('change', function () {
        clearPreview();

        const file = this.files[0];

        if (!file) return;

        const isVideo = mediaType.value === 'video';
        const validType = isVideo
            ? file.type === 'video/mp4'
            : ['image/jpeg', 'image/png', 'image/webp'].includes(file.type);

        if (!validType) {
            alert(isVideo
                ? 'Silakan pilih file video MP4.'
                : 'Silakan pilih foto JPG, PNG, atau WEBP.');

            this.value = '';
            return;
        }

        if (file.size > 50 * 1024 * 1024) {
            alert('Ukuran file maksimal 50 MB.');
            this.value = '';
            return;
        }

        previewUrl = URL.createObjectURL(file);

        uploadPreview.style.display = 'block';
        fileName.textContent = file.name;

        if (isVideo) {
            videoPreview.src = previewUrl;
            videoPreview.style.display = 'block';
        } else {
            imagePreview.src = previewUrl;
            imagePreview.style.display = 'block';
        }
    });

    window.addEventListener('beforeunload', function () {
        if (previewUrl) {
            URL.revokeObjectURL(previewUrl);
        }
    });
</script>

</body>
</html>

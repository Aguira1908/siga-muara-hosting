<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan — SIGAP KECAMATAN MUARA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --lake-950: #03271F;
            --lake-800: #08463A;
            --lake-600: #0E7C63;
            --leaf:     #10B981;
            --mint-100: #E3F6EC;
            --mint-50:  #F4FBF7;
            --sun:      #F6B93B;
            --ink:      #17302A;
            --ink-soft: #4C6159;
        }
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: var(--ink); background: var(--mint-50); }
        h1, h2, h3, h4, h5, .brand-name { font-family: 'Bricolage Grotesque', 'Plus Jakarta Sans', sans-serif; }
        a:focus-visible, button:focus-visible { outline: 3px solid var(--sun); outline-offset: 3px; }

        /* ---------- NAVBAR (selalu solid di halaman ini) ---------- */
        .site-nav {
            padding: .6rem 0; background: rgba(3,39,31,.97);
            box-shadow: 0 6px 24px rgba(3,39,31,.25);
        }
        .site-nav .navbar-brand { color: #fff; font-weight: 800; font-size: 1.4rem; letter-spacing: .3px; }
        .site-nav .navbar-brand i { color: var(--sun); }
        .site-nav .nav-link { color: rgba(255,255,255,.82); font-weight: 600; padding: .5rem .9rem; }
        .site-nav .nav-link:hover, .site-nav .nav-link.active { color: #fff; }
        .site-nav .nav-link.active { box-shadow: inset 0 -2px 0 var(--sun); }
        .site-nav .navbar-toggler { border: 0; }
        .site-nav .navbar-toggler:focus { box-shadow: none; }
        .btn-nav-cta { background: var(--sun); color: var(--lake-950); font-weight: 700; border-radius: 50px; padding: .5rem 1.3rem; border: 0; }
        .btn-nav-cta:hover { background: #fff; color: var(--lake-950); }
        @media (max-width: 991.98px) {
            .site-nav .navbar-collapse.show, .site-nav .navbar-collapse.collapsing {
                margin-top: .6rem; padding: 1rem 0 .5rem;
            }
        }

        /* ---------- KEPALA HALAMAN ---------- */
        .detail-head {
            background: linear-gradient(135deg, var(--lake-800), var(--lake-950)); color: #fff;
            padding: 6.5rem 0 3.2rem; border-radius: 0 0 36px 36px;
        }
        .back-link { display: inline-flex; align-items: center; gap: .4rem; color: #BFEBD6; text-decoration: none; font-weight: 600; margin-bottom: 1.4rem; }
        .back-link:hover { color: #fff; }
        .status { display: inline-flex; align-items: center; gap: .4rem; font-size: .85rem; font-weight: 700; padding: .35rem .9rem; border-radius: 50px; margin-bottom: .9rem; }
        .status.open { background: rgba(16,185,129,.22); color: #A7F3D0; border: 1px solid rgba(167,243,208,.4); }
        .status.closed { background: rgba(255,255,255,.12); color: #D5E2DC; border: 1px solid rgba(255,255,255,.25); }
        .detail-head h1 { font-weight: 800; font-size: clamp(1.9rem, 4.5vw, 3rem); line-height: 1.1; letter-spacing: -.02em; max-width: 22ch; margin-bottom: 1.2rem; }
        .head-meta { display: flex; flex-wrap: wrap; gap: .6rem 1.6rem; color: rgba(255,255,255,.88); font-weight: 500; }
        .head-meta span { display: inline-flex; align-items: center; gap: .5rem; }
        .head-meta i { color: var(--sun); }

        /* ---------- KARTU ---------- */
        .panel { background: #fff; border: 1px solid var(--mint-100); border-radius: 28px; }
        .panel h2, .panel h3 { font-weight: 800; color: var(--lake-800); }
        .about-text { color: var(--ink-soft); line-height: 1.85; margin: 0; }

        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        .info-tile { display: flex; gap: .9rem; align-items: flex-start; background: var(--mint-50); border-radius: 18px; padding: 1rem 1.1rem; }
        .info-tile.wide { grid-column: span 2; }
        .info-icon { width: 42px; height: 42px; flex-shrink: 0; border-radius: 13px; display: grid; place-items: center; background: var(--mint-100); color: var(--lake-600); font-size: 1.15rem; }
        .info-tile small { display: block; color: var(--ink-soft); font-size: .8rem; margin-bottom: .1rem; }
        .info-tile strong { color: var(--ink); font-weight: 700; }
        .info-tile a { color: var(--lake-600); font-weight: 600; text-decoration: none; font-size: .9rem; }
        .info-tile a:hover { text-decoration: underline; }
        .quota-bar { height: 8px; background: #D4EADF; border-radius: 50px; margin: .55rem 0 .3rem; }
        .quota-bar .progress-bar { background: var(--leaf); border-radius: 50px; }

        .safety {
            display: flex; gap: .9rem; background: #FFF6DD; border: 1px solid #F3DFA2; border-radius: 20px; padding: 1.2rem 1.3rem;
        }
        .safety i { color: #B7791F; font-size: 1.4rem; flex-shrink: 0; }
        .safety h3 { font-size: 1.05rem; font-weight: 800; color: #7A5200; margin-bottom: .25rem; }
        .safety p { color: #6B5A2B; font-size: .93rem; line-height: 1.65; margin: 0; }

        /* ---------- FORM ---------- */
        .form-panel { overflow: hidden; }
        @media (min-width: 992px) { .form-panel { position: sticky; top: 90px; } }
        .form-top { background: linear-gradient(135deg, var(--lake-600), var(--lake-800)); color: #fff; padding: 1.5rem 1.6rem; }
        .form-top h2 { color: #fff; font-size: 1.3rem; margin-bottom: .2rem; }
        .form-top p { margin: 0; color: rgba(255,255,255,.85); font-size: .92rem; }
        .form-body { padding: 1.6rem; }

        .form-label { color: var(--lake-800); font-weight: 700; font-size: .92rem; margin-bottom: .35rem; }
        .form-control, .form-select { border-radius: 14px; padding: .75rem 1rem; border: 1.5px solid #D4E6DC; background: #FCFEFD; }
        .form-control:focus, .form-select:focus { border-color: var(--leaf); box-shadow: 0 0 0 .22rem rgba(16,185,129,.18); }
        .form-check-input:checked { background-color: var(--lake-600); border-color: var(--lake-600); }
        .form-check-input:focus { box-shadow: 0 0 0 .2rem rgba(16,185,129,.25); border-color: var(--leaf); }
        .parent-note { background: var(--mint-50); border-radius: 14px; padding: .85rem 1rem; font-size: .86rem; color: var(--ink-soft); line-height: 1.6; display: flex; gap: .6rem; }
        .parent-note i { color: var(--lake-600); margin-top: .15rem; }
        .btn-lake { background: var(--lake-600); color: #fff; font-weight: 700; border: 0; border-radius: 50px; padding: .85rem 1.5rem; transition: background .2s ease, transform .2s ease; }
        .btn-lake:hover { background: var(--lake-800); color: #fff; transform: translateY(-2px); }

        .alert { border: 0; border-radius: 16px; }

        /* ---------- FOOTER ---------- */
        .site-footer { background: var(--lake-950); color: rgba(255,255,255,.75); padding: 3.5rem 0 1.8rem; margin-top: 4.5rem; }
        .site-footer .brand-name { color: #fff; font-weight: 800; font-size: 1.4rem; }
        .site-footer a { color: rgba(255,255,255,.75); text-decoration: none; }
        .site-footer a:hover { color: #fff; text-decoration: underline; }
        .site-footer .footer-links li { margin-bottom: .45rem; }
        .site-footer .copy { border-top: 1px solid rgba(255,255,255,.14); margin-top: 2.2rem; padding-top: 1.2rem; font-size: .88rem; }

        @media (max-width: 575.98px) {
            .info-grid { grid-template-columns: 1fr; }
            .info-tile.wide { grid-column: auto; }
            .detail-head { padding: 6rem 0 2.6rem; border-radius: 0 0 26px 26px; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top site-nav">
    <div class="container">
        <a class="navbar-brand brand-name" href="/"><i class="bi bi-shield-check me-2"></i>SIGAP KECAMATAN MUARA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="/galeri">Galeri</a></li>
                <li class="nav-item"><a class="nav-link active" href="/kegiatan">Kegiatan</a></li>
                <li class="nav-item"><a class="nav-link" href="/dukungan/ringkasan">Dukungan</a></li>
                <li class="nav-item"><a class="nav-link" href="/lacak">Lacak Laporan</a></li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0"><a class="btn btn-nav-cta" href="{{ route('reports.create') }}"><i class="bi bi-camera me-1"></i> Buat Laporan</a></li>
            </ul>
        </div>
    </div>
</nav>

@php
    $activeCount = $activity->volunteers()
        ->whereIn('status', ['MENDAFTAR', 'DIKONFIRMASI', 'HADIR', 'SELESAI'])
        ->count();

    $quota = (int) $activity->volunteer_needed;
    $remaining = max(0, $quota - $activeCount);

    $closed = $activity->date < now()->toDateString()
        || $remaining <= 0;

    $percent = $quota > 0 ? min(100, ($activeCount / $quota) * 100) : 0;
@endphp

<!-- KEPALA HALAMAN -->
<header class="detail-head" style="margin-top: -56px; padding-top: calc(56px + 3.5rem);">
    <div class="container">

        <a href="{{ route('activities.index') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Kembali ke jadwal kegiatan
        </a>

        <div>
            <span class="status {{ $closed ? 'closed' : 'open' }}">
                <i class="bi {{ $closed ? 'bi-lock-fill' : 'bi-check-circle-fill' }}"></i>
                {{ $closed ? 'Pendaftaran ditutup' : 'Pendaftaran dibuka' }}
            </span>
        </div>

        <h1>{{ $activity->title }}</h1>

        <div class="head-meta">
            <span><i class="bi bi-calendar-event"></i>{{ \Carbon\Carbon::parse($activity->date)->translatedFormat('d F Y') }}</span>
            <span><i class="bi bi-clock"></i>{{ \Carbon\Carbon::parse($activity->time)->format('H:i') }} WIB</span>
            <span><i class="bi bi-geo-alt"></i>{{ $activity->location_name }}</span>
        </div>

    </div>
</header>

<main class="container py-5">

    <div class="row g-4">

        <!-- DETAIL KEGIATAN -->
        <div class="col-lg-7">
            <div class="panel p-4 p-md-5 h-100">

                <h2 class="h4 mb-3">Tentang kegiatan</h2>
                <p class="about-text">
                    {{ $activity->description ?: 'Belum ada deskripsi kegiatan.' }}
                </p>

                <h3 class="h5 mt-5 mb-3">Informasi kegiatan</h3>

                <div class="info-grid mb-4">

                    <div class="info-tile">
                        <div class="info-icon"><i class="bi bi-calendar-event"></i></div>
                        <div>
                            <small>Tanggal</small>
                            <strong>{{ \Carbon\Carbon::parse($activity->date)->translatedFormat('d F Y') }}</strong>
                        </div>
                    </div>

                    <div class="info-tile">
                        <div class="info-icon"><i class="bi bi-clock"></i></div>
                        <div>
                            <small>Waktu</small>
                            <strong>{{ \Carbon\Carbon::parse($activity->time)->format('H:i') }} WIB</strong>
                        </div>
                    </div>

                    <div class="info-tile">
                        <div class="info-icon"><i class="bi bi-geo-alt"></i></div>
                        <div>
                            <small>Lokasi kegiatan</small>
                            <strong>{{ $activity->location_name }}</strong>
                        </div>
                    </div>

                    <div class="info-tile">
                        <div class="info-icon"><i class="bi bi-pin-map"></i></div>
                        <div>
                            <small>Titik kumpul</small>
                            <strong>{{ $activity->meeting_point }}</strong>
                        </div>
                    </div>

                    <div class="info-tile wide">
                        <div class="info-icon"><i class="bi bi-person-badge"></i></div>
                        <div>
                            <small>Penanggung jawab</small>
                            <strong>{{ $activity->pic_name }}</strong>
                            @if($activity->pic_phone)
                                <div><a href="tel:{{ $activity->pic_phone }}"><i class="bi bi-telephone me-1"></i>{{ $activity->pic_phone }}</a></div>
                            @endif
                        </div>
                    </div>

                    <div class="info-tile wide">
                        <div class="info-icon"><i class="bi bi-people"></i></div>
                        <div class="w-100">
                            <small>Kuota relawan</small>
                            <strong>{{ $activeCount }} dari {{ $quota }} orang</strong>

                            <div class="progress quota-bar" role="progressbar" aria-label="Kuota relawan"
                                 aria-valuenow="{{ round($percent) }}" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar" style="width: {{ $percent }}%;"></div>
                            </div>

                            <small class="mb-0">{{ $remaining }} kuota tersedia</small>
                        </div>
                    </div>

                </div>

                <div class="safety">
                    <i class="bi bi-shield-exclamation"></i>
                    <div>
                        <h3>Catatan keselamatan</h3>
                        <p>{{ $activity->safety_notes ?: 'Ikuti arahan penanggung jawab dan patuhi aturan keselamatan selama kegiatan.' }}</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- FORM PENDAFTARAN -->
        <div class="col-lg-5" id="daftar">
            <div class="panel form-panel">

                <div class="form-top">
                    <h2><i class="bi bi-person-plus me-2"></i>Daftar sebagai relawan</h2>
                    <p>Isi data dengan benar sebelum mendaftar.</p>
                </div>

                <div class="form-body">

                    @if(session('success'))
                        <div class="alert alert-success">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <strong>Pendaftaran belum berhasil.</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if($closed)
                        <div class="alert alert-secondary mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            Pendaftaran kegiatan ini sudah ditutup.
                        </div>
                    @else

                        <form action="{{ route('activities.register', $activity->id) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="name">Nama lengkap</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}"
                                    placeholder="Masukkan nama lengkap" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="phone">Nomor HP / WhatsApp</label>
                                <input type="text" name="phone" id="phone"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}"
                                    placeholder="08xxxxxxxxxx" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row g-3">
                                <div class="col-5">
                                    <label class="form-label" for="age">Usia</label>
                                    <input type="number" name="age" id="age"
                                        class="form-control @error('age') is-invalid @enderror"
                                        value="{{ old('age') }}"
                                        min="13" max="120" placeholder="Usia">
                                    @error('age')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-7">
                                    <label class="form-label" for="origin">Asal desa</label>
                                    <input type="text" name="origin" id="origin"
                                        class="form-control @error('origin') is-invalid @enderror"
                                        value="{{ old('origin') }}"
                                        placeholder="Nama desa">
                                    @error('origin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 mt-3">
                                <label class="form-label" for="role">Peran relawan</label>
                                <select name="role" id="role"
                                    class="form-select @error('role') is-invalid @enderror" required>
                                    <option value="">-- Pilih peran --</option>
                                    <option value="pengangkut" {{ old('role') == 'pengangkut' ? 'selected' : '' }}>Pengangkut Eceng Gondok</option>
                                    <option value="pencatat" {{ old('role') == 'pencatat' ? 'selected' : '' }}>Pencatat Kehadiran</option>
                                    <option value="dokumentasi" {{ old('role') == 'dokumentasi' ? 'selected' : '' }}>Dokumentasi</option>
                                    <option value="logistik" {{ old('role') == 'logistik' ? 'selected' : '' }}>Logistik / Konsumsi</option>
                                    <option value="alat" {{ old('role') == 'alat' ? 'selected' : '' }}>Penyedia Alat</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox"
                                    name="health_statement" id="health_statement"
                                    value="1" {{ old('health_statement') ? 'checked' : '' }} required>

                                <label class="form-check-label small text-muted" for="health_statement">
                                    Saya menyatakan telah membaca catatan keselamatan dan bersedia mengikuti arahan penanggung jawab kegiatan.
                                </label>
                            </div>

                            <div class="parent-note mb-4">
                                <i class="bi bi-info-circle"></i>
                                <span>Peserta di bawah 15 tahun perlu mendapatkan izin orang tua/wali dan mengikuti kegiatan dengan pendampingan orang dewasa.</span>
                            </div>

                            <button type="submit" class="btn btn-lake w-100">
                                <i class="bi bi-send me-2"></i>Daftar sekarang
                            </button>
                        </form>
                    @endif

                </div>
            </div>
        </div>

    </div>
</main>

<!-- FOOTER -->
<footer class="site-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-12 col-md-6">
                <p class="brand-name mb-2"><i class="bi bi-shield-check me-2" style="color: var(--sun);"></i>TENTANG SIGAP KECAMATAN MUARA</p>
                <p class="mb-0" style="max-width: 42ch;">Sistem Informasi Gotong Royong Aksi Pelaporan Kecamatan Muara. Platform digital yang mengajak masyarakat untuk peduli, melaporkan permasalahan lingkungan, dan menjaga keindahan Danau Toba melalui aksi gotong royong.</p>
            </div>
            <div class="col-6 col-md-3">
                <p class="text-white fw-bold mb-2">Informasi Kami</p>
                <ul class="list-unstyled footer-links mb-0">
                    <li><a href="https://share.google/xDlpW9zkXS06Y7jnK">Pelabuhan Muara</a></li>
                    <li><a href="http://lindup.taputkab.go.id/">Dinas Lingkungan Hidup</a></li>
                    <li><a href="http://kec-muara.taputkab.go.id/">Kecamatan Muara</a></li>
                    
                </ul>
            </div>
            <div class="col-6 col-md-3">
                <p class="text-white fw-bold mb-2">Kontak Kami</p>
                <ul class="list-unstyled footer-links mb-0">
                    <li><a href="https://www.taputkab.go.id/">Tapanuli Utara</a></li>
                    <li><a href="diskominfo@taputkab.go.id"></a>diskominfo@taputkab.go.id</li>
                    <li><a href="+62 633 21220">+62 633 21220</a></li>
                    <li><a href="https://maps.google.com/?q=Jl.%20Letjen%20Suprapto%20No.1,%20TarutungTapanuli%20Utara,%20Sumatera%20Utara,22411">Jl. Letjen Suprapto No.1, Tarutung Tapanuli Utara, Sumatera Utara, 22411</a></li>
                </ul>
            </div>
        </div>
        <div class="copy text-center">&copy; 2026 College Project. Dibuat untuk memenuhi tugas project perkuliahan</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@if(session('success') || $errors->any())
<script>
    // Setelah kirim form, arahkan layar ke pesan sukses/galat (penting di HP)
    document.getElementById('daftar').scrollIntoView({ block: 'start' });
</script>
@endif
</body>
</html>
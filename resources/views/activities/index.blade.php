<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan Gotong Royong — SIGAP KECAMATAN MUARA</title>

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

        /* ---------- NAVBAR ---------- */
        .site-nav { padding: .9rem 0; transition: background-color .3s ease, padding .3s ease, box-shadow .3s ease; }
        .site-nav.scrolled {
            background: rgba(3,39,31,.94); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px);
            padding: .55rem 0; box-shadow: 0 6px 24px rgba(3,39,31,.25);
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
                background: var(--lake-950); margin-top: .6rem; padding: 1rem; border-radius: 18px;
            }
        }

        /* ---------- HERO ---------- */
        .page-hero {
            position: relative; min-height: 56vh; display: flex; align-items: center; color: #fff; overflow: hidden;
            background: linear-gradient(135deg, var(--lake-800), var(--lake-950)); padding: 8rem 0 5.5rem;
        }
        .page-hero video { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
        .hero-overlay {
            position: absolute; inset: 0;
            background:
                linear-gradient(90deg, rgba(3,39,31,.9) 0%, rgba(3,39,31,.6) 55%, rgba(3,39,31,.3) 100%),
                linear-gradient(0deg, rgba(3,39,31,.65) 0%, rgba(3,39,31,0) 40%);
        }
        .hero-content { position: relative; z-index: 1; max-width: 640px; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: .5rem; background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.28); backdrop-filter: blur(6px);
            padding: .45rem 1rem; border-radius: 50px; font-weight: 600; font-size: .9rem;
        }
        .hero-badge i { color: var(--sun); }
        .page-hero h1 { font-weight: 800; font-size: clamp(2.3rem, 5.5vw, 3.9rem); line-height: 1.06; letter-spacing: -.02em; margin: 1.2rem 0 1rem; }
        .page-hero .hero-desc { font-size: 1.1rem; line-height: 1.7; color: rgba(255,255,255,.88); margin: 0; max-width: 52ch; }
        .hero-wave { position: absolute; left: 0; right: 0; bottom: -1px; line-height: 0; z-index: 1; }
        .hero-wave svg { display: block; width: 100%; height: 60px; }
        @media (prefers-reduced-motion: no-preference) {
            .hero-content > * { opacity: 0; transform: translateY(18px); animation: rise .7s cubic-bezier(.2,.7,.2,1) forwards; }
            .hero-content > *:nth-child(2) { animation-delay: .08s; }
            .hero-content > *:nth-child(3) { animation-delay: .16s; }
            @keyframes rise { to { opacity: 1; transform: none; } }
        }

        /* ---------- DAFTAR KEGIATAN ---------- */
        .list-head h2 { font-weight: 800; font-size: clamp(1.7rem, 3.4vw, 2.3rem); color: var(--lake-800); margin-bottom: .3rem; letter-spacing: -.01em; }
        .list-head p { color: var(--ink-soft); margin: 0; }
        .btn-sun { background: var(--sun); color: var(--lake-950); font-weight: 700; border: 0; border-radius: 50px; padding: .75rem 1.5rem; transition: background .2s ease, transform .2s ease; white-space: nowrap; }
        .btn-sun:hover { background: var(--lake-800); color: #fff; transform: translateY(-2px); }

        .event-card {
            height: 100%; display: flex; flex-direction: column; background: #fff;
            border: 1px solid var(--mint-100); border-radius: 26px; padding: 1.6rem;
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .event-card:hover { transform: translateY(-5px); box-shadow: 0 18px 40px rgba(14,124,99,.15); }
        .event-card.is-closed { background: #FBFCFB; }
        .event-card.is-closed .date-tile { background: #6B7C75; }

        .event-top { display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1rem; }
        .date-tile {
            flex-shrink: 0; width: 64px; border-radius: 18px; background: var(--lake-800); color: #fff;
            text-align: center; padding: .55rem 0 .6rem; line-height: 1;
        }
        .date-tile .d { display: block; font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 1.7rem; }
        .date-tile .m { display: block; font-size: .8rem; font-weight: 600; margin-top: .25rem; color: #BFEBD6; }
        .event-top h3 { font-weight: 800; font-size: 1.2rem; line-height: 1.25; color: var(--lake-800); margin: .35rem 0 0; }

        .status { display: inline-flex; align-items: center; gap: .35rem; font-size: .78rem; font-weight: 700; padding: .25rem .7rem; border-radius: 50px; }
        .status.open { background: var(--mint-100); color: var(--lake-600); }
        .status.closed { background: #E8ECEA; color: #55655F; }

        .event-desc { color: var(--ink-soft); font-size: .93rem; line-height: 1.65; margin-bottom: 1.1rem; }
        .event-info { list-style: none; padding: 0; margin: 0 0 1.2rem; font-size: .92rem; }
        .event-info li { display: flex; gap: .7rem; align-items: flex-start; margin-bottom: .55rem; }
        .event-info i { color: var(--lake-600); margin-top: .1rem; }

        .quota { margin-top: auto; margin-bottom: 1.2rem; }
        .quota-text { display: flex; justify-content: space-between; font-size: .85rem; font-weight: 600; margin-bottom: .4rem; }
        .quota-text span:last-child { color: var(--ink-soft); font-weight: 500; }
        .quota .progress { height: 8px; background: var(--mint-100); border-radius: 50px; }
        .quota .progress-bar { background: var(--leaf); border-radius: 50px; }
        .is-closed .quota .progress-bar { background: #8FA39B; }

        .btn-detail {
            display: inline-flex; justify-content: center; align-items: center; gap: .5rem; text-decoration: none;
            font-weight: 700; color: var(--lake-600); border: 2px solid var(--lake-600); border-radius: 50px; padding: .7rem 1.3rem;
            transition: background .2s ease, color .2s ease;
        }
        .btn-detail:hover { background: var(--lake-600); color: #fff; }

        .empty-state { background: #fff; border: 1.5px dashed #A9DCC3; border-radius: 26px; padding: 3.5rem 1.5rem; text-align: center; }
        .empty-state i { font-size: 3rem; color: var(--leaf); }
        .empty-state h5 { font-weight: 800; color: var(--lake-800); margin-top: .8rem; }
        .empty-state p { color: var(--ink-soft); margin: 0; }

        /* ---------- FOOTER ---------- */
        .site-footer { background: var(--lake-950); color: rgba(255,255,255,.75); padding: 3.5rem 0 1.8rem; margin-top: 4.5rem; }
        .site-footer .brand-name { color: #fff; font-weight: 800; font-size: 1.4rem; }
        .site-footer a { color: rgba(255,255,255,.75); text-decoration: none; }
        .site-footer a:hover { color: #fff; text-decoration: underline; }
        .site-footer .footer-links li { margin-bottom: .45rem; }
        .site-footer .copy { border-top: 1px solid rgba(255,255,255,.14); margin-top: 2.2rem; padding-top: 1.2rem; font-size: .88rem; }

        @media (max-width: 767.98px) {
            .page-hero { min-height: 50vh; padding: 7rem 0 5rem; }
        }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top site-nav" id="siteNav">
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

<!-- HERO -->
<header class="page-hero">
    <video autoplay muted loop playsinline preload="metadata" aria-hidden="true">
        <source src="{{ asset('storage/gallery/videos/11.mp4') }}" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>

    <div class="container">
        <div class="hero-content">
            <span class="hero-badge"><i class="bi bi-tree-fill"></i> Aksi peduli lingkungan</span>
            <h1>Jadwal Gotong Royong</h1>
            <p class="hero-desc">Bersama menjaga kebersihan dan kelestarian kecamatan muara kita. Pilih kegiatan, lalu daftar sebagai relawan.</p>
        </div>
    </div>

    <div class="hero-wave" aria-hidden="true">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none"><path d="M0,34 C240,70 480,0 720,24 C960,48 1200,60 1440,20 L1440,60 L0,60 Z" fill="#F4FBF7"/></svg>
    </div>
</header>

<main class="container pt-4">

    <div class="list-head d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-3 mb-4">
        <div>
            <h2>Aksi terdekat</h2>
            <p>Pilih kegiatan yang ingin kamu ikuti.</p>
        </div>

        <a href="{{ route('reports.create') }}" class="btn btn-sun">
            <i class="bi bi-megaphone me-2"></i>Buat laporan baru
        </a>
    </div>

    <div class="row g-4">
        @forelse($activities as $a)
            @php
                $activeCount = $a->volunteers()
                    ->whereIn('status', ['MENDAFTAR', 'DIKONFIRMASI', 'HADIR', 'SELESAI'])
                    ->count();

                $remaining = max(0, (int) $a->volunteer_needed - $activeCount);

                $past = $a->date < now()->toDateString();

                $closed = $past || $remaining <= 0;

                $percent = $a->volunteer_needed > 0 ? min(100, ($activeCount / $a->volunteer_needed) * 100) : 0;
            @endphp

            <div class="col-md-6 col-lg-4">
                <article class="event-card {{ $closed ? 'is-closed' : '' }}">

                    <div class="event-top">
                        <div class="date-tile" aria-hidden="true">
                            <span class="d">{{ \Carbon\Carbon::parse($a->date)->translatedFormat('d') }}</span>
                            <span class="m">{{ \Carbon\Carbon::parse($a->date)->translatedFormat('M Y') }}</span>
                        </div>

                        <div>
                            <span class="status {{ $closed ? 'closed' : 'open' }}">
                                <i class="bi {{ $closed ? 'bi-lock-fill' : 'bi-check-circle-fill' }}"></i>
                                {{ $past ? 'Sudah lewat' : ($remaining <= 0 ? 'Kuota penuh' : 'Pendaftaran dibuka') }}
                            </span>
                            <h3>{{ $a->title }}</h3>
                        </div>
                    </div>

                    <p class="event-desc">
                        {{ \Illuminate\Support\Str::limit($a->description, 120) }}
                    </p>

                    <ul class="event-info">
                        <li>
                            <i class="bi bi-calendar-event"></i>
                            <span>{{ \Carbon\Carbon::parse($a->date)->translatedFormat('d F Y') }}, {{ \Carbon\Carbon::parse($a->time)->format('H:i') }} WIB</span>
                        </li>
                        <li>
                            <i class="bi bi-geo-alt"></i>
                            <span>{{ $a->location_name }}</span>
                        </li>
                        <li>
                            <i class="bi bi-pin-map"></i>
                            <span>Titik kumpul: {{ $a->meeting_point }}</span>
                        </li>
                    </ul>

                    <div class="quota">
                        <div class="quota-text">
                            <span>{{ $activeCount }} / {{ $a->volunteer_needed }} relawan terdaftar</span>
                            @if(! $closed)
                                <span>Sisa {{ $remaining }}</span>
                            @endif
                        </div>
                        <div class="progress" role="progressbar" aria-label="Kuota relawan"
                             aria-valuenow="{{ round($percent) }}" aria-valuemin="0" aria-valuemax="100">
                            <div class="progress-bar" style="width: {{ $percent }}%;"></div>
                        </div>
                    </div>

                    <a href="{{ route('activities.show', $a->id) }}" class="btn-detail">
                        Lihat detail <i class="bi bi-arrow-right"></i>
                    </a>

                </article>
            </div>

        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-calendar-x"></i>
                    <h5>Belum ada jadwal kegiatan</h5>
                    <p>Jadwal gotong royong akan ditampilkan di halaman ini.</p>
                </div>
            </div>
        @endforelse
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
<script>
    (function () {
        var nav = document.getElementById('siteNav');
        function toggle() { nav.classList.toggle('scrolled', window.scrollY > 40); }
        toggle();
        window.addEventListener('scroll', toggle, { passive: true });
    })();
</script>
</body>
</html>
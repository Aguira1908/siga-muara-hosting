<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri — SIGAP KECAMATAN MUARA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --lake-950: #03271F; --lake-800: #08463A; --lake-600: #0E7C63; --leaf: #10B981;
            --mint-100: #E3F6EC; --mint-50: #F4FBF7; --sun: #F6B93B; --ink: #17302A; --ink-soft: #4C6159;
        }
        html { scroll-behavior: smooth; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: var(--ink); background: var(--mint-50); }
        h1, h2, h3, h4, h5, .brand-name { font-family: 'Bricolage Grotesque', 'Plus Jakarta Sans', sans-serif; }
        a:focus-visible, button:focus-visible { outline: 3px solid var(--sun); outline-offset: 3px; }

        /* ---------- NAVBAR ---------- */
        .site-nav { padding: .9rem 0; transition: background-color .3s ease, padding .3s ease, box-shadow .3s ease; }
        .site-nav.scrolled { background: rgba(3,39,31,.94); backdrop-filter: blur(10px); -webkit-backdrop-filter: blur(10px); padding: .55rem 0; box-shadow: 0 6px 24px rgba(3,39,31,.25); }
        .site-nav .navbar-brand { color: #fff; font-weight: 800; font-size: 1.4rem; letter-spacing: .3px; }
        .site-nav .navbar-brand i { color: var(--sun); }
        .site-nav .nav-link { color: rgba(255,255,255,.82); font-weight: 600; padding: .5rem .9rem; }
        .site-nav .nav-link:hover, .site-nav .nav-link.active { color: #fff; }
        .site-nav .nav-link.active { box-shadow: inset 0 -2px 0 var(--sun); }
        .site-nav .navbar-toggler { border: 0; }
        .site-nav .navbar-toggler:focus { box-shadow: none; }
        .btn-nav-cta { background: var(--sun); color: var(--lake-950); font-weight: 700; border-radius: 50px; padding: .5rem 1.3rem; border: 0; }
        .btn-nav-cta:hover { background: #fff; color: var(--lake-950); }
        @media (max-width: 991.98px) { .site-nav .navbar-collapse.show, .site-nav .navbar-collapse.collapsing { background: var(--lake-950); margin-top: .6rem; padding: 1rem; border-radius: 18px; } }

        /* ---------- HERO ---------- */
        .page-hero { position: relative; min-height: 64vh; display: flex; align-items: center; color: #fff; overflow: hidden; background: linear-gradient(135deg, var(--lake-800), var(--lake-950)); padding: 8rem 0 6rem; }
        .page-hero video { position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; }
        /* video hero memenuhi seluruh hero (sampai di balik navbar); video potret dipotong di tengah */
        .page-hero .hero-video { object-position: center 40%; }
        .hero-overlay { position: absolute; inset: 0; background: linear-gradient(90deg, rgba(3,39,31,.88) 0%, rgba(3,39,31,.55) 55%, rgba(3,39,31,.25) 100%), linear-gradient(0deg, rgba(3,39,31,.7) 0%, rgba(3,39,31,0) 40%); }
        .hero-content { position: relative; z-index: 1; max-width: 660px; }
        .hero-badge { display: inline-flex; align-items: center; gap: .5rem; background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.28); backdrop-filter: blur(6px); padding: .45rem 1rem; border-radius: 50px; font-weight: 600; font-size: .9rem; }
        .hero-badge i { color: var(--sun); }
        .page-hero h1 { font-weight: 800; font-size: clamp(2.3rem, 5.5vw, 4rem); line-height: 1.06; letter-spacing: -.02em; margin: 1.2rem 0 1rem; }
        .page-hero .hero-desc { font-size: 1.1rem; line-height: 1.7; color: rgba(255,255,255,.88); max-width: 54ch; margin-bottom: 1.8rem; }
        .btn-sun { background: var(--sun); color: var(--lake-950); font-weight: 700; border: 0; border-radius: 50px; padding: .85rem 1.8rem; transition: transform .2s ease, background .2s ease; }
        .btn-sun:hover { background: #fff; color: var(--lake-950); transform: translateY(-2px); }
        .hero-wave { position: absolute; left: 0; right: 0; bottom: -1px; line-height: 0; z-index: 1; }
        .hero-wave svg { display: block; width: 100%; height: 60px; }
        @media (prefers-reduced-motion: no-preference) {
            .hero-content > * { opacity: 0; transform: translateY(18px); animation: rise .7s cubic-bezier(.2,.7,.2,1) forwards; }
            .hero-content > *:nth-child(2) { animation-delay: .08s; }
            .hero-content > *:nth-child(3) { animation-delay: .16s; }
            .hero-content > *:nth-child(4) { animation-delay: .24s; }
            @keyframes rise { to { opacity: 1; transform: none; } }
        }

        /* ---------- PENGANTAR & KATEGORI ---------- */
        .gallery-intro { max-width: 640px; margin-bottom: 1.6rem; }
        .gallery-intro h2 { font-weight: 800; font-size: clamp(1.8rem, 3.6vw, 2.5rem); letter-spacing: -.01em; color: var(--lake-800); margin-bottom: .5rem; }
        .gallery-intro p { color: var(--ink-soft); font-size: 1.05rem; margin: 0; }
        .chip-nav { display: flex; flex-wrap: wrap; gap: .6rem; margin-bottom: 3rem; }
        .chip { display: inline-flex; align-items: center; gap: .5rem; text-decoration: none; background: #fff; border: 1px solid #CDEBDC; color: var(--lake-800); font-weight: 600; padding: .55rem 1.1rem; border-radius: 50px; transition: background .2s ease, color .2s ease; }
        .chip:hover { background: var(--lake-800); color: #fff; border-color: var(--lake-800); }
        .chip-count { background: var(--mint-100); color: var(--lake-800); border-radius: 50px; padding: 0 .5rem; font-size: .8rem; font-weight: 700; }
        .chip:hover .chip-count { background: rgba(255,255,255,.2); color: #fff; }

        .gallery-section { margin-bottom: 4rem; scroll-margin-top: 90px; }
        .sec-head { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.6rem; }
        .sec-icon { width: 52px; height: 52px; border-radius: 16px; display: grid; place-items: center; font-size: 1.4rem; background: var(--mint-100); color: var(--lake-600); flex-shrink: 0; }
        .sec-head h3 { font-weight: 800; font-size: 1.6rem; color: var(--lake-800); margin: 0 0 .15rem; }
        .sec-head p { color: var(--ink-soft); margin: 0; }

        /* ---------- TATA LETAK MASONRY: rasio asli, tanpa potong ---------- */
        .masonry { column-gap: 1.1rem; }
        .masonry > * { break-inside: avoid; margin-bottom: 1.1rem; }
        .cols-2 { columns: 2; }
        .cols-3 { columns: 3; }
        .cols-4 { columns: 4; }
        @media (max-width: 991.98px) { .cols-4 { columns: 3; } .cols-3 { columns: 2; } }
        @media (max-width: 767.98px) { .cols-4 { columns: 2; } .cols-3, .cols-2 { columns: 1; } }
        @media (max-width: 399.98px) { .cols-4 { columns: 1; } }

        /* ---------- KARTU MEDIA ---------- */
        .media-card { background: #fff; border: 1px solid var(--mint-100); border-radius: 24px; overflow: hidden; transition: box-shadow .25s ease, transform .25s ease; }
        .media-card:hover { box-shadow: 0 16px 36px rgba(14,124,99,.14); transform: translateY(-3px); }

        /* video: bingkai mengikuti rasio asli (diatur JS), isi tidak dipotong */
        .media-frame { position: relative; width: 100%; background: #0B1F1A; overflow: hidden; }
        .media-frame.is-video { aspect-ratio: 16 / 9; max-height: 80vh; }
        .media-frame.is-video video { width: 100%; height: 100%; object-fit: contain; display: block; background: #0B1F1A; }
        .media-frame.is-photo { background: var(--mint-100); }
        .media-frame.is-photo img { width: 100%; height: auto; max-height: 80vh; object-fit: contain; display: block; }
        .media-empty { min-height: 180px; display: grid; place-items: center; color: rgba(255,255,255,.75); font-size: .95rem; background: #0B1F1A; }
        .media-type { position: absolute; top: 12px; left: 12px; z-index: 2; display: inline-flex; align-items: center; gap: .35rem; background: rgba(3,39,31,.82); color: #fff; font-size: .78rem; font-weight: 600; padding: .3rem .75rem; border-radius: 50px; }
        .media-body { padding: 1.2rem 1.4rem 1.4rem; }
        .media-body h4 { font-weight: 800; font-size: 1.1rem; color: var(--lake-800); margin-bottom: .35rem; }
        .media-body p { color: var(--ink-soft); font-size: .93rem; line-height: 1.65; margin: 0; }

        /* foto: ubin dengan keterangan di atas foto */
        .photo-tile { position: relative; display: block; border-radius: 20px; overflow: hidden; background: var(--mint-100); transition: box-shadow .25s ease, transform .25s ease; }
        .photo-tile:hover { box-shadow: 0 16px 36px rgba(14,124,99,.18); transform: translateY(-3px); }
        .photo-tile img { width: 100%; height: auto; display: block; min-height: 120px; }
        .photo-tile .caption { position: absolute; left: 0; right: 0; bottom: 0; padding: 2.2rem 1rem .85rem; color: #fff; font-weight: 700; font-size: .95rem; line-height: 1.3; background: linear-gradient(0deg, rgba(3,39,31,.85), rgba(3,39,31,0)); }
        .photo-tile .zoom { position: absolute; top: 10px; right: 10px; width: 36px; height: 36px; border-radius: 50%; display: grid; place-items: center; background: rgba(3,39,31,.7); color: #fff; opacity: 0; transition: opacity .2s ease; }
        .photo-tile:hover .zoom, .photo-tile:focus-visible .zoom { opacity: 1; }
        @media (hover: none) { .photo-tile .zoom { opacity: 1; } }
        .photo-tile.missing { display: grid; place-items: center; color: var(--ink-soft); text-align: center; padding: 2.5rem 1rem; }

        .empty-gallery { background: #fff; border: 1.5px dashed #A9DCC3; border-radius: 22px; padding: 2.8rem 1.5rem; text-align: center; color: var(--ink-soft); }
        .empty-gallery i { font-size: 2.4rem; color: var(--leaf); display: block; margin-bottom: .6rem; }
        .empty-gallery h6 { font-weight: 800; color: var(--lake-800); }
        .empty-gallery p { margin: 0; }

        /* gotong royong: pita gelap */
        .gotong-band { background: linear-gradient(135deg, var(--lake-800), var(--lake-950)); color: #fff; border-radius: 32px; padding: 3rem 2rem; margin-bottom: 4rem; scroll-margin-top: 90px; }
        .gotong-band .sec-icon { background: rgba(255,255,255,.14); color: var(--sun); }
        .gotong-band .sec-head h3 { color: #fff; }
        .gotong-band .sec-head p { color: rgba(255,255,255,.82); }
        .gotong-band .empty-gallery { background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.3); color: rgba(255,255,255,.8); }
        .gotong-band .empty-gallery h6 { color: #fff; }
        .gotong-band .empty-gallery i { color: var(--sun); }

        /* ajakan akhir */
        .cta-band { background: #fff; border: 1px solid var(--mint-100); border-radius: 28px; padding: 2.6rem 2.2rem; }
        .cta-band h3 { font-weight: 800; color: var(--lake-800); margin-bottom: .4rem; }
        .cta-band p { color: var(--ink-soft); margin: 0; }
        .btn-lake { background: var(--lake-600); color: #fff; font-weight: 700; border: 0; border-radius: 50px; padding: .8rem 1.7rem; white-space: nowrap; }
        .btn-lake:hover { background: var(--lake-800); color: #fff; }

        /* ---------- LIGHTBOX (foto ukuran asli) ---------- */
        .lightbox { position: fixed; inset: 0; z-index: 2000; background: rgba(3,39,31,.95); display: flex; align-items: center; justify-content: center; padding: 3.5rem 1rem 3rem; }
        .lightbox[hidden] { display: none; }
        .lightbox figure { margin: 0; text-align: center; max-width: 100%; }
        .lightbox img { max-width: 94vw; max-height: 82vh; width: auto; height: auto; object-fit: contain; display: block; margin: 0 auto; border-radius: 10px; }
        .lightbox figcaption { color: rgba(255,255,255,.9); margin-top: .9rem; font-weight: 600; }
        .lb-btn { position: absolute; width: 46px; height: 46px; border-radius: 50%; border: 0; background: rgba(255,255,255,.14); color: #fff; display: grid; place-items: center; font-size: 1.2rem; transition: background .2s ease; }
        .lb-btn:hover { background: rgba(255,255,255,.28); }
        .lb-close { top: 14px; right: 14px; }
        .lb-prev { left: 14px; top: 50%; transform: translateY(-50%); }
        .lb-next { right: 14px; top: 50%; transform: translateY(-50%); }
        @media (max-width: 575.98px) { .lb-prev, .lb-next { top: auto; bottom: 14px; transform: none; } }

        /* ---------- FOOTER ---------- */
        .site-footer { background: var(--lake-950); color: rgba(255,255,255,.75); padding: 3.5rem 0 1.8rem; margin-top: 4.5rem; }
        .site-footer .brand-name { color: #fff; font-weight: 800; font-size: 1.4rem; }
        .site-footer a { color: rgba(255,255,255,.75); text-decoration: none; }
        .site-footer a:hover { color: #fff; text-decoration: underline; }
        .site-footer .footer-links li { margin-bottom: .45rem; }
        .site-footer .copy { border-top: 1px solid rgba(255,255,255,.14); margin-top: 2.2rem; padding-top: 1.2rem; font-size: .88rem; }

        @media (max-width: 767.98px) {
            .page-hero { min-height: 56vh; padding: 7rem 0 5rem; }
            .gotong-band { padding: 2rem 1.1rem; border-radius: 24px; }
            .sec-head h3 { font-size: 1.3rem; }
            .cta-band { padding: 2rem 1.4rem; }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top site-nav" id="siteNav">
    <div class="container">
        <a class="navbar-brand brand-name" href="/"><i class="bi bi-shield-check me-2"></i>SIGAP MUARA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                <li class="nav-item"><a class="nav-link active" href="/galeri">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="/kegiatan">Kegiatan</a></li>
                <li class="nav-item"><a class="nav-link" href="/dukungan/ringkasan">Dukungan</a></li>
                <li class="nav-item"><a class="nav-link" href="/lacak">Lacak Laporan</a></li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0"><a class="btn btn-nav-cta" href="/lapor"><i class="bi bi-camera me-1"></i> Buat Laporan</a></li>
            </ul>
        </div>
    </div>
</nav>

@php
    $publicDisk = \Illuminate\Support\Facades\Storage::disk('public');

    // Ambil video pertama yang file-nya benar-benar ada (bukan sekadar video pertama)
    $heroVideo = $pelabuhanVideos->first(fn ($v) => $v->file_path && $publicDisk->exists($v->file_path));
@endphp

<!-- HERO -->
<header class="page-hero">

    <!-- hero-video: {{ $heroVideo ? $heroVideo->file_path : 'tidak ada video kategori Keindahan Muara yang file-nya ditemukan' }} -->
    @if($heroVideo)
        <video class="hero-video" autoplay loop muted playsinline aria-hidden="true" tabindex="-1">
            <source src="{{ asset('storage/'.$heroVideo->file_path) }}" type="video/mp4">
        </video>
    @endif

    <div class="hero-overlay"></div>

    <div class="container">
        <div class="hero-content">
            <span class="hero-badge"><i class="bi bi-camera-fill"></i> Dokumentasi SIGAP Kecamatan Muara</span>
            <h1>Jaga Keindahan Danau Toba Bersama</h1>
            <p class="hero-desc">Ayo peduli, bergerak, dan singkirkan eceng gondok demi Kecamatan Muara yang lebih bersih.</p>
            <a href="#galeri-konten" class="btn btn-sun btn-lg">Jelajahi galeri <i class="bi bi-arrow-down ms-2"></i></a>
        </div>
    </div>

    <div class="hero-wave" aria-hidden="true">
        <svg viewBox="0 0 1440 60" preserveAspectRatio="none"><path d="M0,34 C240,70 480,0 720,24 C960,48 1200,60 1440,20 L1440,60 L0,60 Z" fill="#F4FBF7"/></svg>
    </div>
</header>

<!-- KONTEN GALERI -->
<main class="container pt-5" id="galeri-konten">

    <div class="gallery-intro">
        <h2>Galeri SIGAP Kecamatan Muara</h2>
        <p>Dokumentasi keindahan, kondisi lingkungan, dan aksi nyata masyarakat untuk Kecamatan Muara Danau Toba.</p>
    </div>

    <!-- Lompat ke kategori -->
    <nav class="chip-nav" aria-label="Kategori galeri">
        <a href="#keindahan-muara" class="chip"><i class="bi bi-camera-reels-fill"></i> Keindahan Muara <span class="chip-count">{{ $pelabuhanVideos->count() }}</span></a>
        <a href="#eceng-gondok" class="chip"><i class="bi bi-flower1"></i> Kondisi Eceng Gondok <span class="chip-count">{{ $ecengPhotos->count() }}</span></a>
        <a href="#gotong-royong" class="chip"><i class="bi bi-people-fill"></i> Gotong Royong <span class="chip-count">{{ $gotongRoyongMedias->count() }}</span></a>
    </nav>

    <!-- KATEGORI 1: KEINDAHAN MUARA (VIDEO) -->
    <section class="gallery-section" id="keindahan-muara">

        <div class="sec-head">
            <div class="sec-icon"><i class="bi bi-camera-reels-fill"></i></div>
            <div>
                <h3>Keindahan Kecamatan Muara</h3>
                <p>Video dokumentasi keindahan kawasan Muara.</p>
            </div>
        </div>

        @if($pelabuhanVideos->isEmpty())

            <div class="empty-gallery">
                <i class="bi bi-camera-video"></i>
                <h6>Belum ada video</h6>
                <p>Dokumentasi keindahan Kecamatan Muara belum tersedia.</p>
            </div>

        @else

            <div class="masonry cols-2">
                @foreach($pelabuhanVideos as $v)
                    <div>
                        <div class="media-card">

                            @if($v->file_path && $publicDisk->exists($v->file_path))
                                <div class="media-frame is-video">
                                    <video controls playsinline preload="metadata">
                                        <source src="{{ asset('storage/'.$v->file_path) }}#t=0.1" type="video/mp4">
                                        Browser Anda tidak mendukung video.
                                    </video>
                                </div>
                            @else
                                <div class="media-empty"><span>Video belum tersedia</span></div>
                            @endif

                            <div class="media-body">
                                <h4>{{ $v->title }}</h4>
                                <p>{{ $v->description ?: 'Dokumentasi keindahan kawasan Kecamatan Muara Danau Toba.' }}</p>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </section>

    <!-- KATEGORI 2: ECENG GONDOK (FOTO) -->
    <section class="gallery-section" id="eceng-gondok">

        <div class="sec-head">
            <div class="sec-icon"><i class="bi bi-flower1"></i></div>
            <div>
                <h3>Kondisi Eceng Gondok</h3>
                <p>Dokumentasi kondisi lingkungan dan perairan Kecamatan Muara. Ketuk foto untuk melihat ukuran penuh.</p>
            </div>
        </div>

        @if($ecengPhotos->isEmpty())

            <div class="empty-gallery">
                <i class="bi bi-images"></i>
                <h6>Belum ada foto</h6>
                <p>Foto kondisi eceng gondok belum tersedia.</p>
            </div>

        @else

            <div class="masonry cols-4">
                @foreach($ecengPhotos as $p)
                    <div>
                        @if($p->file_path && $publicDisk->exists($p->file_path))
                            <a href="{{ asset('storage/'.$p->file_path) }}"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="photo-tile lb-open"
                               data-lb="eceng"
                               data-caption="{{ $p->title }}">
                                <img src="{{ asset('storage/'.$p->file_path) }}"
                                     alt="{{ $p->title }}"
                                     loading="lazy"
                                     decoding="async">
                                <span class="zoom" aria-hidden="true"><i class="bi bi-arrows-fullscreen"></i></span>
                                <span class="caption">{{ $p->title }}</span>
                            </a>
                        @else
                            <div class="photo-tile missing">Foto tidak tersedia</div>
                        @endif
                    </div>
                @endforeach
            </div>

        @endif
    </section>

    <!-- KATEGORI 3: GOTONG ROYONG (FOTO + VIDEO) -->
    <section class="gotong-band" id="gotong-royong">

        <div class="sec-head">
            <div class="sec-icon"><i class="bi bi-people-fill"></i></div>
            <div>
                <h3>Bukti Aksi: Gotong Royong</h3>
                <p>Apresiasi untuk relawan dan masyarakat yang ikut menjaga kebersihan lingkungan Kecamatan Muara.</p>
            </div>
        </div>

        @if($gotongRoyongMedias->isEmpty())

            <div class="empty-gallery">
                <i class="bi bi-people"></i>
                <h6>Belum ada dokumentasi</h6>
                <p>Dokumentasi kegiatan gotong royong belum diunggah.</p>
            </div>

        @else

            <div class="masonry cols-3">
                @foreach($gotongRoyongMedias as $gr)
                    <div>
                        <div class="media-card">

                            @if($gr->file_path && $publicDisk->exists($gr->file_path))

                                @if($gr->type === 'video')

                                    <div class="media-frame is-video">
                                        <video controls playsinline preload="metadata">
                                            <source src="{{ asset('storage/'.$gr->file_path) }}#t=0.1" type="video/mp4">
                                            Browser Anda tidak mendukung video.
                                        </video>
                                        <span class="media-type"><i class="bi bi-play-circle"></i>Video</span>
                                    </div>

                                @else

                                    <a href="{{ asset('storage/'.$gr->file_path) }}"
                                       target="_blank"
                                       rel="noopener noreferrer"
                                       class="media-frame is-photo lb-open d-block"
                                       data-lb="gotong"
                                       data-caption="{{ $gr->title }}">
                                        <img src="{{ asset('storage/'.$gr->file_path) }}"
                                             alt="{{ $gr->title }}"
                                             loading="lazy"
                                             decoding="async">
                                        <span class="media-type"><i class="bi bi-image"></i>Foto</span>
                                    </a>

                                @endif

                            @else

                                <div class="media-empty"><span>Media tidak tersedia</span></div>

                            @endif

                            <div class="media-body">
                                <h4>{{ $gr->title }}</h4>
                                <p>{{ $gr->description ?: 'Dokumentasi aksi gotong royong masyarakat Kecamatan Muara.' }}</p>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>

        @endif

    </section>

    <!-- AJAKAN -->
    <section class="cta-band d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
        <div>
            <h3>Muara bersih, tanggung jawab bersama</h3>
            <p>Mari ikut berkontribusi menjaga lingkungan danau untuk masa depan.</p>
        </div>
        <a href="/kegiatan" class="btn btn-lake btn-lg"><i class="bi bi-people-fill me-2"></i>Lihat kegiatan</a>
    </section>

</main>

<!-- LIGHTBOX -->
<div class="lightbox" id="lightbox" role="dialog" aria-modal="true" aria-label="Pratinjau foto" hidden>
    <button type="button" class="lb-btn lb-close" id="lbClose" aria-label="Tutup"><i class="bi bi-x-lg"></i></button>
    <button type="button" class="lb-btn lb-prev" id="lbPrev" aria-label="Foto sebelumnya"><i class="bi bi-chevron-left"></i></button>
    <button type="button" class="lb-btn lb-next" id="lbNext" aria-label="Foto berikutnya"><i class="bi bi-chevron-right"></i></button>
    <figure>
        <img id="lbImg" alt="">
        <figcaption id="lbCap"></figcaption>
    </figure>
</div>

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
    // Navbar: transparan di atas hero, solid saat digulir
    (function () {
        var nav = document.getElementById('siteNav');
        function toggle() { nav.classList.toggle('scrolled', window.scrollY > 40); }
        toggle();
        window.addEventListener('scroll', toggle, { passive: true });
    })();

    // Video hero: pastikan berjalan (beberapa browser menahan autoplay)
    (function () {
        var hv = document.querySelector('.hero-video');
        if (!hv) return;

        hv.muted = true;
        var p = hv.play();
        if (p && p.catch) p.catch(function () { /* autoplay ditahan browser */ });
    })();

    // Bingkai video mengikuti rasio asli (landscape / potret), tanpa dipotong
    document.querySelectorAll('.media-frame.is-video video').forEach(function (v) {
        function setRatio() {
            if (!v.videoWidth) return;
            var r = v.videoWidth / v.videoHeight;
            r = Math.min(2.4, Math.max(0.5, r));
            v.parentElement.style.aspectRatio = r;
        }
        v.addEventListener('loadedmetadata', setRatio);
        if (v.readyState >= 1) setRatio();
    });

    // Lightbox: foto dibuka dalam ukuran aslinya
    (function () {
        var lb = document.getElementById('lightbox');
        var img = document.getElementById('lbImg');
        var cap = document.getElementById('lbCap');
        var btnClose = document.getElementById('lbClose');
        var btnPrev = document.getElementById('lbPrev');
        var btnNext = document.getElementById('lbNext');
        var items = [], idx = 0, lastFocus = null, startX = null;

        function show(i) {
            idx = (i + items.length) % items.length;
            var a = items[idx];
            img.src = a.href;
            img.alt = a.dataset.caption || '';
            cap.textContent = a.dataset.caption || '';
            var multi = items.length > 1;
            btnPrev.style.display = multi ? '' : 'none';
            btnNext.style.display = multi ? '' : 'none';
        }

        function open(a) {
            items = Array.prototype.slice.call(document.querySelectorAll('.lb-open[data-lb="' + a.dataset.lb + '"]'));
            lastFocus = document.activeElement;
            show(items.indexOf(a));
            lb.hidden = false;
            document.body.style.overflow = 'hidden';
            btnClose.focus();
        }

        function close() {
            lb.hidden = true;
            img.removeAttribute('src');
            document.body.style.overflow = '';
            if (lastFocus) lastFocus.focus();
        }

        document.addEventListener('click', function (e) {
            var a = e.target.closest('.lb-open');
            if (a) { e.preventDefault(); open(a); }
        });

        lb.addEventListener('click', function (e) { if (e.target === lb) close(); });
        btnClose.addEventListener('click', close);
        btnPrev.addEventListener('click', function () { show(idx - 1); });
        btnNext.addEventListener('click', function () { show(idx + 1); });

        document.addEventListener('keydown', function (e) {
            if (lb.hidden) return;
            if (e.key === 'Escape') close();
            else if (e.key === 'ArrowLeft' && items.length > 1) show(idx - 1);
            else if (e.key === 'ArrowRight' && items.length > 1) show(idx + 1);
            else if (e.key === 'Tab') {
                var f = [btnClose, btnPrev, btnNext].filter(function (b) { return b.style.display !== 'none'; });
                var i = f.indexOf(document.activeElement);
                e.preventDefault();
                f[(i + (e.shiftKey ? -1 : 1) + f.length) % f.length].focus();
            }
        });

        lb.addEventListener('touchstart', function (e) { startX = e.touches[0].clientX; }, { passive: true });
        lb.addEventListener('touchend', function (e) {
            if (startX === null || items.length < 2) return;
            var dx = e.changedTouches[0].clientX - startX;
            if (Math.abs(dx) > 50) show(idx + (dx < 0 ? 1 : -1));
            startX = null;
        });
    })();
</script>
</body>
</html>
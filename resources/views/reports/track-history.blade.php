<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Laporan — SIGAP KECAMATAN MUARA</title>

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

        /* NAVBAR */
        .site-nav { padding: .6rem 0; background: rgba(3,39,31,.97); box-shadow: 0 6px 24px rgba(3,39,31,.25); }
        .site-nav .navbar-brand { color: #fff; font-weight: 800; font-size: 1.4rem; letter-spacing: .3px; }
        .site-nav .navbar-brand i { color: var(--sun); }
        .site-nav .nav-link { color: rgba(255,255,255,.82); font-weight: 600; padding: .5rem .9rem; }
        .site-nav .nav-link:hover, .site-nav .nav-link.active { color: #fff; }
        .site-nav .nav-link.active { box-shadow: inset 0 -2px 0 var(--sun); }
        .site-nav .navbar-toggler { border: 0; }
        .site-nav .navbar-toggler:focus { box-shadow: none; }
        .btn-nav-cta { background: var(--sun); color: var(--lake-950); font-weight: 700; border-radius: 50px; padding: .5rem 1.3rem; border: 0; }
        .btn-nav-cta:hover { background: #fff; color: var(--lake-950); }
        @media (max-width: 991.98px) { .site-nav .navbar-collapse.show, .site-nav .navbar-collapse.collapsing { margin-top: .6rem; padding: 1rem 0 .5rem; } }

        /* KEPALA HALAMAN */
        .page-head { background: linear-gradient(135deg, var(--lake-800), var(--lake-950)); color: #fff; padding: 7rem 0 3.4rem; border-radius: 0 0 36px 36px; }
        .head-badge { display: inline-flex; align-items: center; gap: .5rem; background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.28); padding: .4rem 1rem; border-radius: 50px; font-weight: 600; font-size: .9rem; }
        .head-badge i { color: var(--sun); }
        .page-head h1 { font-weight: 800; font-size: clamp(2rem, 4.8vw, 3.2rem); line-height: 1.08; letter-spacing: -.02em; margin: 1.1rem 0 .8rem; }
        .page-head p { color: rgba(255,255,255,.88); font-size: 1.08rem; margin: 0; }

        /* DAFTAR RIWAYAT */
        .count-line { color: var(--ink-soft); margin-bottom: 1.4rem; }
        .count-line strong { color: var(--lake-800); }
        .report-link { text-decoration: none; color: inherit; display: block; }
        .report-item { display: flex; align-items: center; justify-content: space-between; gap: 1rem; flex-wrap: wrap; background: #fff; border: 1px solid var(--mint-100); border-radius: 22px; padding: 1.2rem 1.4rem; transition: transform .25s ease, box-shadow .25s ease, border-color .25s ease; }
        .report-link:hover .report-item { transform: translateY(-3px); box-shadow: 0 14px 30px rgba(14,124,99,.14); border-color: var(--leaf); }
        .report-link:focus-visible { outline: 3px solid var(--sun); outline-offset: 3px; border-radius: 22px; }
        .report-item h2 { font-size: 1.1rem; font-weight: 800; color: var(--lake-600); margin: 0 0 .25rem; }
        .report-item p { margin: 0; color: var(--ink-soft); font-size: .9rem; display: flex; flex-wrap: wrap; gap: .3rem .9rem; }
        .report-item p span { display: inline-flex; align-items: center; gap: .35rem; }
        .item-end { display: flex; align-items: center; gap: .8rem; }
        .item-end > i { color: var(--lake-600); }

        .st { display: inline-flex; align-items: center; font-size: .8rem; font-weight: 700; padding: .35rem .95rem; border-radius: 50px; }
        .st-new { background: #E0ECFF; color: #1D4ED8; }
        .st-proc { background: #FFF1CC; color: #8A5A00; }
        .st-done { background: var(--mint-100); color: var(--lake-600); }
        .st-bad { background: #FDE2E2; color: #B42318; }
        .st-info { background: #DDF3FA; color: #0B6B86; }

        .btn-back { display: inline-flex; align-items: center; gap: .5rem; text-decoration: none; font-weight: 700; color: var(--lake-600); border: 2px solid var(--lake-600); border-radius: 50px; padding: .7rem 1.5rem; transition: background .2s ease, color .2s ease; }
        .btn-back:hover { background: var(--lake-600); color: #fff; }

        /* FOOTER */
        .site-footer { background: var(--lake-950); color: rgba(255,255,255,.75); padding: 3.5rem 0 1.8rem; margin-top: 4.5rem; }
        .site-footer .brand-name { color: #fff; font-weight: 800; font-size: 1.4rem; }
        .site-footer a { color: rgba(255,255,255,.75); text-decoration: none; }
        .site-footer a:hover { color: #fff; text-decoration: underline; }
        .site-footer .footer-links li { margin-bottom: .45rem; }
        .site-footer .copy { border-top: 1px solid rgba(255,255,255,.14); margin-top: 2.2rem; padding-top: 1.2rem; font-size: .88rem; }

        @media (max-width: 575.98px) {
            .page-head { padding: 6.5rem 0 2.8rem; border-radius: 0 0 26px 26px; }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top site-nav">
    <div class="container">
        <a class="navbar-brand brand-name" href="/"><i class="bi bi-shield-check me-2"></i>SIGAP KECAMATAN MUARA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="/galeri">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="/kegiatan">Kegiatan</a></li>
                <li class="nav-item"><a class="nav-link" href="/dukungan/ringkasan">Dukungan</a></li>
                <li class="nav-item"><a class="nav-link active" href="/lacak">Lacak Laporan</a></li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0"><a class="btn btn-nav-cta" href="{{ route('reports.create') }}"><i class="bi bi-camera me-1"></i> Buat Laporan</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- KEPALA HALAMAN -->
<header class="page-head">
    <div class="container">
        <span class="head-badge"><i class="bi bi-clock-history"></i> Riwayat laporan</span>
        <h1>{{ $phone }}</h1>
        <p>Semua laporan yang terdaftar dengan nomor HP ini.</p>
    </div>
</header>

<main class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <p class="count-line">Ditemukan <strong>{{ $reports->count() }}</strong> laporan. Pilih salah satu untuk melihat detailnya.</p>

            <div class="d-flex flex-column gap-3">
                @foreach($reports as $r)
                    @php
                        $badgeClass = 'st-new';
                        if (in_array($r->status, ['DIVERIFIKASI', 'DIJADWALKAN', 'DITANGANI'])) $badgeClass = 'st-proc';
                        if ($r->status === 'SELESAI') $badgeClass = 'st-done';
                        if (in_array($r->status, ['DITOLAK', 'DITUNDA'])) $badgeClass = 'st-bad';
                        if ($r->status === 'BUTUH_DUKUNGAN') $badgeClass = 'st-info';
                    @endphp

                    <a href="{{ route('reports.track.result', $r->ticket_number) }}" class="report-link">
                        <div class="report-item">
                            <div>
                                <h2>{{ $r->ticket_number }}</h2>
                                <p>
                                    <span><i class="bi bi-geo-alt-fill"></i>{{ $r->location_name }}</span>
                                    <span><i class="bi bi-calendar3"></i>{{ $r->created_at->format('d M Y') }}</span>
                                </p>
                            </div>

                            <div class="item-end">
                                <span class="st {{ $badgeClass }}">{{ str_replace('_', ' ', $r->status) }}</span>
                                <i class="bi bi-chevron-right"></i>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('reports.track') }}" class="btn-back"><i class="bi bi-arrow-left"></i>Kembali lacak</a>
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
</body>
</html>
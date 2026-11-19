{{--
    BERANDA LENGKAP — SIGAP KECAMATAN MUARA
    Selain bagian statis (hero, menu aksi, cara kerja, galeri, ajakan, footer),
    halaman ini menampilkan data langsung dari database:
      - statistik ringkas
      - kegiatan terdekat
      - laporan selesai + laporan terbaru
      - dukungan terverifikasi
    Data disiapkan oleh HomeController. Jika variabelnya belum dikirim,
    bagian terkait menampilkan keadaan kosong (halaman tidak error).
--}}
@php
    // Nilai cadangan agar halaman tetap tampil walau controller belum dihubungkan
    $upcomingActivities = $upcomingActivities ?? collect();
    $completedReports = $completedReports ?? collect();
    $latestReports = $latestReports ?? collect();
    $supports = $supports ?? collect();
    $stats = $stats ?? ['reports' => 0, 'done' => 0, 'activities' => 0, 'volunteers' => 0];

    $publicDisk = \Illuminate\Support\Facades\Storage::disk('public');

    // Warna label status laporan
    $pillOf = fn ($s) => match ($s) {
        'BARU' => 'st-new',
        'DIVERIFIKASI', 'BUTUH_DUKUNGAN' => 'st-proc',
        'DIJADWALKAN', 'DITANGANI' => 'st-info',
        'SELESAI' => 'st-done',
        'DITOLAK' => 'st-bad',
        default => 'st-muted',
    };

    // Status relawan yang dihitung sebagai terdaftar aktif
    $activeVolunteerStatuses = ['MENDAFTAR', 'DIKONFIRMASI', 'HADIR', 'SELESAI'];
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAP KECAMATAN MUARA — Lapor Cepat, Gotong Royong, Muara Bersih</title>
    <meta name="description" content="Laporkan eceng gondok di kecamatan muara Danau Toba, ikut gotong royong, dan pantau tindak lanjutnya lewat SIGAP KECAMATAN MUARA.">

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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--ink);
            background: var(--mint-50);
        }
        h1, h2, h3, h4, .brand-name { font-family: 'Bricolage Grotesque', 'Plus Jakarta Sans', sans-serif; }

        a:focus-visible, button:focus-visible {
            outline: 3px solid var(--sun);
            outline-offset: 3px;
        }

        /* ---------- NAVBAR ---------- */
        .site-nav {
            padding: .9rem 0;
            transition: background-color .3s ease, padding .3s ease, box-shadow .3s ease;
        }
        .site-nav.scrolled {
            background: rgba(3, 39, 31, .94);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            padding: .55rem 0;
            box-shadow: 0 6px 24px rgba(3, 39, 31, .25);
        }
        .site-nav .navbar-brand { color: #fff; font-weight: 800; font-size: 1.4rem; letter-spacing: .3px; }
        .site-nav .navbar-brand i { color: var(--sun); }
        .site-nav .nav-link { color: rgba(255,255,255,.82); font-weight: 600; padding: .5rem .9rem; }
        .site-nav .nav-link:hover, .site-nav .nav-link.active { color: #fff; }
        .site-nav .nav-link.active { box-shadow: inset 0 -2px 0 var(--sun); }
        .site-nav .navbar-toggler { border: 0; }
        .site-nav .navbar-toggler:focus { box-shadow: none; }
        .btn-nav-cta {
            background: var(--sun); color: var(--lake-950); font-weight: 700;
            border-radius: 50px; padding: .5rem 1.3rem; border: 0;
        }
        .btn-nav-cta:hover { background: #fff; color: var(--lake-950); }

        @media (max-width: 991.98px) {
            .site-nav .navbar-collapse.show,
            .site-nav .navbar-collapse.collapsing {
                background: var(--lake-950);
                margin-top: .6rem;
                padding: 1rem;
                border-radius: 18px;
            }
        }

        /* ---------- HERO ---------- */
        .hero {
            position: relative;
            min-height: 92vh;
            display: flex;
            align-items: center;
            color: #fff;
            overflow: hidden;
            background: linear-gradient(135deg, var(--lake-800), var(--lake-950));
            padding: 8rem 0 7rem;
        }
        .hero video {
            position: absolute; inset: 0;
            width: 100%; height: 100%;
            object-fit: cover;
        }
        .hero-overlay {
            position: absolute; inset: 0;
            background:
                linear-gradient(90deg, rgba(3,39,31,.88) 0%, rgba(3,39,31,.55) 55%, rgba(3,39,31,.25) 100%),
                linear-gradient(0deg, rgba(3,39,31,.7) 0%, rgba(3,39,31,0) 40%);
        }
        .hero-content { position: relative; z-index: 1; max-width: 680px; }
        .hero-badge {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.28);
            backdrop-filter: blur(6px);
            padding: .45rem 1rem; border-radius: 50px;
            font-weight: 600; font-size: .9rem;
        }
        .hero-badge i { color: var(--sun); }
        .hero h1 {
            font-weight: 800;
            font-size: clamp(2.5rem, 6.2vw, 4.6rem);
            line-height: 1.04;
            letter-spacing: -.02em;
            margin: 1.25rem 0 1rem;
        }
        .hero .hero-name { font-weight: 600; font-size: 1.05rem; color: #BFEBD6; margin-bottom: 1.1rem; }
        .hero .hero-desc { font-size: 1.1rem; line-height: 1.7; color: rgba(255,255,255,.88); max-width: 56ch; margin-bottom: 2rem; }
        .btn-hero-primary {
            background: var(--sun); color: var(--lake-950); font-weight: 700;
            border: 0; border-radius: 50px; padding: .95rem 2rem;
            box-shadow: 0 10px 30px rgba(246,185,59,.35);
            transition: transform .2s ease, background .2s ease;
        }
        .btn-hero-primary:hover { background: #fff; color: var(--lake-950); transform: translateY(-2px); }
        .btn-hero-ghost {
            color: #fff; font-weight: 600; border: 2px solid rgba(255,255,255,.55);
            border-radius: 50px; padding: .85rem 1.8rem; background: transparent;
            transition: background .2s ease, border-color .2s ease;
        }
        .btn-hero-ghost:hover { background: rgba(255,255,255,.14); border-color: #fff; color: #fff; }

        /* satu momen animasi saat halaman dibuka */
        @media (prefers-reduced-motion: no-preference) {
            .hero-content > * { opacity: 0; transform: translateY(18px); animation: rise .7s cubic-bezier(.2,.7,.2,1) forwards; }
            .hero-content > *:nth-child(2) { animation-delay: .08s; }
            .hero-content > *:nth-child(3) { animation-delay: .16s; }
            .hero-content > *:nth-child(4) { animation-delay: .24s; }
            .hero-content > *:nth-child(5) { animation-delay: .32s; }
            @keyframes rise { to { opacity: 1; transform: none; } }
        }
        .hero-wave { position: absolute; left: 0; right: 0; bottom: -1px; line-height: 0; z-index: 1; }
        .hero-wave svg { display: block; width: 100%; height: 70px; }

        /* ---------- STATISTIK ---------- */
        /* Kartu angka yang sedikit menimpa dasar hero */
        .stats-strip { position: relative; z-index: 2; margin-top: -3.4rem; }
        .stats-card {
            background: #fff; border: 1px solid var(--mint-100); border-radius: 28px;
            box-shadow: 0 18px 40px rgba(3,39,31,.12);
            padding: 1.6rem 1rem;
            display: grid; grid-template-columns: repeat(4, 1fr);
        }
        .stat-item { text-align: center; padding: .4rem 1rem; border-right: 1px solid var(--mint-100); }
        .stat-item:last-child { border-right: 0; }
        .stat-item strong {
            display: block; font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800;
            font-size: clamp(1.8rem, 3.4vw, 2.6rem); line-height: 1.1; color: var(--lake-800);
        }
        .stat-item span { color: var(--ink-soft); font-weight: 600; font-size: .92rem; }
        @media (max-width: 767.98px) {
            .stats-card { grid-template-columns: repeat(2, 1fr); row-gap: 1rem; }
            .stat-item:nth-child(2) { border-right: 0; }
        }

        /* ---------- SECTION UMUM ---------- */
        .section { padding: 5rem 0; }
        .section-head { max-width: 620px; margin-bottom: 2.75rem; }
        .section-head h2 { font-weight: 800; font-size: clamp(1.8rem, 3.6vw, 2.5rem); letter-spacing: -.01em; color: var(--lake-800); margin-bottom: .6rem; }
        .section-head p { color: var(--ink-soft); font-size: 1.05rem; margin: 0; }
        .section-white { background: #fff; }

        /* ---------- MENU AKSI ---------- */
        .action-card {
            height: 100%;
            display: flex; flex-direction: column;
            padding: 2.2rem 2rem;
            border-radius: 28px;
            background: #fff;
            border: 1px solid var(--mint-100);
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .action-card:hover { transform: translateY(-6px); box-shadow: 0 18px 40px rgba(14,124,99,.16); }
        .action-icon {
            width: 64px; height: 64px; border-radius: 20px;
            display: grid; place-items: center;
            font-size: 1.8rem; margin-bottom: 1.4rem;
            background: var(--mint-100); color: var(--lake-600);
        }
        .action-card h3 { font-weight: 800; font-size: 1.4rem; margin-bottom: .6rem; color: var(--lake-800); }
        .action-card p { color: var(--ink-soft); line-height: 1.65; flex-grow: 1; margin-bottom: 1.6rem; }
        .action-link {
            display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
            font-weight: 700; color: var(--lake-600); text-decoration: none;
            border: 2px solid var(--lake-600); border-radius: 50px; padding: .7rem 1.4rem;
            transition: background .2s ease, color .2s ease;
        }
        .action-link:hover { background: var(--lake-600); color: #fff; }

        /* kartu utama (Lapor) dibuat menonjol */
        .action-card.featured {
            background: linear-gradient(160deg, var(--lake-600), var(--lake-950));
            border-color: transparent; color: #fff;
            box-shadow: 0 18px 40px rgba(8,70,58,.28);
        }
        .action-card.featured .action-icon { background: rgba(255,255,255,.16); color: var(--sun); }
        .action-card.featured h3 { color: #fff; }
        .action-card.featured p { color: rgba(255,255,255,.85); }
        .action-card.featured .action-link { background: var(--sun); border-color: var(--sun); color: var(--lake-950); }
        .action-card.featured .action-link:hover { background: #fff; border-color: #fff; }

        /* ---------- CARA KERJA ---------- */
        .how { background: #fff; }
        .step { position: relative; padding-top: .5rem; }
        .step-no {
            width: 56px; height: 56px; border-radius: 50%;
            display: grid; place-items: center;
            font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 1.4rem;
            background: var(--lake-800); color: #fff;
            position: relative; z-index: 1; margin-bottom: 1.1rem;
        }
        .step h3 { font-size: 1.2rem; font-weight: 800; color: var(--lake-800); margin-bottom: .45rem; }
        .step p { color: var(--ink-soft); line-height: 1.65; margin: 0; max-width: 34ch; }
        @media (min-width: 768px) {
            .step:not(:last-child)::after {
                content: ''; position: absolute; top: 2.05rem; left: 70px; right: -1.5rem;
                border-top: 2px dashed #A9DCC3;
            }
        }

        /* ---------- LABEL STATUS (dipakai laporan) ---------- */
        .st { display: inline-flex; align-items: center; gap: .35rem; font-size: .78rem; font-weight: 700; padding: .3rem .85rem; border-radius: 50px; white-space: nowrap; }
        .st-new   { background: #E0ECFF; color: #1D4ED8; }
        .st-proc  { background: #FFF1CC; color: #8A5A00; }
        .st-info  { background: #DDF3FA; color: #0B6B86; }
        .st-done  { background: var(--mint-100); color: var(--lake-600); }
        .st-bad   { background: #FDE2E2; color: #B42318; }
        .st-muted { background: #E8ECEA; color: #55655F; }

        .btn-detail {
            display: flex; align-items: center; justify-content: center; gap: .5rem; text-decoration: none;
            font-weight: 700; color: var(--lake-600); border: 2px solid var(--lake-600); border-radius: 50px; padding: .65rem 1.2rem;
            transition: background .2s ease, color .2s ease;
        }
        .btn-detail:hover { background: var(--lake-600); color: #fff; }

        .empty-state { background: #fff; border: 1.5px dashed #A9DCC3; border-radius: 24px; padding: 2.6rem 1.5rem; text-align: center; color: var(--ink-soft); }
        .section-white .empty-state { background: var(--mint-50); }
        .empty-state i { font-size: 2.4rem; color: var(--leaf); display: block; margin-bottom: .6rem; }
        .empty-state p { margin: 0; }

        /* ---------- KEGIATAN TERDEKAT ---------- */
        .event-card {
            height: 100%; display: flex; flex-direction: column; background: #fff;
            border: 1px solid var(--mint-100); border-radius: 26px; padding: 1.6rem;
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .event-card:hover { transform: translateY(-5px); box-shadow: 0 18px 40px rgba(14,124,99,.15); }
        .event-top { display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1rem; }
        /* Kotak tanggal seperti kalender */
        .date-tile { flex-shrink: 0; width: 64px; border-radius: 18px; background: var(--lake-800); color: #fff; text-align: center; padding: .55rem 0 .6rem; line-height: 1; }
        .date-tile .d { display: block; font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 1.7rem; }
        .date-tile .m { display: block; font-size: .8rem; font-weight: 600; margin-top: .25rem; color: #BFEBD6; }
        .event-top h3 { font-weight: 800; font-size: 1.2rem; line-height: 1.25; color: var(--lake-800); margin: .35rem 0 0; }
        .event-card.is-closed .date-tile { background: #6B7C75; }
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

        /* ---------- LAPORAN ---------- */
        .done-card { height: 100%; display: flex; flex-direction: column; background: #fff; border: 1px solid var(--mint-100); border-radius: 24px; overflow: hidden; transition: transform .25s ease, box-shadow .25s ease; }
        .done-card:hover { transform: translateY(-5px); box-shadow: 0 18px 40px rgba(14,124,99,.15); }
        .done-photo { position: relative; aspect-ratio: 16 / 10; background: var(--mint-100); }
        .done-photo img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .done-photo .photo-link { display: block; height: 100%; }
        .photo-empty { height: 100%; display: grid; place-items: center; text-align: center; color: var(--lake-600); }
        .photo-empty i { font-size: 2.2rem; display: block; }
        .photo-empty span { font-size: .85rem; color: var(--ink-soft); }
        .done-photo .st { position: absolute; top: 12px; left: 12px; background: rgba(3,39,31,.85); color: #fff; }
        .done-body { padding: 1.3rem 1.4rem 1.5rem; display: flex; flex-direction: column; flex-grow: 1; }
        .done-ticket { color: var(--lake-600); font-weight: 700; font-size: .9rem; }
        .done-body h3 { font-weight: 800; font-size: 1.15rem; color: var(--lake-800); margin: .15rem 0 .7rem; }
        .done-meta { color: var(--ink-soft); font-size: .88rem; margin-bottom: .3rem; display: flex; gap: .5rem; align-items: center; }
        .done-body .btn-detail { margin-top: auto; }
        .done-body .btn-spacer { margin-top: 1rem; }

        /* Daftar laporan terbaru */
        .latest-card { background: var(--mint-50); border: 1px solid var(--mint-100); border-radius: 24px; padding: 1.5rem; height: 100%; }
        .section-white .latest-card { background: var(--mint-50); }
        .latest-card h3 { font-weight: 800; font-size: 1.2rem; color: var(--lake-800); margin-bottom: 1rem; display: flex; align-items: center; gap: .6rem; }
        .latest-card h3 i { color: var(--lake-600); }
        .latest-row { display: flex; align-items: center; justify-content: space-between; gap: .8rem; text-decoration: none; color: inherit; background: #fff; border: 1px solid var(--mint-100); border-radius: 16px; padding: .8rem 1rem; margin-bottom: .6rem; transition: border-color .2s ease, box-shadow .2s ease; }
        .latest-row:hover { border-color: var(--leaf); box-shadow: 0 8px 18px rgba(14,124,99,.12); }
        .latest-row strong { display: block; color: var(--lake-600); font-size: .92rem; }
        .latest-row small { color: var(--ink-soft); }

        /* ---------- DUKUNGAN ---------- */
        .support-card { height: 100%; display: flex; flex-direction: column; background: #fff; border: 1px solid var(--mint-100); border-radius: 26px; padding: 1.6rem; transition: transform .25s ease, box-shadow .25s ease; }
        .support-card:hover { transform: translateY(-5px); box-shadow: 0 18px 40px rgba(14,124,99,.15); }
        .donor { display: flex; align-items: center; gap: .9rem; margin-bottom: 1.1rem; }
        .avatar { width: 48px; height: 48px; flex-shrink: 0; border-radius: 50%; display: grid; place-items: center; background: var(--lake-800); color: #fff; font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 1.2rem; }
        .avatar.anon { background: var(--mint-100); color: var(--lake-600); font-size: 1.3rem; }
        .donor h3 { font-size: 1.05rem; font-weight: 800; color: var(--lake-800); margin: 0 0 .1rem; line-height: 1.25; }
        .donor span { color: var(--ink-soft); font-size: .86rem; display: inline-flex; align-items: center; gap: .35rem; }
        .type-tag { display: inline-flex; align-items: center; gap: .4rem; align-self: flex-start; background: var(--mint-50); border: 1px solid #CDEBDC; color: var(--lake-800); font-size: .82rem; font-weight: 700; padding: .3rem .85rem; border-radius: 50px; margin-bottom: .8rem; text-transform: capitalize; }
        .detail-box { background: var(--mint-50); border-radius: 16px; padding: .9rem 1.1rem; margin-bottom: 1rem; }
        .detail-box small { display: block; color: var(--ink-soft); font-size: .78rem; margin-bottom: .15rem; }
        .detail-box strong { color: var(--ink); font-weight: 700; line-height: 1.5; }
        .quote { margin-top: auto; display: flex; gap: .7rem; border-left: 4px solid var(--leaf); background: #F0FAF4; border-radius: 0 14px 14px 0; padding: .9rem 1rem; }
        .quote i { color: var(--leaf); font-size: 1.2rem; flex-shrink: 0; }
        .quote p { margin: 0; color: var(--ink-soft); font-style: italic; line-height: 1.6; font-size: .95rem; }
        .btn-lake { background: var(--lake-600); color: #fff; font-weight: 700; border: 0; border-radius: 50px; padding: .75rem 1.6rem; white-space: nowrap; }
        .btn-lake:hover { background: var(--lake-800); color: #fff; }

        /* ---------- GALERI ---------- */
        .gallery-grid {
            display: grid; gap: 1rem;
            grid-template-columns: 1.5fr 1fr;
            grid-template-rows: 250px 250px;
        }
        .gallery-item {
            position: relative; overflow: hidden; border-radius: 24px;
            background: var(--mint-100); margin: 0;
        }
        .gallery-item:first-child { grid-row: span 2; }
        .gallery-item img { width: 100%; height: 100%; object-fit: cover; display: block; transition: transform .6s ease; }
        .gallery-item:hover img { transform: scale(1.05); }
        .gallery-item figcaption {
            position: absolute; left: 0; right: 0; bottom: 0;
            padding: 2.5rem 1.25rem 1rem;
            color: #fff; font-weight: 700;
            background: linear-gradient(0deg, rgba(3,39,31,.82), rgba(3,39,31,0));
        }
        @media (max-width: 767.98px) {
            .gallery-grid { grid-template-columns: 1fr; grid-template-rows: none; }
            .gallery-item, .gallery-item:first-child { grid-row: auto; height: 240px; }
        }
        .link-all { font-weight: 700; color: var(--lake-600); text-decoration: none; white-space: nowrap; }
        .link-all:hover { color: var(--lake-800); text-decoration: underline; }

        /* ---------- AJAKAN AKHIR ---------- */
        .cta-band {
            background: linear-gradient(120deg, var(--lake-800), var(--lake-950));
            color: #fff; border-radius: 32px; padding: 3.2rem 2.5rem;
            position: relative; overflow: hidden;
        }
        .cta-band::after {
            content: ''; position: absolute; right: -60px; top: -60px;
            width: 260px; height: 260px; border-radius: 50%;
            background: radial-gradient(circle, rgba(16,185,129,.35), rgba(16,185,129,0) 70%);
        }
        .cta-band h2 { font-weight: 800; font-size: clamp(1.7rem, 3.4vw, 2.3rem); margin-bottom: .6rem; }
        .cta-band p { color: rgba(255,255,255,.85); margin: 0; max-width: 52ch; }
        .cta-band .btn-hero-primary { position: relative; z-index: 1; white-space: nowrap; }

        /* ---------- FOOTER ---------- */
        .site-footer { background: var(--lake-950); color: rgba(255,255,255,.75); padding: 3.5rem 0 1.8rem; margin-top: 5rem; }
        .site-footer .brand-name { color: #fff; font-weight: 800; font-size: 1.4rem; }
        .site-footer a { color: rgba(255,255,255,.75); text-decoration: none; }
        .site-footer a:hover { color: #fff; text-decoration: underline; }
        .site-footer .footer-links li { margin-bottom: .45rem; }
        .site-footer .copy { border-top: 1px solid rgba(255,255,255,.14); margin-top: 2.2rem; padding-top: 1.2rem; font-size: .88rem; }

        @media (max-width: 767.98px) {
            .hero { min-height: 86vh; padding: 7rem 0 6rem; }
            .section { padding: 3.5rem 0; }
            .cta-band { padding: 2.2rem 1.5rem; border-radius: 24px; }
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
                <li class="nav-item"><a class="nav-link active" href="/">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="/galeri">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="/kegiatan">Kegiatan</a></li>
                <li class="nav-item"><a class="nav-link" href="/dukungan/ringkasan">Dukungan</a></li>
                <li class="nav-item"><a class="nav-link" href="/lacak">Lacak Laporan</a></li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0"><a class="btn btn-nav-cta" href="/lapor"><i class="bi bi-camera me-1"></i> Buat Laporan</a></li>
            </ul>
        </div>
    </div>
</nav>

<!-- HERO -->
<header class="hero">
    <video autoplay muted loop playsinline preload="metadata" aria-hidden="true">
        <source src="{{ asset('storage/gallery/videos/11.mp4') }}" type="video/mp4">
    </video>
    <div class="hero-overlay"></div>

    <div class="container">
        <div class="hero-content">
            <span class="hero-badge"><i class="bi bi-geo-alt-fill"></i> Aksi bersih Kecamatan Muara, Danau Toba</span>
            <h1>Lapor Cepat, Gotong Royong, Muara Bersih.</h1>
            <p class="hero-name">SIGAP KECAMATAN MUARA · Sistem Informasi Gotong Royong Aksi Pelaporan Kecamatan Muara</p>
            <p class="hero-desc">Melihat eceng gondok menumpuk di muara? Foto, tandai lokasinya, lalu kirim. Laporan Anda ditindaklanjuti dan warga diajak bergotong royong membersihkannya.</p>
            <div class="d-flex flex-wrap gap-3">
                <a href="/lapor" class="btn btn-hero-primary btn-lg"><i class="bi bi-camera me-2"></i>Buat Laporan Sekarang</a>
                <a href="/lacak" class="btn btn-hero-ghost btn-lg">Lacak Laporan</a>
            </div>
        </div>
    </div>

    <div class="hero-wave" aria-hidden="true">
        <svg viewBox="0 0 1440 70" preserveAspectRatio="none"><path d="M0,40 C240,80 480,0 720,28 C960,56 1200,70 1440,24 L1440,70 L0,70 Z" fill="#F4FBF7"/></svg>
    </div>
</header>

<main>

    <!-- STATISTIK -->
    {{-- Angka ringkas dari database. Angka dihitung naik saat bagian ini terlihat (lihat skrip di bawah). --}}
    <section class="stats-strip" aria-label="Ringkasan aksi">
        <div class="container">
            <div class="stats-card">
                <div class="stat-item">
                    <strong data-count="{{ $stats['reports'] }}">{{ number_format($stats['reports'], 0, ',', '.') }}</strong>
                    <span>Laporan masuk</span>
                </div>
                <div class="stat-item">
                    <strong data-count="{{ $stats['done'] }}">{{ number_format($stats['done'], 0, ',', '.') }}</strong>
                    <span>Laporan selesai</span>
                </div>
                <div class="stat-item">
                    <strong data-count="{{ $stats['activities'] }}">{{ number_format($stats['activities'], 0, ',', '.') }}</strong>
                    <span>Kegiatan gotong royong</span>
                </div>
                <div class="stat-item">
                    <strong data-count="{{ $stats['volunteers'] }}">{{ number_format($stats['volunteers'], 0, ',', '.') }}</strong>
                    <span>Relawan terdaftar</span>
                </div>
            </div>
        </div>
    </section>

    <!-- MENU AKSI -->
    <section class="section">
        <div class="container">
            <div class="section-head">
                <h2>Apa yang bisa Anda lakukan?</h2>
                <p>Ada tiga cara ikut menjaga keindahan perairan Danau Toba.</p>
            </div>

            <div class="row g-4">
                <div class="col-12 col-md-4">
                    <div class="action-card featured">
                        <div class="action-icon"><i class="bi bi-camera-fill"></i></div>
                        <h3>Lapor Eceng Gondok</h3>
                        <p>Laporkan kondisi eceng gondok di sekitar kecamatan muara lengkap dengan foto</p>
                        <a href="/lapor" class="action-link">Lapor sekarang</a>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="action-card">
                        <div class="action-icon"><i class="bi bi-people-fill"></i></div>
                        <h3>Gotong Royong</h3>
                        <p>Ikut sebagai relawan dalam kegiatan pembersihan kecamatan muara yang dijadwalkan operator.</p>
                        <a href="/kegiatan" class="action-link">Lihat jadwal</a>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="action-card">
                        <div class="action-icon"><i class="bi bi-box2-heart-fill"></i></div>
                        <h3>Dukungan Masyarakat</h3>
                        <p>Salurkan donasi barang atau sponsorship untuk mendukung kebersihan muara secara transparan.</p>
                        <a href="/dukungan" class="action-link">Beri dukungan</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CARA KERJA -->
    <section class="section how">
        <div class="container">
            <div class="section-head">
                <h2>Dari laporan sampai kecamatan muara bersih</h2>
                <p>Semua laporan warga melewati alur yang sama, dan Anda bisa memantaunya kapan saja.</p>
            </div>

            <div class="row g-5 g-md-4">
                <div class="col-12 col-md-4">
                    <div class="step">
                        <div class="step-no">1</div>
                        <h3>Foto dan tandai lokasi</h3>
                        <p>Ambil foto eceng gondok, lalu buatkan alamatnya itu akan ikut tersimpan di laporan.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="step">
                        <div class="step-no">2</div>
                        <h3>Operator menindaklanjuti</h3>
                        <p>Laporan ditinjau, lalu kegiatan pembersihan dijadwalkan di halaman Kegiatan.</p>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="step">
                        <div class="step-no">3</div>
                        <h3>Warga bergotong royong</h3>
                        <p>Relawan turun ke lapangan, dan perkembangannya bisa dilihat di Lacak Laporan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- KEGIATAN TERDEKAT -->
    {{-- Maksimal 3 kegiatan terdekat yang sudah dipublikasikan (dari HomeController::$upcomingActivities) --}}
    <section class="section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-4">
                <div class="section-head mb-0">
                    <h2>Kegiatan gotong royong terdekat</h2>
                    <p>Pilih kegiatan yang ingin Anda ikuti, lalu daftar sebagai relawan.</p>
                </div>
                <a href="/kegiatan" class="link-all d-none d-md-inline">Lihat semua kegiatan <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="row g-4">
                @forelse($upcomingActivities as $a)
                    @php
                        $activeCount = $a->active_volunteers_count
                            ?? $a->volunteers()->whereIn('status', $activeVolunteerStatuses)->count();

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
                                    <span class="st {{ $closed ? 'st-muted' : 'st-done' }}">
                                        <i class="bi {{ $closed ? 'bi-lock-fill' : 'bi-check-circle-fill' }}"></i>
                                        {{ $past ? 'Sudah lewat' : ($remaining <= 0 ? 'Kuota penuh' : 'Pendaftaran dibuka') }}
                                    </span>
                                    <h3>{{ $a->title }}</h3>
                                </div>
                            </div>

                            <p class="event-desc">{{ \Illuminate\Support\Str::limit($a->description, 100) }}</p>

                            <ul class="event-info">
                                <li>
                                    <i class="bi bi-clock"></i>
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
                            <p>Belum ada jadwal kegiatan terdekat. Jadwal gotong royong akan tampil di sini.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-4 d-md-none">
                <a href="/kegiatan" class="link-all">Lihat semua kegiatan <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- LAPORAN WARGA -->
    {{-- Kiri: laporan yang sudah selesai (dengan foto). Kanan: daftar laporan terbaru.
         Hanya tiket, lokasi, dan status yang tampil; nama pelapor tidak ditampilkan. --}}
    <section class="section section-white">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-4">
                <div class="section-head mb-0">
                    <h2>Laporan warga</h2>
                    <p>Laporan yang sudah selesai ditangani dan laporan terbaru yang masuk.</p>
                </div>
                <a href="/lacak" class="link-all d-none d-md-inline">Lacak laporan <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="row g-4">

                <!-- Laporan selesai -->
                <div class="col-lg-8">
                    <div class="row g-4">
                        @forelse($completedReports as $report)
                            @php
                                $photoExists = $report->photo_path && $publicDisk->exists($report->photo_path);
                                $photoUrl = $photoExists ? asset('storage/' . $report->photo_path) : null;
                            @endphp

                            <div class="col-md-6">
                                <article class="done-card">

                                    <div class="done-photo">
                                        @if($photoExists)
                                            <a href="{{ $photoUrl }}" target="_blank" rel="noopener noreferrer" class="photo-link">
                                                <img src="{{ $photoUrl }}"
                                                     alt="Foto laporan {{ $report->ticket_number }}"
                                                     loading="lazy"
                                                     onerror="this.onerror=null; this.parentElement.style.display='none';">
                                            </a>
                                        @else
                                            <div class="photo-empty">
                                                <div>
                                                    <i class="bi bi-image"></i>
                                                    <span>Foto laporan tidak tersedia</span>
                                                </div>
                                            </div>
                                        @endif

                                        <span class="st"><i class="bi bi-check-circle-fill"></i>Selesai</span>
                                    </div>

                                    <div class="done-body">
                                        <span class="done-ticket">{{ $report->ticket_number }}</span>
                                        <h3>{{ $report->location_name }}</h3>

                                        <p class="done-meta"><i class="bi bi-geo-alt"></i>Tingkat: {{ ucfirst($report->density_level ?? '-') }}</p>
                                        <p class="done-meta"><i class="bi bi-calendar-check"></i>Diperbarui: {{ $report->updated_at?->format('d M Y') ?? '-' }}</p>

                                        <a href="{{ route('reports.track.result', $report->ticket_number) }}" class="btn-detail btn-spacer">
                                            Lihat detail laporan <i class="bi bi-arrow-right"></i>
                                        </a>
                                    </div>

                                </article>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="empty-state">
                                    <i class="bi bi-clipboard-check"></i>
                                    <p>Belum ada laporan yang berhasil diselesaikan.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Laporan terbaru -->
                <div class="col-lg-4">
                    <aside class="latest-card">
                        <h3><i class="bi bi-inbox-fill"></i>Laporan terbaru</h3>

                        @forelse($latestReports as $r)
                            <a href="{{ route('reports.track.result', $r->ticket_number) }}" class="latest-row">
                                <div>
                                    <strong>{{ $r->ticket_number }}</strong>
                                    <small>{{ \Illuminate\Support\Str::limit($r->location_name, 26) }} · {{ $r->created_at->format('d M Y') }}</small>
                                </div>
                                <span class="st {{ $pillOf($r->status) }}">{{ str_replace('_', ' ', $r->status) }}</span>
                            </a>
                        @empty
                            <p class="text-muted mb-3">Belum ada laporan yang masuk.</p>
                        @endforelse

                        <a href="/lacak" class="btn-detail mt-3">Lacak laporan Anda</a>
                    </aside>
                </div>

            </div>

            <div class="text-center mt-4 d-md-none">
                <a href="/lacak" class="link-all">Lacak laporan <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- DUKUNGAN MASYARAKAT -->
    {{-- Dukungan yang sudah diverifikasi admin (dari HomeController::$supports) --}}
    <section class="section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4">
                <div class="section-head mb-0">
                    <h2>Dukungan masyarakat</h2>
                    <p>Terima kasih untuk setiap dukungan yang sudah diverifikasi untuk Muara yang bersih.</p>
                </div>
                <div class="d-flex flex-wrap align-items-center gap-3">
                    <a href="/dukungan/ringkasan" class="link-all d-none d-md-inline">Lihat ringkasan donasi <i class="bi bi-arrow-right"></i></a>
                    <a href="/dukungan" class="btn btn-lake"><i class="bi bi-heart-fill me-2"></i>Beri dukungan</a>
                </div>
            </div>

            <div class="row g-4">
                @forelse($supports as $s)
                    @php
                        $donorName = $s->is_anonymous ? 'Hamba Allah (Anonim)' : $s->donor_name;
                        $initial = $s->is_anonymous ? null : mb_strtoupper(mb_substr(trim((string) $s->donor_name), 0, 1));
                    @endphp

                    <div class="col-md-6 col-lg-4">
                        <article class="support-card">

                            <div class="donor">
                                @if($initial)
                                    <div class="avatar" aria-hidden="true">{{ $initial }}</div>
                                @else
                                    <div class="avatar anon" aria-hidden="true"><i class="bi bi-person-fill"></i></div>
                                @endif

                                <div>
                                    <h3>{{ $donorName }}</h3>
                                    <span><i class="bi bi-geo-alt-fill"></i>Dari {{ $s->origin_rantau }}</span>
                                </div>
                            </div>

                            <span class="type-tag">
                                <i class="bi {{ $s->type === 'barang' ? 'bi-box-seam' : 'bi-cash-coin' }}"></i>{{ $s->type }}
                            </span>

                            <div class="detail-box">
                                <small>Detail dukungan</small>
                                <strong>{{ \Illuminate\Support\Str::limit($s->item_details, 90) }}</strong>
                            </div>

                            @if($s->message)
                                <div class="quote">
                                    <i class="bi bi-chat-quote-fill"></i>
                                    <p>"{{ \Illuminate\Support\Str::limit($s->message, 110) }}"</p>
                                </div>
                            @endif

                        </article>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <p>Belum ada dukungan terverifikasi saat ini. Jadilah yang pertama!</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-4 d-md-none">
                <a href="/dukungan/ringkasan" class="link-all">Lihat ringkasan donasi <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- GALERI -->
    <section class="section section-white">
        <div class="container">
            <div class="d-flex justify-content-between align-items-end flex-wrap gap-2 mb-4">
                <div class="section-head mb-0">
                    <h2>Aksi nyata di lapangan</h2>
                    <p>Dokumentasi warga dan relawan saat membersihkan eceng gondok.</p>
                </div>
                <a href="/galeri" class="link-all d-none d-md-inline">Lihat semua galeri <i class="bi bi-arrow-right"></i></a>
            </div>

            <div class="gallery-grid">
                <figure class="gallery-item">
                    <img src="{{ asset('storage/gallery/images/foto1.jpg.jpeg') }}" alt="Warga menarik eceng gondok dari muara" loading="lazy">
                    <figcaption>Warga Tarik Eceng Gondok</figcaption>
                </figure>
                <figure class="gallery-item">
                    <img src="{{ asset('storage/gallery/images/foto2.jpg.jpeg') }}" alt="Aksi bersih muara bersama warga" loading="lazy">
                    <figcaption>Aksi Bersih Muara</figcaption>
                </figure>
                <figure class="gallery-item">
                    <img src="{{ asset('storage/gallery/images/foto3.jpg.jpeg') }}" alt="Pembersihan tepi danau oleh relawan" loading="lazy">
                    <figcaption>Pembersihan Tepi Danau</figcaption>
                </figure>
            </div>

            <div class="text-center mt-4 d-md-none">
                <a href="/galeri" class="link-all">Lihat semua galeri <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- AJAKAN AKHIR -->
    <section class="container pt-5">
        <div class="cta-band d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-4">
            <div>
                <h2>Lihat eceng gondok di kecamatan muara?</h2>
                <p>Satu laporan dari Anda membantu operator bergerak lebih cepat.</p>
            </div>
            <a href="/lapor" class="btn btn-hero-primary btn-lg"><i class="bi bi-camera me-2"></i>Buat laporan</a>
        </div>
    </section>

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
                    <li><a href="https://share.google/xDlpW9zkXS06Y7jnK" target="_blank" rel="noopener noreferrer">Pelabuhan Muara</a></li>
                    <li><a href="http://lindup.taputkab.go.id/" target="_blank" rel="noopener noreferrer">Dinas Lingkungan Hidup</a></li>
                    <li><a href="http://kec-muara.taputkab.go.id/" target="_blank" rel="noopener noreferrer">Kecamatan Muara</a></li>
                </ul>
            </div>
            <div class="col-6 col-md-3">
                <p class="text-white fw-bold mb-2">Kontak Kami</p>
                <ul class="list-unstyled footer-links mb-0">
                    <li><a href="https://www.taputkab.go.id/" target="_blank" rel="noopener noreferrer">Tapanuli Utara</a></li>
                    <li><a href="mailto:diskominfo@taputkab.go.id">diskominfo@taputkab.go.id</a></li>
                    <li><a href="tel:+6263321220">+62 633 21220</a></li>
                    <li><a href="https://maps.google.com/?q=Jl.%20Letjen%20Suprapto%20No.1,%20TarutungTapanuli%20Utara,%20Sumatera%20Utara,22411" target="_blank" rel="noopener noreferrer">Jl. Letjen Suprapto No.1, Tarutung Tapanuli Utara, Sumatera Utara, 22411</a></li>
                </ul>
            </div>
        </div>
        <div class="copy text-center">&copy; 2026 College Project. Dibuat untuk memenuhi tugas project perkuliahan</div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Navbar transparan di atas hero, berubah solid saat halaman digulir
    (function () {
        var nav = document.getElementById('siteNav');
        function toggle() { nav.classList.toggle('scrolled', window.scrollY > 40); }
        toggle();
        window.addEventListener('scroll', toggle, { passive: true });
    })();

    // Angka statistik dihitung naik saat terlihat di layar (dilewati jika pengguna memilih "kurangi animasi")
    (function () {
        var els = document.querySelectorAll('[data-count]');
        if (!els.length) return;

        var reduce = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        function fmt(n) { return n.toLocaleString('id-ID'); }

        function run(el) {
            var target = parseInt(el.dataset.count, 10) || 0;
            if (reduce || target === 0) { el.textContent = fmt(target); return; }

            var start = null, duration = 1200;
            function step(ts) {
                if (!start) start = ts;
                var p = Math.min((ts - start) / duration, 1);
                el.textContent = fmt(Math.round(target * (1 - Math.pow(1 - p, 3))));
                if (p < 1) requestAnimationFrame(step);
            }
            requestAnimationFrame(step);
        }

        if (!('IntersectionObserver' in window)) { els.forEach(run); return; }

        els.forEach(function (el) { if (!reduce) el.textContent = '0'; });

        var io = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (e) {
                if (e.isIntersecting) { run(e.target); obs.unobserve(e.target); }
            });
        }, { threshold: 0.4 });

        els.forEach(function (el) { io.observe(el); });
    })();
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Terkirim — SIGAP KECAMATAN MUARA</title>

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
        .site-nav .navbar-toggler { border: 0; }
        .site-nav .navbar-toggler:focus { box-shadow: none; }
        .btn-nav-cta { background: var(--sun); color: var(--lake-950); font-weight: 700; border-radius: 50px; padding: .5rem 1.3rem; border: 0; }
        .btn-nav-cta:hover { background: #fff; color: var(--lake-950); }
        @media (max-width: 991.98px) { .site-nav .navbar-collapse.show, .site-nav .navbar-collapse.collapsing { margin-top: .6rem; padding: 1rem 0 .5rem; } }

        /* KONFIRMASI */
        .done-wrap { padding-top: 7.5rem; }
        .done-card { background: #fff; border: 1px solid var(--mint-100); border-radius: 32px; padding: 3rem 2.2rem; text-align: center; box-shadow: 0 18px 40px rgba(14,124,99,.1); }
        .check-circle { width: 96px; height: 96px; border-radius: 50%; display: inline-grid; place-items: center; background: var(--mint-100); color: var(--lake-600); font-size: 3.4rem; margin-bottom: 1.4rem; }
        @media (prefers-reduced-motion: no-preference) {
            .check-circle { animation: pop .6s cubic-bezier(.2,.9,.3,1.3) both; }
            @keyframes pop { from { transform: scale(.5); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        }
        .done-card h1 { font-weight: 800; font-size: clamp(1.8rem, 4vw, 2.5rem); color: var(--lake-800); letter-spacing: -.01em; margin-bottom: .6rem; }
        .done-card .lead-text { color: var(--ink-soft); font-size: 1.05rem; line-height: 1.7; margin-bottom: 1.8rem; }

        /* kotak tiket dengan takik di sisi */
        .ticket { position: relative; background: var(--mint-50); border: 2px dashed #8FD3B3; border-radius: 22px; padding: 1.4rem 1.5rem; margin-bottom: 1rem; }
        .ticket::before, .ticket::after { content: ''; position: absolute; top: 50%; width: 22px; height: 22px; border-radius: 50%; background: #fff; border: 1px solid var(--mint-100); transform: translateY(-50%); }
        .ticket::before { left: -12px; }
        .ticket::after { right: -12px; }
        .ticket small { display: block; color: var(--ink-soft); margin-bottom: .2rem; font-weight: 600; }
        .ticket-number { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: clamp(1.8rem, 6vw, 2.8rem); letter-spacing: 2px; color: var(--lake-950); margin: 0; overflow-wrap: anywhere; }
        .btn-copy { display: inline-flex; align-items: center; gap: .5rem; background: transparent; border: 0; color: var(--lake-600); font-weight: 700; padding: .4rem .8rem; border-radius: 50px; }
        .btn-copy:hover { background: var(--mint-100); }
        .save-note { color: var(--ink-soft); font-size: .92rem; margin-bottom: 2rem; }

        .btn-lake { background: var(--lake-600); color: #fff; font-weight: 700; border: 0; border-radius: 50px; padding: .85rem 1.8rem; transition: background .2s ease, transform .2s ease; }
        .btn-lake:hover { background: var(--lake-800); color: #fff; transform: translateY(-2px); }
        .btn-ghost { display: inline-flex; align-items: center; justify-content: center; gap: .5rem; text-decoration: none; font-weight: 700; color: var(--lake-600); border: 2px solid var(--lake-600); border-radius: 50px; padding: .8rem 1.6rem; transition: background .2s ease, color .2s ease; }
        .btn-ghost:hover { background: var(--lake-600); color: #fff; }

        /* langkah selanjutnya */
        .next-steps { margin-top: 2rem; }
        .next-steps h2 { font-weight: 800; font-size: 1.3rem; color: var(--lake-800); margin-bottom: 1.2rem; }
        .next-step { display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1rem; }
        .next-no { width: 36px; height: 36px; flex-shrink: 0; border-radius: 50%; display: grid; place-items: center; background: var(--lake-800); color: #fff; font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; }
        .next-step strong { display: block; color: var(--ink); }
        .next-step span { color: var(--ink-soft); font-size: .92rem; line-height: 1.6; }

        /* FOOTER */
        .site-footer { background: var(--lake-950); color: rgba(255,255,255,.75); padding: 3.5rem 0 1.8rem; margin-top: 4.5rem; }
        .site-footer .brand-name { color: #fff; font-weight: 800; font-size: 1.4rem; }
        .site-footer a { color: rgba(255,255,255,.75); text-decoration: none; }
        .site-footer a:hover { color: #fff; text-decoration: underline; }
        .site-footer .footer-links li { margin-bottom: .45rem; }
        .site-footer .copy { border-top: 1px solid rgba(255,255,255,.14); margin-top: 2.2rem; padding-top: 1.2rem; font-size: .88rem; }

        @media (max-width: 575.98px) {
            .done-card { padding: 2rem 1.2rem; border-radius: 26px; }
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
                <li class="nav-item"><a class="nav-link" href="/lacak">Lacak Laporan</a></li>
                <li class="nav-item ms-lg-3 mt-2 mt-lg-0"><a class="btn btn-nav-cta" href="{{ route('reports.create') }}"><i class="bi bi-camera me-1"></i> Buat Laporan</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="container done-wrap">
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="done-card">

                <div class="check-circle"><i class="bi bi-check-circle-fill"></i></div>

                <h1>Laporan berhasil dikirim!</h1>
                <p class="lead-text">Terima kasih telah peduli. Simpan nomor tiket ini untuk melacak status laporan Anda.</p>

                <div class="ticket">
                    <small>Nomor tiket</small>
                    <p class="ticket-number" id="ticketNumber">{{ $report->ticket_number }}</p>
                </div>

                <button type="button" class="btn-copy" id="copyBtn">
                    <i class="bi bi-clipboard"></i><span id="copyText">Salin nomor tiket</span>
                </button>

                <p class="save-note mt-2">Catat atau tangkap layar nomor ini. Anda memerlukannya untuk membuka halaman status laporan.</p>

                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                    <a href="{{ route('reports.track.result', $report->ticket_number) }}" class="btn btn-lake btn-lg">
                        <i class="bi bi-search me-2"></i>Lihat status laporan
                    </a>
                    <a href="/" class="btn-ghost btn-lg">
                        <i class="bi bi-house-door"></i>Ke beranda
                    </a>
                </div>

                <div class="next-steps text-start">
                    <h2>Apa selanjutnya?</h2>

                    <div class="next-step">
                        <div class="next-no">1</div>
                        <div>
                            <strong>Petugas memeriksa laporan</strong>
                            <span>Laporan Anda ditinjau dan diverifikasi oleh operator.</span>
                        </div>
                    </div>

                    <div class="next-step">
                        <div class="next-no">2</div>
                        <div>
                            <strong>Penanganan dijadwalkan</strong>
                            <span>Pembersihan dijadwalkan, dan warga bisa ikut lewat halaman Kegiatan.</span>
                        </div>
                    </div>

                    <div class="next-step mb-0">
                        <div class="next-no">3</div>
                        <div>
                            <strong>Pantau perkembangannya</strong>
                            <span>Buka Lacak Laporan kapan saja dengan nomor tiket di atas.</span>
                        </div>
                    </div>
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
<script>
    // Salin nomor tiket ke papan klip
    (function () {
        var btn = document.getElementById('copyBtn');
        var label = document.getElementById('copyText');
        var ticket = document.getElementById('ticketNumber').textContent.trim();

        function done(ok) {
            label.textContent = ok ? 'Nomor tiket tersalin' : 'Salin manual nomor di atas';
            setTimeout(function () { label.textContent = 'Salin nomor tiket'; }, 2200);
        }

        btn.addEventListener('click', function () {
            if (navigator.clipboard && window.isSecureContext) {
                navigator.clipboard.writeText(ticket).then(function () { done(true); }, function () { done(false); });
            } else {
                var tmp = document.createElement('textarea');
                tmp.value = ticket;
                document.body.appendChild(tmp);
                tmp.select();
                var ok = false;
                try { ok = document.execCommand('copy'); } catch (e) {}
                document.body.removeChild(tmp);
                done(ok);
            }
        });
    })();
</script>
</body>
</html>
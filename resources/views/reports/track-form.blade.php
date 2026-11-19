<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lacak Laporan — SIGAP KECAMATAN MUARA</title>

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
        .page-head { background: linear-gradient(135deg, var(--lake-800), var(--lake-950)); color: #fff; padding: 7rem 0 5.5rem; border-radius: 0 0 36px 36px; }
        .head-badge { display: inline-flex; align-items: center; gap: .5rem; background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.28); padding: .4rem 1rem; border-radius: 50px; font-weight: 600; font-size: .9rem; }
        .head-badge i { color: var(--sun); }
        .page-head h1 { font-weight: 800; font-size: clamp(2rem, 4.8vw, 3.2rem); line-height: 1.08; letter-spacing: -.02em; margin: 1.1rem 0 .8rem; }
        .page-head p { color: rgba(255,255,255,.88); font-size: 1.08rem; line-height: 1.7; max-width: 58ch; margin: 0; }
        .btn-sun { background: var(--sun); color: var(--lake-950); font-weight: 700; border: 0; border-radius: 50px; padding: .8rem 1.7rem; white-space: nowrap; transition: background .2s ease, transform .2s ease; }
        .btn-sun:hover { background: #fff; color: var(--lake-950); transform: translateY(-2px); }

        /* PANEL PENCARIAN */
        .search-panel { background: #fff; border: 1px solid var(--mint-100); border-radius: 28px; padding: 1.8rem; margin-top: -3.2rem; position: relative; z-index: 2; box-shadow: 0 18px 40px rgba(3,39,31,.12); }
        .search-tabs { gap: .5rem; margin-bottom: 1.3rem; }
        .search-tabs .nav-link { color: var(--lake-800); font-weight: 700; border-radius: 50px; padding: .55rem 1.2rem; background: var(--mint-50); }
        .search-tabs .nav-link.active { background: var(--lake-800); color: #fff; }
        .search-label { font-weight: 700; color: var(--lake-800); margin-bottom: .45rem; display: block; }
        .search-group { display: flex; gap: .6rem; flex-wrap: wrap; }
        .search-input { flex: 1 1 260px; display: flex; align-items: center; gap: .7rem; border: 1.5px solid #D4E6DC; border-radius: 50px; padding: 0 1.2rem; background: #FCFEFD; }
        .search-input:focus-within { border-color: var(--leaf); box-shadow: 0 0 0 .22rem rgba(16,185,129,.18); }
        .search-input i { color: var(--lake-600); font-size: 1.15rem; }
        .search-input input { border: 0; outline: 0; background: transparent; width: 100%; padding: .95rem 0; font-size: 1rem; }
        .btn-lake { background: var(--lake-600); color: #fff; font-weight: 700; border: 0; border-radius: 50px; padding: .85rem 2rem; transition: background .2s ease; }
        .btn-lake:hover { background: var(--lake-800); color: #fff; }
        .alert { border: 0; border-radius: 16px; }

        /* JUDUL BAGIAN */
        .sec-head { display: flex; align-items: center; gap: 1rem; margin-bottom: 1.6rem; }
        .sec-icon { width: 52px; height: 52px; border-radius: 16px; display: grid; place-items: center; font-size: 1.4rem; background: var(--mint-100); color: var(--lake-600); flex-shrink: 0; }
        .sec-head h2 { font-weight: 800; font-size: 1.6rem; color: var(--lake-800); margin: 0 0 .15rem; }
        .sec-head p { color: var(--ink-soft); margin: 0; }

        /* KARTU LAPORAN SELESAI */
        .done-card { height: 100%; display: flex; flex-direction: column; background: #fff; border: 1px solid var(--mint-100); border-radius: 24px; overflow: hidden; transition: transform .25s ease, box-shadow .25s ease; }
        .done-card:hover { transform: translateY(-5px); box-shadow: 0 18px 40px rgba(14,124,99,.15); }
        .done-photo { position: relative; aspect-ratio: 16 / 10; background: var(--mint-100); }
        .done-photo img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .done-photo .photo-link { display: block; height: 100%; }
        .photo-empty { height: 100%; display: grid; place-items: center; text-align: center; color: var(--lake-600); }
        .photo-empty i { font-size: 2.2rem; display: block; }
        .photo-empty span { font-size: .85rem; color: var(--ink-soft); }
        .st { display: inline-flex; align-items: center; gap: .4rem; font-size: .8rem; font-weight: 700; padding: .3rem .85rem; border-radius: 50px; }
        .st-done { background: var(--mint-100); color: var(--lake-600); }
        .done-photo .st { position: absolute; top: 12px; left: 12px; background: rgba(3,39,31,.85); color: #fff; }
        .done-body { padding: 1.3rem 1.4rem 1.5rem; display: flex; flex-direction: column; flex-grow: 1; }
        .done-ticket { color: var(--lake-600); font-weight: 700; font-size: .9rem; }
        .done-body h3 { font-weight: 800; font-size: 1.15rem; color: var(--lake-800); margin: .15rem 0 .7rem; }
        .done-meta { color: var(--ink-soft); font-size: .88rem; margin-bottom: .3rem; display: flex; gap: .5rem; align-items: center; }
        .btn-detail { margin-top: auto; display: flex; align-items: center; justify-content: center; gap: .5rem; text-decoration: none; font-weight: 700; color: var(--lake-600); border: 2px solid var(--lake-600); border-radius: 50px; padding: .65rem 1.2rem; transition: background .2s ease, color .2s ease; }
        .btn-detail:hover { background: var(--lake-600); color: #fff; }
        .done-body .btn-spacer { margin-top: 1rem; }

        .empty-state { background: #fff; border: 1.5px dashed #A9DCC3; border-radius: 24px; padding: 2.8rem 1.5rem; text-align: center; color: var(--ink-soft); }
        .empty-state i { font-size: 2.4rem; color: var(--leaf); display: block; margin-bottom: .6rem; }
        .empty-state p { margin: 0; }

        /* DAFTAR TIKET */
        .ticket-accordion .accordion-item { border: 1px solid var(--mint-100); border-radius: 22px; overflow: hidden; background: #fff; }
        .ticket-accordion .accordion-button { background: #fff; color: var(--lake-800); font-weight: 700; box-shadow: none; padding: 1.2rem 1.4rem; }
        .ticket-accordion .accordion-button:not(.collapsed) { background: var(--mint-50); color: var(--lake-800); }
        .ticket-accordion .accordion-button:focus { box-shadow: none; }
        .count-badge { background: var(--lake-600); color: #fff; border-radius: 50px; font-size: .8rem; padding: .15rem .7rem; margin-left: .6rem; }
        .ticket-row { display: flex; align-items: center; justify-content: space-between; gap: 1rem; padding: .85rem .3rem; border-bottom: 1px solid #E8EFEB; }
        .ticket-row:last-child { border-bottom: 0; }
        .ticket-row i { color: var(--lake-600); }
        .ticket-row strong { font-weight: 700; }
        .ticket-tag { font-size: .78rem; color: var(--ink-soft); background: var(--mint-50); border: 1px solid #D4E6DC; padding: .2rem .7rem; border-radius: 50px; white-space: nowrap; }
        .pagination { --bs-pagination-active-bg: var(--lake-600); --bs-pagination-active-border-color: var(--lake-600); --bs-pagination-color: var(--lake-600); }

        /* FOOTER */
        .site-footer { background: var(--lake-950); color: rgba(255,255,255,.75); padding: 3.5rem 0 1.8rem; margin-top: 4.5rem; }
        .site-footer .brand-name { color: #fff; font-weight: 800; font-size: 1.4rem; }
        .site-footer a { color: rgba(255,255,255,.75); text-decoration: none; }
        .site-footer a:hover { color: #fff; text-decoration: underline; }
        .site-footer .footer-links li { margin-bottom: .45rem; }
        .site-footer .copy { border-top: 1px solid rgba(255,255,255,.14); margin-top: 2.2rem; padding-top: 1.2rem; font-size: .88rem; }

        @media (max-width: 575.98px) {
            .page-head { padding: 6.5rem 0 5rem; border-radius: 0 0 26px 26px; }
            .search-panel { padding: 1.3rem; }
            .sec-head h2 { font-size: 1.3rem; }
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
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end gap-4">
            <div>
                <span class="head-badge"><i class="bi bi-search"></i> Pantau laporan Anda</span>
                <h1>Lacak status laporan</h1>
                <p>Pantau perkembangan laporan Anda lewat nomor tiket atau nomor HP yang digunakan saat melapor.</p>
            </div>
            <a href="{{ route('reports.create') }}" class="btn btn-sun btn-lg">
                <i class="bi bi-plus-circle-fill me-2"></i>Buat laporan baru
            </a>
        </div>
    </div>
</header>

<main class="container">

    <!-- PENCARIAN -->
    @php
        $openPhoneTab = old('phone') && ! old('ticket');
    @endphp

    <section class="search-panel">

        <!-- PESAN ERROR -->
        @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <ul class="nav nav-pills search-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $openPhoneTab ? '' : 'active' }}" id="tab-ticket" data-bs-toggle="pill" data-bs-target="#pane-ticket" type="button" role="tab" aria-controls="pane-ticket" aria-selected="{{ $openPhoneTab ? 'false' : 'true' }}">
                    <i class="bi bi-ticket-perforated me-1"></i>Nomor tiket
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $openPhoneTab ? 'active' : '' }}" id="tab-phone" data-bs-toggle="pill" data-bs-target="#pane-phone" type="button" role="tab" aria-controls="pane-phone" aria-selected="{{ $openPhoneTab ? 'true' : 'false' }}">
                    <i class="bi bi-phone me-1"></i>Nomor HP
                </button>
            </li>
        </ul>

        <div class="tab-content">

            <!-- CARI NOMOR TIKET -->
            <div class="tab-pane fade {{ $openPhoneTab ? '' : 'show active' }}" id="pane-ticket" role="tabpanel" aria-labelledby="tab-ticket" tabindex="0">
                <form action="{{ route('reports.track') }}" method="GET">
                    <label class="search-label" for="ticket">Cari menggunakan nomor tiket</label>
                    <div class="search-group">
                        <div class="search-input">
                            <i class="bi bi-ticket-perforated"></i>
                            <input type="text" name="ticket" id="ticket" placeholder="Contoh: SM-2026-0001" value="{{ old('ticket') }}" required>
                        </div>
                        <button class="btn btn-lake" type="submit">Lacak</button>
                    </div>
                </form>
            </div>

            <!-- CARI NOMOR HP -->
            <div class="tab-pane fade {{ $openPhoneTab ? 'show active' : '' }}" id="pane-phone" role="tabpanel" aria-labelledby="tab-phone" tabindex="0">
                <form action="{{ route('reports.track.phone') }}" method="POST">
                    @csrf
                    <label class="search-label" for="phone">Cari menggunakan nomor HP</label>
                    <div class="search-group">
                        <div class="search-input">
                            <i class="bi bi-phone"></i>
                            <input type="text" name="phone" id="phone" placeholder="Contoh: 08123456789" value="{{ old('phone') }}" required>
                        </div>
                        <button class="btn btn-lake" type="submit">Cari</button>
                    </div>
                </form>
            </div>

        </div>
    </section>

    <!-- LAPORAN BERHASIL DISELESAIKAN -->
    <section class="pt-5 mt-3">
        <div class="sec-head">
            <div class="sec-icon"><i class="bi bi-check-circle-fill"></i></div>
            <div>
                <h2>Laporan berhasil diselesaikan</h2>
                <p>Beberapa laporan warga yang sudah selesai ditangani.</p>
            </div>
        </div>

        <div class="row g-4">
            @forelse($completedReports as $report)
                @php
                    $photoExists = $report->photo_path
                        && \Illuminate\Support\Facades\Storage::disk('public')->exists($report->photo_path);

                    $photoUrl = $photoExists
                        ? asset('storage/' . $report->photo_path)
                        : null;
                @endphp

                <div class="col-md-6 col-lg-4">
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
    </section>

    <!-- DAFTAR NOMOR TIKET MASUK -->
    <section class="pt-5 mt-3">
        <div class="sec-head">
            <div class="sec-icon"><i class="bi bi-ticket-perforated"></i></div>
            <div>
                <h2>Daftar laporan masuk</h2>
                <p>Nomor tiket laporan yang telah diterima SIGAP KECAMATAN MUARA.</p>
            </div>
        </div>

        <div class="accordion ticket-accordion" id="ticketAccordion">
            <div class="accordion-item">
                <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button"
                            data-bs-toggle="collapse" data-bs-target="#ticketList"
                            aria-expanded="false" aria-controls="ticketList">
                        <i class="bi bi-ticket-perforated me-2 fs-5"></i>
                        Daftar nomor tiket masuk
                        <span class="count-badge">{{ $reportTickets->total() }}</span>
                    </button>
                </h3>

                <div id="ticketList" class="accordion-collapse collapse" data-bs-parent="#ticketAccordion">
                    <div class="accordion-body p-4">
                        <p class="text-muted small mb-3">
                            Nomor tiket berikut merupakan laporan yang telah berhasil dikirim.
                        </p>

                        @forelse($reportTickets as $ticket)
                            <div class="ticket-row">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="bi bi-ticket-perforated fs-5"></i>
                                    <strong>{{ $ticket->ticket_number }}</strong>
                                </div>
                                <span class="ticket-tag">Tiket masuk</span>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="bi bi-inbox fs-1 text-secondary"></i>
                                <p class="text-muted mb-0 mt-2">Belum ada laporan yang masuk.</p>
                            </div>
                        @endforelse

                        @if($reportTickets->hasPages())
                            <div class="mt-4 d-flex justify-content-center">
                                {{ $reportTickets->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
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
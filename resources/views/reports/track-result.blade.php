<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Lacak — SIGAP KECAMATAN MUARA</title>

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
        .page-head { background: linear-gradient(135deg, var(--lake-800), var(--lake-950)); color: #fff; padding: 7rem 0 3.2rem; border-radius: 0 0 36px 36px; }
        .head-badge { display: inline-flex; align-items: center; gap: .5rem; background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.28); padding: .4rem 1rem; border-radius: 50px; font-weight: 600; font-size: .9rem; }
        .head-badge i { color: var(--sun); }
        .page-head h1 { font-weight: 800; font-size: clamp(2rem, 4.8vw, 3.1rem); letter-spacing: .02em; line-height: 1.1; margin: 1.1rem 0 .7rem; overflow-wrap: anywhere; }
        .page-head p { color: rgba(255,255,255,.88); font-size: 1.05rem; margin: 0; display: flex; align-items: center; gap: .5rem; }
        .page-head p i { color: var(--sun); }

        /* KARTU */
        .panel { background: #fff; border: 1px solid var(--mint-100); border-radius: 28px; padding: 2.2rem; margin-bottom: 1.5rem; }
        .panel-title { font-weight: 800; font-size: 1.3rem; color: var(--lake-800); margin-bottom: 1.2rem; display: flex; align-items: center; gap: .6rem; }
        .panel-title i { color: var(--lake-600); }
        .alert { border: 0; border-radius: 16px; }

        /* BANNER STATUS */
        .banner { display: flex; gap: 1rem; align-items: flex-start; border-radius: 22px; padding: 1.3rem 1.4rem; margin-bottom: 1.5rem; }
        .banner > i { font-size: 1.8rem; flex-shrink: 0; line-height: 1; }
        .banner h2 { font-size: 1.2rem; font-weight: 800; margin: 0 0 .2rem; }
        .banner p { margin: 0; line-height: 1.6; }
        .banner-done { background: var(--mint-100); color: var(--lake-800); }
        .banner-bad { background: #FDE2E2; color: #7A1A12; }
        .banner-wait { background: #FFF1CC; color: #6B4700; }
        .banner-info { background: #DDF3FA; color: #0A5266; }
        .banner-new { background: #E0ECFF; color: #1E3A8A; }

        /* INFO */
        .info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.8rem; }
        .info-tile { background: var(--mint-50); border-radius: 18px; padding: 1rem 1.2rem; }
        .info-tile small { color: var(--ink-soft); display: block; margin-bottom: .2rem; }
        .info-tile strong { font-weight: 700; text-transform: none; }
        .info-tile .cap { text-transform: capitalize; }

        /* FOTO */
        .photo-section { background: var(--mint-50); border: 1px solid var(--mint-100); border-radius: 22px; padding: 1.4rem; margin-bottom: 1.8rem; }
        .photo-section .panel-title { font-size: 1.1rem; margin-bottom: 1rem; }
        .report-photo { width: 100%; max-height: 380px; min-height: 200px; object-fit: cover; border-radius: 16px; border: 1px solid var(--mint-100); display: block; background: var(--mint-100); }
        .photo-placeholder { min-height: 200px; border: 1.5px dashed #A9DCC3; border-radius: 16px; display: grid; place-items: center; text-align: center; color: var(--ink-soft); }
        .photo-placeholder i { font-size: 2.4rem; color: var(--leaf); display: block; }

        /* RIWAYAT */
        .history-item { border-left: 3px solid #CDEBDC; padding: 0 0 1.6rem 1.5rem; position: relative; margin-left: .4rem; }
        .history-item:last-child { padding-bottom: 0; border-left-color: transparent; }
        .history-item::before { content: ""; position: absolute; left: -9px; top: 2px; width: 15px; height: 15px; border-radius: 50%; background: var(--leaf); border: 3px solid #fff; box-shadow: 0 0 0 2px #CDEBDC; }
        .history-item:first-child::before { background: var(--lake-600); box-shadow: 0 0 0 2px var(--lake-600); }
        .history-status { font-weight: 800; color: var(--lake-600); }
        .history-item p { color: var(--ink-soft); margin: .15rem 0 .3rem; line-height: 1.6; }
        .history-item small { color: #6B7C75; display: inline-flex; align-items: center; gap: .35rem; }

        /* DISKUSI */
        .intro-text { color: var(--ink-soft); font-size: .92rem; margin: -.6rem 0 1.5rem; }
        .chat-row { display: flex; margin-bottom: 1rem; }
        .chat-row.admin { justify-content: flex-end; }
        .chat-bubble { max-width: 85%; padding: .9rem 1.1rem; }
        .chat-warga { background: var(--mint-50); border: 1px solid #CDEBDC; border-radius: 18px 18px 18px 4px; }
        .chat-admin { background: #E3F1FB; border: 1px solid #BFDDF2; border-radius: 18px 18px 4px 18px; }
        .chat-name { font-weight: 700; font-size: .85rem; margin-bottom: .4rem; display: flex; align-items: center; gap: .4rem; }
        .chat-warga .chat-name i { color: var(--lake-600); }
        .chat-admin .chat-name i { color: #1D6FA8; }
        .chat-time { color: #6B7C75; font-size: .72rem; text-align: right; margin-top: .5rem; }
        .chat-empty { text-align: center; background: var(--mint-50); border-radius: 18px; padding: 1.8rem 1rem; color: var(--ink-soft); }
        .chat-empty i { font-size: 2rem; color: var(--leaf); display: block; margin-bottom: .4rem; }
        .chat-empty p { margin: 0; }
        .comment-divider { border-color: var(--mint-100); opacity: 1; margin: 1.8rem 0; }

        .form-label { color: var(--lake-800); font-weight: 700; font-size: .92rem; margin-bottom: .35rem; }
        .form-control { border-radius: 14px; padding: .8rem 1rem; border: 1.5px solid #D4E6DC; background: #FCFEFD; }
        .form-control:focus { border-color: var(--leaf); box-shadow: 0 0 0 .22rem rgba(16,185,129,.18); }
        .btn-lake { background: var(--lake-600); color: #fff; font-weight: 700; border: 0; border-radius: 50px; padding: .8rem 1.8rem; transition: background .2s ease, transform .2s ease; }
        .btn-lake:hover { background: var(--lake-800); color: #fff; transform: translateY(-2px); }
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
            .page-head { padding: 6.5rem 0 2.6rem; border-radius: 0 0 26px 26px; }
            .panel { padding: 1.4rem; }
            .info-grid { grid-template-columns: 1fr; }
            .chat-bubble { max-width: 94%; }
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
        <span class="head-badge"><i class="bi bi-file-earmark-text"></i> Status laporan</span>
        <h1>{{ $report->ticket_number }}</h1>
        <p><i class="bi bi-geo-alt-fill"></i>{{ $report->location_name }}</p>
    </div>
</header>

<main class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <!-- PESAN -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali input Anda:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- STATUS LAPORAN -->
            <div class="panel">

                @if($report->status === 'SELESAI')
                    <div class="banner banner-done">
                        <i class="bi bi-check-circle-fill"></i>
                        <div>
                            <h2>Laporan selesai</h2>
                            <p>Laporan Anda telah selesai ditangani.</p>
                        </div>
                    </div>

                @elseif($report->status === 'DITOLAK')
                    <div class="banner banner-bad">
                        <i class="bi bi-x-circle-fill"></i>
                        <div>
                            <h2>Laporan ditolak</h2>
                            <p>Silakan periksa keterangan pada riwayat status.</p>
                        </div>
                    </div>

                @elseif($report->status === 'DITUNDA')
                    <div class="banner banner-wait">
                        <i class="bi bi-pause-circle-fill"></i>
                        <div>
                            <h2>Laporan ditunda</h2>
                            <p>Penanganan laporan belum dapat dilaksanakan.</p>
                        </div>
                    </div>

                @elseif($report->status === 'BUTUH_DUKUNGAN')
                    <div class="banner banner-info">
                        <i class="bi bi-heart-fill"></i>
                        <div>
                            <h2>Membutuhkan dukungan</h2>
                            <p>Laporan membutuhkan dukungan tambahan.</p>
                        </div>
                    </div>

                @elseif(in_array($report->status, ['DIVERIFIKASI', 'DIJADWALKAN', 'DITANGANI']))
                    <div class="banner banner-wait">
                        <i class="bi bi-arrow-repeat"></i>
                        <div>
                            <h2>Laporan sedang diproses</h2>
                            <p>Petugas sedang menindaklanjuti laporan Anda.</p>
                        </div>
                    </div>

                @else
                    <div class="banner banner-new">
                        <i class="bi bi-inbox-fill"></i>
                        <div>
                            <h2>Laporan diterima</h2>
                            <p>Laporan menunggu verifikasi petugas.</p>
                        </div>
                    </div>
                @endif

                <!-- INFORMASI LAPORAN -->
                <div class="info-grid">
                    <div class="info-tile">
                        <small>Lokasi laporan</small>
                        <strong>{{ $report->location_name }}</strong>
                    </div>

                    <div class="info-tile">
                        <small>Tingkat kepadatan</small>
                        <strong class="cap">{{ $report->density_level ?? '-' }}</strong>
                    </div>
                </div>

                <!-- FOTO LAPORAN -->
                <div class="photo-section">
                    <h2 class="panel-title"><i class="bi bi-image"></i>Foto laporan</h2>

                    @php
                        $photoExists = $report->photo_path
                            && \Illuminate\Support\Facades\Storage::disk('public')->exists($report->photo_path);

                        $photoUrl = $photoExists
                            ? asset('storage/' . $report->photo_path)
                            : null;
                    @endphp

                    @if($photoExists)
                        <a href="{{ $photoUrl }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ $photoUrl }}"
                                 alt="Foto laporan {{ $report->ticket_number }}"
                                 class="report-photo"
                                 loading="lazy">
                        </a>

                        <p class="text-muted small mt-2 mb-0">
                            <i class="bi bi-zoom-in me-1"></i>Klik foto untuk melihat ukuran penuh.
                        </p>
                    @else
                        <div class="photo-placeholder">
                            <div>
                                <i class="bi bi-image"></i>
                                <span class="small">Foto laporan belum tersedia.</span>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- RIWAYAT STATUS -->
                <h2 class="panel-title"><i class="bi bi-clock-history"></i>Riwayat penanganan</h2>

                @forelse($report->statusHistories as $history)
                    <div class="history-item">
                        <div class="history-status">{{ str_replace('_', ' ', $history->status) }}</div>

                        <p>{{ $history->description ?? 'Status laporan diperbarui.' }}</p>

                        <small><i class="bi bi-calendar3"></i>{{ $history->created_at->format('d M Y, H:i') }}</small>
                    </div>
                @empty
                    <p class="text-muted mb-0">Belum ada riwayat penanganan.</p>
                @endforelse

            </div>

            <!-- KOMENTAR DAN DISKUSI -->
            <div class="panel" id="diskusi">

                <h2 class="panel-title"><i class="bi bi-chat-dots-fill"></i>Diskusi laporan</h2>
                <p class="intro-text">Gunakan kolom ini untuk bertanya mengenai perkembangan laporan.</p>

                <div>
                    @forelse($report->comments as $comment)
                        <div class="chat-row {{ $comment->sender_type === 'ADMIN' ? 'admin' : '' }}">
                            <div class="chat-bubble {{ $comment->sender_type === 'ADMIN' ? 'chat-admin' : 'chat-warga' }}">

                                <div class="chat-name">
                                    @if($comment->sender_type === 'ADMIN')
                                        <i class="bi bi-shield-check"></i>{{ $comment->sender_name ?? 'Admin' }}
                                    @else
                                        <i class="bi bi-person-circle"></i>{{ $comment->sender_name ?? 'Warga' }}
                                    @endif
                                </div>

                                <div style="white-space: pre-wrap; overflow-wrap: anywhere;">{{ $comment->message }}</div>

                                <div class="chat-time">{{ $comment->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                    @empty
                        <div class="chat-empty">
                            <i class="bi bi-chat-square-text"></i>
                            <p>Belum ada percakapan pada laporan ini.</p>
                        </div>
                    @endforelse
                </div>

                <hr class="comment-divider">

                <!-- FORM KOMENTAR WARGA -->
                @if(!$report->is_anonymous)
                    <h3 class="h6 fw-bold mb-3" style="color: var(--lake-800);">Kirim pertanyaan atau komentar</h3>

                    <form action="{{ route('reports.comments.store', $report->ticket_number) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="phone">Nomor HP pelapor</label>
                            <input type="tel" name="phone" id="phone"
                                class="form-control"
                                placeholder="Masukkan nomor HP saat membuat laporan"
                                value="{{ old('phone') }}"
                                maxlength="20"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="message">Pesan</label>
                            <textarea name="message" id="message"
                                class="form-control"
                                rows="4"
                                maxlength="2000"
                                placeholder="Tuliskan pertanyaan atau kendala Anda..."
                                required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="btn btn-lake">
                            <i class="bi bi-send-fill me-2"></i>Kirim komentar
                        </button>
                    </form>
                @else
                    <div class="alert alert-secondary mb-0">
                        Laporan anonim belum dapat menggunakan fitur komentar ini.
                    </div>
                @endif
            </div>

            <!-- KEMBALI -->
            <div class="text-center mt-4">
                <a href="{{ route('reports.track') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>Lacak tiket lain
                </a>
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
@if(session('success') || session('error') || $errors->any())
<script>
    // Setelah kirim komentar, arahkan layar ke bagian diskusi
    document.getElementById('diskusi').scrollIntoView({ block: 'start' });
</script>
@endif
</body>
</html>
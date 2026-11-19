@php
    // Nomor WhatsApp admin dari config/support.php (boleh diawali 0, 62, atau +62)
    $waNumber = preg_replace('/\D+/', '', (string) config('support.whatsapp_admin'));
    if ($waNumber !== '' && str_starts_with($waNumber, '0')) {
        $waNumber = '62' . substr($waNumber, 1);
    }
    $waAsk = $waNumber
        ? 'https://wa.me/' . $waNumber . '?text=' . rawurlencode('Halo Admin SIGAP Kecamatan Muara, saya ingin bertanya tentang dukungan.')
        : null;

    // Ringkasan angka dari daftar yang tampil (hanya yang sudah diverifikasi)
    $totalSupports = $supports->count();
    $totalFunds = $supports->sum('transfer_amount');
    $totalGoods = $supports->where('type', 'barang')->count();
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Dukungan — SIGAP KECAMATAN MUARA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --lake-950: #03271F; --lake-800: #08463A; --lake-600: #0E7C63; --leaf: #10B981;
            --mint-100: #E3F6EC; --mint-50: #F4FBF7; --sun: #F6B93B; --ink: #17302A; --ink-soft: #4C6159;
            --wa: #1FA855;
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
        .page-head p { color: rgba(255,255,255,.88); font-size: 1.08rem; line-height: 1.7; max-width: 58ch; margin: 0; }
        .btn-sun { background: var(--sun); color: var(--lake-950); font-weight: 700; border: 0; border-radius: 50px; padding: .8rem 1.7rem; white-space: nowrap; transition: background .2s ease, transform .2s ease; }
        .btn-sun:hover { background: #fff; color: var(--lake-950); transform: translateY(-2px); }

        /* RINGKASAN ANGKA */
        .stat-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; margin-bottom: 2rem; }
        .stat { background: #fff; border: 1px solid var(--mint-100); border-radius: 22px; padding: 1.2rem 1.4rem; display: flex; align-items: center; gap: 1rem; }
        .stat-icon { width: 48px; height: 48px; flex-shrink: 0; border-radius: 15px; display: grid; place-items: center; background: var(--mint-100); color: var(--lake-600); font-size: 1.3rem; }
        .stat small { display: block; color: var(--ink-soft); font-weight: 600; font-size: .85rem; }
        .stat strong { display: block; font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 1.6rem; color: var(--lake-800); line-height: 1.15; }
        @media (max-width: 767.98px) { .stat-grid { grid-template-columns: 1fr; } }

        /* KARTU DUKUNGAN */
        .support-card { height: 100%; display: flex; flex-direction: column; background: #fff; border: 1px solid var(--mint-100); border-radius: 26px; padding: 1.6rem; transition: transform .25s ease, box-shadow .25s ease; }
        .support-card:hover { transform: translateY(-5px); box-shadow: 0 18px 40px rgba(14,124,99,.15); }
        .card-top { display: flex; justify-content: space-between; align-items: center; gap: .6rem; margin-bottom: 1.2rem; }
        .status-pill { display: inline-flex; align-items: center; gap: .35rem; background: var(--mint-100); color: var(--lake-600); font-size: .8rem; font-weight: 700; padding: .3rem .8rem; border-radius: 50px; }
        .card-date { color: var(--ink-soft); font-size: .85rem; font-weight: 600; display: inline-flex; align-items: center; gap: .4rem; }
        .donor { display: flex; align-items: center; gap: .9rem; margin-bottom: 1rem; }
        .avatar { width: 48px; height: 48px; flex-shrink: 0; border-radius: 50%; display: grid; place-items: center; background: var(--lake-800); color: #fff; font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 1.2rem; }
        .avatar.anon { background: var(--mint-100); color: var(--lake-600); font-size: 1.3rem; }
        .donor h3 { font-size: 1.1rem; font-weight: 800; color: var(--lake-800); margin: 0 0 .1rem; line-height: 1.25; }
        .donor span { color: var(--ink-soft); font-size: .86rem; display: inline-flex; align-items: center; gap: .35rem; }
        .amount { font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; font-size: 1.7rem; color: var(--lake-600); margin-bottom: .8rem; }
        .type-tag { display: inline-flex; align-items: center; gap: .4rem; align-self: flex-start; background: var(--mint-50); border: 1px solid #CDEBDC; color: var(--lake-800); font-size: .82rem; font-weight: 700; padding: .3rem .85rem; border-radius: 50px; margin-bottom: .8rem; text-transform: capitalize; }
        .detail-box { background: var(--mint-50); border-radius: 16px; padding: .9rem 1.1rem; margin-bottom: 1rem; }
        .detail-box small { display: block; color: var(--ink-soft); font-size: .78rem; margin-bottom: .15rem; }
        .detail-box strong { color: var(--ink); font-weight: 700; line-height: 1.5; }
        .detail-box .pay { display: block; color: var(--ink-soft); font-size: .86rem; margin-top: .5rem; }
        .quote { margin-top: auto; display: flex; gap: .7rem; border-left: 4px solid var(--leaf); background: #F0FAF4; border-radius: 0 14px 14px 0; padding: .9rem 1rem; }
        .quote i { color: var(--leaf); font-size: 1.2rem; flex-shrink: 0; }
        .quote p { margin: 0; color: var(--ink-soft); font-style: italic; line-height: 1.6; font-size: .95rem; }

        .empty-state { background: #fff; border: 1.5px dashed #A9DCC3; border-radius: 28px; padding: 3.5rem 1.5rem; text-align: center; max-width: 560px; margin: 0 auto; }
        .empty-state i { font-size: 3rem; color: var(--leaf); }
        .empty-state h2 { font-weight: 800; font-size: 1.4rem; color: var(--lake-800); margin: .8rem 0 .4rem; }
        .empty-state p { color: var(--ink-soft); margin-bottom: 1.4rem; }
        .btn-lake { display: inline-flex; align-items: center; gap: .5rem; background: var(--lake-600); color: #fff; font-weight: 700; text-decoration: none; border-radius: 50px; padding: .8rem 1.7rem; }
        .btn-lake:hover { background: var(--lake-800); color: #fff; }

        .wa-strip { display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; background: #fff; border: 1px solid var(--mint-100); border-radius: 24px; padding: 1.4rem 1.6rem; margin-top: 2.5rem; }
        .wa-strip strong { display: block; color: var(--lake-800); font-weight: 800; }
        .wa-strip span { color: var(--ink-soft); font-size: .92rem; }
        .btn-wa { display: inline-flex; align-items: center; gap: .6rem; background: var(--wa); color: #fff; font-weight: 700; text-decoration: none; border-radius: 50px; padding: .75rem 1.5rem; transition: background .2s ease; }
        .btn-wa:hover { background: #168A46; color: #fff; }

        /* FOOTER */
        .site-footer { background: var(--lake-950); color: rgba(255,255,255,.75); padding: 3.5rem 0 1.8rem; margin-top: 4.5rem; }
        .site-footer .brand-name { color: #fff; font-weight: 800; font-size: 1.4rem; }
        .site-footer a { color: rgba(255,255,255,.75); text-decoration: none; }
        .site-footer a:hover { color: #fff; text-decoration: underline; }
        .site-footer .footer-links li { margin-bottom: .45rem; }
        .site-footer .copy { border-top: 1px solid rgba(255,255,255,.14); margin-top: 2.2rem; padding-top: 1.2rem; font-size: .88rem; }

        @media (max-width: 575.98px) { .page-head { padding: 6.5rem 0 2.8rem; border-radius: 0 0 26px 26px; } }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top site-nav">
    <div class="container">
        <a class="navbar-brand brand-name" href="/"><i class="bi bi-shield-check me-2"></i>SIGAP MUARA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Buka menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="/">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="/galeri">Galeri</a></li>
                <li class="nav-item"><a class="nav-link" href="/kegiatan">Kegiatan</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('supports.summary') }}">Dukungan</a></li>
                <li class="nav-item"><a class="nav-link" href="/lacak">Lacak Laporan</a></li>
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
                <span class="head-badge"><i class="bi bi-patch-check-fill"></i> Dukungan yang sudah terverifikasi</span>
                <h1>Ringkasan dukungan</h1>
                <p>Terima kasih kepada seluruh masyarakat dan para pendukung yang telah berkontribusi untuk Kecamatan Muara.</p>
            </div>
            <a href="{{ route('supports.create') }}" class="btn btn-sun btn-lg"><i class="bi bi-heart-fill me-2"></i>Beri dukungan</a>
        </div>
    </div>
</header>

<main class="container pt-5">

    @if($totalSupports > 0)
        <!-- RINGKASAN ANGKA -->
        <div class="stat-grid">
            <div class="stat">
                <div class="stat-icon"><i class="bi bi-people-fill"></i></div>
                <div><small>Pendukung</small><strong>{{ number_format($totalSupports, 0, ',', '.') }}</strong></div>
            </div>
            <div class="stat">
                <div class="stat-icon"><i class="bi bi-cash-coin"></i></div>
                <div><small>Dana terverifikasi</small><strong>Rp{{ number_format($totalFunds, 0, ',', '.') }}</strong></div>
            </div>
            <div class="stat">
                <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
                <div><small>Dukungan barang</small><strong>{{ number_format($totalGoods, 0, ',', '.') }}</strong></div>
            </div>
        </div>
    @endif

    <div class="mb-4">
        <h2 class="fw-bold mb-1" style="color: var(--lake-800); font-size: 1.6rem;">Daftar dukungan terverifikasi</h2>
        <p class="text-muted mb-0">Hanya dukungan yang sudah diperiksa admin yang ditampilkan.</p>
    </div>

    <div class="row g-4">
        @forelse($supports as $s)
            @php
                // Nominal dan metode pembayaran hanya relevan untuk dukungan dana (sponsorship)
                $hasAmount = (int) ($s->transfer_amount ?? 0) > 0;

                $paymentLabel = $s->payment_method
                    ? config('support.payments.' . $s->payment_method . '.label', $s->payment_method)
                    : null;

                $donorName = $s->is_anonymous ? 'Pendukung Anonim' : ($s->donor_name ?? 'Pendukung');
                $initial = $s->is_anonymous ? null : mb_strtoupper(mb_substr(trim((string) $s->donor_name), 0, 1));
            @endphp

            <div class="col-md-6 col-lg-4">
                <article class="support-card">

                    <div class="card-top">
                        <span class="status-pill"><i class="bi bi-check-circle-fill"></i>{{ str_replace('_', ' ', $s->status) }}</span>
                        <span class="card-date"><i class="bi bi-calendar3"></i>{{ $s->created_at?->format('d M Y') }}</span>
                    </div>

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

                    @if($hasAmount)
                        <div class="amount">Rp{{ number_format($s->transfer_amount, 0, ',', '.') }}</div>
                    @endif

                    <span class="type-tag">
                        <i class="bi {{ $s->type === 'barang' ? 'bi-box-seam' : 'bi-cash-coin' }}"></i>{{ $s->type }}
                    </span>

                    <div class="detail-box">
                        <small>Detail dukungan</small>
                        <strong>{{ $s->item_details }}</strong>

                        @if($paymentLabel)
                            <span class="pay"><i class="bi bi-credit-card me-1"></i>Pembayaran: {{ $paymentLabel }}</span>
                        @endif
                    </div>

                    @if($s->message)
                        <div class="quote">
                            <i class="bi bi-chat-quote-fill"></i>
                            <p>"{{ $s->message }}"</p>
                        </div>
                    @endif

                </article>
            </div>
        @empty
            <div class="col-12">
                <div class="empty-state">
                    <i class="bi bi-heart"></i>
                    <h2>Belum ada dukungan terverifikasi</h2>
                    <p>Dukungan yang telah dikirim akan tampil di sini setelah melalui proses verifikasi admin.</p>
                    <a href="{{ route('supports.create') }}" class="btn-lake"><i class="bi bi-heart-fill"></i>Berikan dukungan pertama</a>
                </div>
            </div>
        @endforelse
    </div>

    @if($waAsk)
        <div class="wa-strip">
            <div>
                <strong>Sudah mengirim dukungan?</strong>
                <span>Konfirmasi ke admin lewat WhatsApp agar dukungan Anda lebih cepat diverifikasi.</span>
            </div>
            <a href="{{ $waAsk }}" target="_blank" rel="noopener noreferrer" class="btn-wa"><i class="bi bi-whatsapp"></i>Hubungi admin</a>
        </div>
    @endif

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
</body>
</html>
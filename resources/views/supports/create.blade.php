
@php
    use Illuminate\Support\Collection;

    $payments = collect($payments ?? []);

    $waNumber = preg_replace(
        '/\D+/',
        '',
        (string) config('support.whatsapp_admin')
    );

    if ($waNumber !== '' && str_starts_with($waNumber, '0')) {
        $waNumber = '62' . substr($waNumber, 1);
    }

    $waAsk = $waNumber !== ''
        ? 'https://wa.me/' . $waNumber . '?text=' . rawurlencode(
            'Halo Admin SIGAP Kecamatan Muara, saya ingin bertanya tentang dukungan.'
        )
        : null;

    $waConfirm = session('whatsapp_url')
        ?: ($waNumber !== ''
            ? 'https://wa.me/' . $waNumber . '?text=' . rawurlencode(
                'Halo Admin SIGAP Kecamatan Muara, saya baru saja mengirim dukungan melalui website SIGAP Kecamatan Muara dan ingin melakukan konfirmasi.'
            )
            : null);

    $paymentData = $payments->mapWithKeys(function ($payment) {
        return [
            (string) $payment->id => [
                'name' => $payment->name,
                'account_number' => $payment->account_number,
                'account_name' => $payment->account_name,
                'description' => $payment->description,
            ],
        ];
    })->all();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Beri Dukungan — SIGAP KECAMATAN MUARA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,600;12..96,800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --lake-950: #03271F;
            --lake-800: #08463A;
            --lake-600: #0E7C63;
            --leaf: #10B981;
            --mint-100: #E3F6EC;
            --mint-50: #F4FBF7;
            --sun: #F6B93B;
            --ink: #17302A;
            --ink-soft: #4C6159;
            --wa: #1FA855;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--ink);
            background: var(--mint-50);
        }

        h1, h2, h3, h4, h5, .brand-name {
            font-family: 'Bricolage Grotesque', sans-serif;
        }

        a:focus-visible,
        button:focus-visible {
            outline: 3px solid var(--sun);
            outline-offset: 3px;
        }

        /* NAVBAR */

        .site-nav {
            padding: .6rem 0;
            background: rgba(3,39,31,.97);
            box-shadow: 0 6px 24px rgba(3,39,31,.25);
        }

        .site-nav .navbar-brand {
            color: #fff;
            font-weight: 800;
            font-size: 1.4rem;
            letter-spacing: .3px;
        }

        .site-nav .navbar-brand i {
            color: var(--sun);
        }

        .site-nav .nav-link {
            color: rgba(255,255,255,.82);
            font-weight: 600;
            padding: .5rem .9rem;
        }

        .site-nav .nav-link:hover,
        .site-nav .nav-link.active {
            color: #fff;
        }

        .site-nav .nav-link.active {
            box-shadow: inset 0 -2px 0 var(--sun);
        }

        .site-nav .navbar-toggler {
            border: 0;
        }

        .site-nav .navbar-toggler:focus {
            box-shadow: none;
        }

        .btn-nav-cta {
            background: var(--sun);
            color: var(--lake-950);
            font-weight: 700;
            border-radius: 50px;
            padding: .5rem 1.3rem;
            border: 0;
        }

        .btn-nav-cta:hover {
            background: #fff;
            color: var(--lake-950);
        }

        @media (max-width: 991.98px) {
            .site-nav .navbar-collapse.show,
            .site-nav .navbar-collapse.collapsing {
                margin-top: .6rem;
                padding: 1rem 0 .5rem;
            }
        }

        /* HEADER */

        .page-head {
            background: linear-gradient(
                135deg,
                var(--lake-800),
                var(--lake-950)
            );
            color: #fff;
            padding: 7rem 0 3.4rem;
            border-radius: 0 0 36px 36px;
        }

        .head-badge {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: rgba(255,255,255,.14);
            border: 1px solid rgba(255,255,255,.28);
            padding: .4rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: .9rem;
        }

        .head-badge i {
            color: var(--sun);
        }

        .page-head h1 {
            font-weight: 800;
            font-size: clamp(2rem, 4.8vw, 3.2rem);
            line-height: 1.08;
            letter-spacing: -.02em;
            max-width: 20ch;
            margin: 1.1rem 0 .8rem;
        }

        .page-head p {
            color: rgba(255,255,255,.88);
            font-size: 1.08rem;
            line-height: 1.7;
            max-width: 58ch;
            margin: 0;
        }

        /* PANEL */

        .panel {
            background: #fff;
            border: 1px solid var(--mint-100);
            border-radius: 28px;
        }

        .form-panel {
            padding: 2rem;
            scroll-margin-top: 90px;
        }

        .form-group-title {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: 1.2rem;
            color: var(--lake-800);
            margin-bottom: .3rem;
            display: flex;
            align-items: center;
            gap: .55rem;
        }

        .form-group-title i {
            color: var(--lake-600);
        }

        .form-group-desc {
            color: var(--ink-soft);
            font-size: .92rem;
            margin-bottom: 1.2rem;
        }

        .form-section + .form-section {
            border-top: 1px solid var(--mint-100);
            margin-top: 2rem;
            padding-top: 2rem;
        }

        .form-label {
            color: var(--lake-800);
            font-weight: 700;
            font-size: .92rem;
            margin-bottom: .35rem;
        }

        .form-label .opt {
            color: var(--ink-soft);
            font-weight: 500;
        }

        .form-control,
        .form-select {
            border-radius: 14px;
            padding: .8rem 1rem;
            border: 1.5px solid #D4E6DC;
            background-color: #FCFEFD;
            font-size: 1rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--leaf);
            box-shadow: 0 0 0 .22rem rgba(16,185,129,.18);
        }

        .hint {
            color: var(--ink-soft);
            font-size: .86rem;
            margin-top: .4rem;
            display: block;
        }

        /* ANONIM */

        .anon-box {
            display: flex;
            align-items: center;
            gap: .9rem;
            background: var(--mint-50);
            border: 1.5px solid #CDEBDC;
            border-radius: 18px;
            padding: 1rem 1.2rem;
            margin-bottom: 1.1rem;
        }

        .anon-box .form-check-input {
            width: 2.6rem;
            height: 1.4rem;
            margin: 0;
            flex-shrink: 0;
            cursor: pointer;
        }

        .anon-box .form-check-input:checked {
            background-color: var(--lake-600);
            border-color: var(--lake-600);
        }

        .anon-box label {
            cursor: pointer;
            font-weight: 700;
            color: var(--lake-800);
            margin: 0;
            line-height: 1.35;
        }

        .anon-box small {
            display: block;
            font-weight: 500;
            color: var(--ink-soft);
        }

        /* PILIHAN DUKUNGAN */

        .choice-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: .9rem;
        }

        .choice {
            position: relative;
        }

        .choice input {
            position: absolute;
            inset: 0;
            opacity: 0;
            cursor: pointer;
            z-index: 1;
        }

        .choice-card {
            display: flex;
            gap: .9rem;
            align-items: flex-start;
            height: 100%;
            border: 2px solid #D4E6DC;
            border-radius: 20px;
            padding: 1.1rem 1.2rem;
            background: #fff;
            transition: .2s ease;
        }

        .choice-card i {
            font-size: 1.6rem;
            color: var(--lake-600);
        }

        .choice-card strong {
            display: block;
            font-weight: 800;
            color: var(--lake-800);
        }

        .choice-card span span {
            color: var(--ink-soft);
            font-size: .88rem;
            line-height: 1.5;
            display: block;
        }

        .choice input:checked + .choice-card {
            border-color: var(--lake-600);
            background: var(--mint-50);
            box-shadow: 0 0 0 3px rgba(14,124,99,.12);
        }

        .choice input:focus-visible + .choice-card {
            outline: 3px solid var(--sun);
            outline-offset: 3px;
        }

        /* PEMBAYARAN */

        .payment-info {
            background: var(--mint-50);
            border: 1.5px solid #CDEBDC;
            border-radius: 18px;
            padding: 1.2rem 1.3rem;
            margin-top: 1rem;
        }

        .payment-info[hidden],
        #paymentSection[hidden],
        #proofSection[hidden] {
            display: none !important;
        }

        .payment-label {
            font-weight: 700;
            color: var(--lake-600);
            font-size: .88rem;
            margin-bottom: .4rem;
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        .payment-number {
            font-family: 'Bricolage Grotesque', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            letter-spacing: .5px;
            color: var(--lake-950);
            word-break: break-word;
        }

        .payment-owner {
            color: var(--ink-soft);
            font-size: .92rem;
        }

        .btn-copy {
            border: 1.5px solid var(--lake-600);
            color: var(--lake-600);
            background: #fff;
            border-radius: 50px;
            font-size: .88rem;
            padding: .45rem 1.1rem;
            font-weight: 700;
            margin-top: .9rem;
        }

        .btn-copy:hover {
            background: var(--lake-600);
            color: #fff;
        }

        /* NOMINAL */

        .amount-chips {
            display: flex;
            flex-wrap: wrap;
            gap: .5rem;
            margin-top: .7rem;
        }

        .chip-amt {
            border: 1px solid #CDEBDC;
            background: #fff;
            color: var(--lake-800);
            font-weight: 600;
            font-size: .88rem;
            padding: .35rem .95rem;
            border-radius: 50px;
        }

        .chip-amt:hover {
            background: var(--mint-100);
        }

        #amountPreview {
            color: var(--lake-600);
            font-weight: 700;
        }

        /* UPLOAD */

        .upload-box {
            position: relative;
            display: block;
            border: 2px dashed #A9DCC3;
            border-radius: 20px;
            background: var(--mint-50);
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
        }

        .upload-box:focus-within {
            outline: 3px solid var(--sun);
            outline-offset: 3px;
        }

        .upload-box i {
            font-size: 2.2rem;
            color: var(--leaf);
        }

        .upload-box strong {
            display: block;
            margin-top: .4rem;
            color: var(--lake-800);
        }

        .upload-box small {
            color: var(--ink-soft);
        }

        .file-native {
            position: absolute;
            left: 50%;
            bottom: 0;
            width: 1px;
            height: 1px;
            opacity: 0;
            overflow: hidden;
        }

        #proofPreview {
            display: none;
            max-width: 100%;
            max-height: 280px;
            object-fit: contain;
            border-radius: 14px;
            margin: 1rem auto 0;
        }

        /* NOTIFIKASI */

        .notice {
            display: flex;
            gap: .7rem;
            background: var(--mint-50);
            border-radius: 14px;
            padding: .95rem 1.1rem;
            color: var(--ink-soft);
            font-size: .92rem;
            line-height: 1.65;
        }

        .notice i {
            color: var(--lake-600);
            margin-top: .15rem;
        }

        .btn-lake {
            background: var(--lake-600);
            color: #fff;
            font-weight: 700;
            border: 0;
            border-radius: 50px;
            padding: 1rem 1.5rem;
            font-size: 1.05rem;
            transition: .2s ease;
        }

        .btn-lake:hover {
            background: var(--lake-800);
            color: #fff;
            transform: translateY(-2px);
        }

        .alert {
            border: 0;
            border-radius: 16px;
        }

        /* SUKSES */

        .success-box {
            background: #fff;
            border: 2px solid var(--leaf);
            border-radius: 24px;
            padding: 1.6rem;
            margin-bottom: 1.5rem;
            scroll-margin-top: 90px;
        }

        .success-box h2 {
            font-weight: 800;
            font-size: 1.35rem;
            color: var(--lake-800);
            display: flex;
            align-items: center;
            gap: .6rem;
            margin-bottom: .5rem;
        }

        .success-box h2 i {
            color: var(--leaf);
        }

        .btn-wa {
            display: inline-flex;
            align-items: center;
            gap: .6rem;
            background: var(--wa);
            color: #fff;
            font-weight: 700;
            text-decoration: none;
            border-radius: 50px;
            padding: .8rem 1.6rem;
            transition: .2s ease;
        }

        .btn-wa:hover {
            background: #168A46;
            color: #fff;
            transform: translateY(-2px);
        }

        .btn-wa i {
            font-size: 1.2rem;
        }

        /* PANEL SAMPING */

        .side-panel {
            padding: 2rem;
        }

        @media (min-width: 992px) {
            .side-panel {
                position: sticky;
                top: 90px;
            }
        }

        .side-panel h2 {
            font-weight: 800;
            font-size: 1.35rem;
            color: var(--lake-800);
            margin-bottom: 1.3rem;
        }

        .side-item {
            display: flex;
            gap: .9rem;
            margin-bottom: 1.2rem;
        }

        .side-icon {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: var(--mint-100);
            color: var(--lake-600);
            font-size: 1.2rem;
        }

        .side-item strong {
            display: block;
            color: var(--ink);
            font-weight: 700;
            margin-bottom: .1rem;
        }

        .side-item span {
            color: var(--ink-soft);
            font-size: .92rem;
            line-height: 1.6;
        }

        .btn-outline-lake {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: .5rem;
            text-decoration: none;
            font-weight: 700;
            color: var(--lake-600);
            border: 2px solid var(--lake-600);
            border-radius: 50px;
            padding: .75rem 1.3rem;
            transition: .2s ease;
        }

        .btn-outline-lake:hover {
            background: var(--lake-600);
            color: #fff;
        }

        .wa-card {
            background: #F0FAF4;
            border: 1px solid #CDEBDC;
            border-radius: 20px;
            padding: 1.1rem 1.2rem;
            margin-top: 1.2rem;
        }

        .wa-card strong {
            display: block;
            color: var(--lake-800);
            margin-bottom: .2rem;
        }

        .wa-card span {
            color: var(--ink-soft);
            font-size: .9rem;
            display: block;
            margin-bottom: .8rem;
        }

        /* FOOTER */

        .site-footer {
            background: var(--lake-950);
            color: rgba(255,255,255,.75);
            padding: 3.5rem 0 1.8rem;
            margin-top: 4.5rem;
        }

        .site-footer .brand-name {
            color: #fff;
            font-weight: 800;
            font-size: 1.4rem;
        }

        .site-footer a {
            color: rgba(255,255,255,.75);
            text-decoration: none;
        }

        .site-footer a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .site-footer .footer-links li {
            margin-bottom: .45rem;
        }

        .site-footer .copy {
            border-top: 1px solid rgba(255,255,255,.14);
            margin-top: 2.2rem;
            padding-top: 1.2rem;
            font-size: .88rem;
        }

        @media (max-width: 575.98px) {
            .page-head {
                padding: 6.5rem 0 2.8rem;
                border-radius: 0 0 26px 26px;
            }

            .form-panel,
            .side-panel {
                padding: 1.4rem;
            }

            .choice-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top site-nav">
    <div class="container">

        <a class="navbar-brand brand-name" href="/">
            <i class="bi bi-shield-check me-2"></i>SIGAP MUARA
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Buka menu">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link" href="/">Beranda</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/galeri">Galeri</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/kegiatan">Kegiatan</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('supports.summary') }}">
                        Dukungan
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/lacak">Lacak Laporan</a>
                </li>

                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a class="btn btn-nav-cta" href="{{ route('reports.create') }}">
                        <i class="bi bi-camera me-1"></i> Buat Laporan
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- HEADER -->
<header class="page-head">
    <div class="container">

        <span class="head-badge">
            <i class="bi bi-heart-fill"></i>
            Bersama membangun Muara
        </span>

        <h1>Berikan dukunganmu</h1>

        <p>
            Setiap dukungan berarti untuk kegiatan dan lingkungan
            Kecamatan Muara. Mari berkontribusi bersama.
        </p>

    </div>
</header>

<!-- KONTEN -->
<main class="container pt-5">

    <div class="row g-4 justify-content-center">

        <!-- FORM -->
        <div class="col-lg-7">

            <!-- NOTIFIKASI SUKSES -->
            @if(session('success'))

                <div class="success-box" id="successBox">

                    <h2>
                        <i class="bi bi-check-circle-fill"></i>
                        Dukungan berhasil dikirim!
                    </h2>

                    <p class="text-muted mb-3">
                        {{ session('success') }}
                    </p>

                    @if($waConfirm)

                        <p class="mb-2 fw-semibold" style="color:var(--lake-800);">
                            Langkah berikutnya: konfirmasi ke admin melalui WhatsApp
                            agar dukungan Anda dapat segera diperiksa.
                        </p>

                        <a href="{{ $waConfirm }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn-wa">

                            <i class="bi bi-whatsapp"></i>
                            Konfirmasi melalui WhatsApp Admin

                        </a>

                        <p class="small text-muted mt-2 mb-0">
                            Pesan sudah terisi otomatis. Lampirkan bukti transfer
                            atau foto barang jika diminta admin.
                        </p>

                    @else

                        <p class="small text-muted mb-0">
                            Nomor WhatsApp admin belum dikonfigurasi.
                            Admin akan memeriksa dukungan Anda melalui sistem.
                        </p>

                    @endif

                </div>

            @endif

            <div class="panel form-panel" id="form-dukungan">

                <!-- NOTIFIKASI ERROR -->
                @if($errors->any())

                    <div class="alert alert-danger" id="errorBox">

                        <strong>Periksa kembali formulir:</strong>

                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>

                    </div>

                @endif

                <form action="{{ route('supports.store') }}"
                      method="POST"
                      enctype="multipart/form-data"
                      id="supportForm">

                    @csrf

                    <!-- 1. INFORMASI PENDUKUNG -->
                    <section class="form-section">

                        <h2 class="form-group-title">
                            <i class="bi bi-person-lines-fill"></i>
                            Informasi pendukung
                        </h2>

                        <p class="form-group-desc">
                            Lengkapi informasi berikut untuk mencatat dukungan.
                        </p>

                        <div class="anon-box">

                            <input class="form-check-input"
                                   type="checkbox"
                                   role="switch"
                                   id="is_anonymous"
                                   name="is_anonymous"
                                   value="1"
                                   {{ old('is_anonymous') ? 'checked' : '' }}>

                            <label for="is_anonymous">

                                Saya ingin memberikan dukungan secara anonim

                                <small>
                                    Nama Anda tidak akan ditampilkan
                                    di ringkasan publik.
                                </small>

                            </label>

                        </div>

                        <div class="mb-3" id="donorNameWrapper">

                            <label class="form-label" for="donor_name">
                                Nama pendukung
                            </label>

                            <input type="text"
                                   class="form-control"
                                   name="donor_name"
                                   id="donor_name"
                                   value="{{ old('donor_name') }}"
                                   placeholder="Masukkan nama lengkap"
                                   maxlength="150">

                        </div>

                        <div>

                            <label class="form-label" for="origin_rantau">
                                Asal daerah
                            </label>

                            <input type="text"
                                   class="form-control"
                                   name="origin_rantau"
                                   id="origin_rantau"
                                   value="{{ old('origin_rantau') }}"
                                   placeholder="Contoh: Medan, Jakarta, Kecamatan Muara"
                                   maxlength="150"
                                   required>

                        </div>

                    </section>

                    <!-- 2. JENIS DUKUNGAN -->
                    <section class="form-section">

                        <h2 class="form-group-title">
                            <i class="bi bi-gift"></i>
                            Jenis dukungan
                        </h2>

                        <p class="form-group-desc">
                            Pilih jenis dukungan yang ingin diberikan.
                        </p>

                        <div class="choice-grid mb-3">

                            <div class="choice">

                                <input type="radio"
                                       name="type"
                                       id="type_barang"
                                       value="barang"
                                       {{ old('type') === 'barang' ? 'checked' : '' }}
                                       required>

                                <div class="choice-card">

                                    <i class="bi bi-box-seam"></i>

                                    <span>
                                        <strong>Dukungan barang</strong>
                                        <span>
                                            Berupa kebutuhan barang.
                                            Tidak perlu transfer.
                                        </span>
                                    </span>

                                </div>
                            </div>

                            <div class="choice">

                                <input type="radio"
                                       name="type"
                                       id="type_sponsorship"
                                       value="sponsorship"
                                       {{ old('type') === 'sponsorship' ? 'checked' : '' }}>

                                <div class="choice-card">

                                    <i class="bi bi-cash-stack"></i>

                                    <span>
                                        <strong>Sponsorship</strong>
                                        <span>
                                            Dukungan dana untuk kegiatan
                                            melalui transfer.
                                        </span>
                                    </span>

                                </div>
                            </div>

                        </div>

                        <div>

                            <label class="form-label" for="item_details">
                                Detail dukungan
                            </label>

                            <textarea class="form-control"
                                      name="item_details"
                                      id="item_details"
                                      rows="3"
                                      maxlength="2000"
                                      placeholder="Jelaskan tujuan atau detail dukungan yang diberikan..."
                                      required>{{ old('item_details') }}</textarea>

                        </div>

                    </section>

                    <!-- 3. PEMBAYARAN -->
                    <section class="form-section"
                             id="paymentSection"
                             hidden>

                        <h2 class="form-group-title">
                            <i class="bi bi-credit-card"></i>
                            Informasi pembayaran
                        </h2>

                        <p class="form-group-desc">
                            Pilih metode pembayaran yang tersedia
                            untuk mengirim dukungan dana.
                        </p>

                        @if($payments->isNotEmpty())

                            <div class="mb-3">

                                <label class="form-label" for="payment_method">
                                    Metode pembayaran
                                </label>

                                <select class="form-select"
                                        name="payment_method"
                                        id="payment_method"
                                        disabled>

                                    <option value="">
                                        -- Pilih metode pembayaran --
                                    </option>

                                    @foreach($payments as $payment)

                                        <option value="{{ $payment->id }}"
                                            {{ (string) old('payment_method') === (string) $payment->id ? 'selected' : '' }}>

                                            {{ $payment->name }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('payment_method')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                                <div class="payment-info"
                                     id="paymentInfo"
                                     hidden>

                                    <div class="payment-label">
                                        <i class="bi bi-bank"></i>
                                        Tujuan transfer
                                    </div>

                                    <div class="payment-number"
                                         id="paymentNumber">
                                        -
                                    </div>

                                    <div class="payment-owner mt-1"
                                         id="paymentOwner">
                                    </div>

                                    <div class="small text-secondary mt-2"
                                         id="paymentDescription">
                                    </div>

                                    <button type="button"
                                            class="btn-copy"
                                            id="copyPayment">

                                        <i class="bi bi-copy me-1"></i>
                                        Salin nomor tujuan

                                    </button>

                                </div>

                            </div>

                        @else

                            <div class="alert alert-warning">

                                <i class="bi bi-exclamation-triangle me-2"></i>

                                Belum ada metode pembayaran aktif.
                                Silakan hubungi admin atau gunakan jenis
                                dukungan barang.

                            </div>

                        @endif

                        <div>

                            <label class="form-label" for="transfer_amount">
                                Nominal transfer (Rp)
                            </label>

                            <input type="number"
                                   class="form-control"
                                   name="transfer_amount"
                                   id="transfer_amount"
                                   value="{{ old('transfer_amount') }}"
                                   min="1000"
                                   max="1000000000"
                                   step="1"
                                   inputmode="numeric"
                                   placeholder="Contoh: 100000"
                                   disabled>

                            @error('transfer_amount')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="amount-chips">

                                <button type="button"
                                        class="chip-amt"
                                        data-amount="50000">
                                    Rp50.000
                                </button>

                                <button type="button"
                                        class="chip-amt"
                                        data-amount="100000">
                                    Rp100.000
                                </button>

                                <button type="button"
                                        class="chip-amt"
                                        data-amount="250000">
                                    Rp250.000
                                </button>

                                <button type="button"
                                        class="chip-amt"
                                        data-amount="500000">
                                    Rp500.000
                                </button>

                            </div>

                            <span class="hint">
                                Minimal transfer Rp1.000.
                                <span id="amountPreview"></span>
                            </span>

                        </div>

                    </section>

                    <!-- 4. BUKTI -->
                    <section class="form-section"
                             id="proofSection"
                             hidden>

                        <h2 class="form-group-title">

                            <i class="bi bi-image"></i>

                            <span id="proofTitle">
                                Bukti transfer
                            </span>

                        </h2>

                        <p class="form-group-desc" id="proofDesc">
                            Unggah bukti transfer agar admin
                            dapat memverifikasi dukungan Anda.
                        </p>

                        <label class="upload-box" for="proof">

                            <i class="bi bi-cloud-arrow-up"></i>

                            <strong id="proofLabel">
                                Pilih gambar bukti transfer
                            </strong>

                            <small>
                                Format JPG, JPEG, PNG, atau WEBP.
                                Maksimal 5 MB.
                            </small>

                            <input type="file"
                                   class="file-native"
                                   name="proof"
                                   id="proof"
                                   accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                            <img id="proofPreview"
                                 alt="Pratinjau gambar yang dipilih">

                        </label>

                        @error('proof')
                            <div class="text-danger small mt-2">
                                {{ $message }}
                            </div>
                        @enderror

                    </section>

                    <!-- 5. PESAN -->
                    <section class="form-section">

                        <h2 class="form-group-title">
                            <i class="bi bi-chat-left-text"></i>
                            Pesan tambahan
                        </h2>

                        <p class="form-group-desc">
                            Boleh dikosongkan.
                        </p>

                        <label class="form-label" for="message">
                            Pesan atau harapan
                            <span class="opt">— opsional</span>
                        </label>

                        <textarea class="form-control"
                                  name="message"
                                  id="message"
                                  rows="3"
                                  maxlength="2000"
                                  placeholder="Tuliskan pesan atau harapan untuk Kecamatan Muara...">{{ old('message') }}</textarea>

                    </section>

                    <!-- INFORMASI -->
                    <div class="notice my-4">

                        <i class="bi bi-info-circle-fill"></i>

                        <span>
                            Setelah formulir dikirim, dukungan tersimpan
                            dengan status <strong>Menunggu Verifikasi</strong>.
                            Admin akan memeriksanya sebelum ditampilkan
                            di ringkasan publik.
                        </span>

                    </div>

                    <!-- SUBMIT -->
                    <button type="submit"
                            class="btn btn-lake w-100"
                            id="submitButton">

                        <i class="bi bi-send-fill me-2"></i>
                        Kirim dukungan

                    </button>

                </form>

            </div>

        </div>

        <!-- PANEL SAMPING -->
        <div class="col-lg-5">

            <aside class="panel side-panel">

                <h2>Yang perlu Anda tahu</h2>

                <div class="side-item">

                    <div class="side-icon">
                        <i class="bi bi-eye"></i>
                    </div>

                    <div>
                        <strong>Transparan</strong>
                        <span>
                            Dukungan yang sudah diverifikasi
                            tampil di halaman Ringkasan Dukungan.
                        </span>
                    </div>

                </div>

                <div class="side-item">

                    <div class="side-icon">
                        <i class="bi bi-incognito"></i>
                    </div>

                    <div>
                        <strong>Boleh anonim</strong>
                        <span>
                            Nama Anda bisa disembunyikan
                            tanpa mengurangi arti dukungan.
                        </span>
                    </div>

                </div>

                <div class="side-item">

                    <div class="side-icon">
                        <i class="bi bi-whatsapp"></i>
                    </div>

                    <div>
                        <strong>Konfirmasi lewat WhatsApp</strong>
                        <span>
                            Setelah mengirim formulir, Anda dapat
                            menghubungi admin untuk konfirmasi.
                        </span>
                    </div>

                </div>

                <a href="{{ route('supports.summary') }}"
                   class="btn-outline-lake">

                    Lihat ringkasan dukungan
                    <i class="bi bi-arrow-right"></i>

                </a>

                @if($waAsk)

                    <div class="wa-card">

                        <strong>Ada pertanyaan?</strong>

                        <span>
                            Tanyakan langsung ke admin
                            sebelum mengirim dukungan.
                        </span>

                        <a href="{{ $waAsk }}"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn-wa">

                            <i class="bi bi-whatsapp"></i>
                            Chat admin

                        </a>

                    </div>

                @endif

            </aside>

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
document.addEventListener('DOMContentLoaded', function () {

    // =====================================
    // DATA PEMBAYARAN
    // =====================================

    const paymentData = @json($paymentData);

    const paymentSection = document.getElementById('paymentSection');
    const paymentSelect = document.getElementById('payment_method');
    const paymentInfo = document.getElementById('paymentInfo');
    const paymentNumber = document.getElementById('paymentNumber');
    const paymentOwner = document.getElementById('paymentOwner');
    const paymentDescription = document.getElementById('paymentDescription');
    const copyBtn = document.getElementById('copyPayment');

    const amountInput = document.getElementById('transfer_amount');
    const amountPreview = document.getElementById('amountPreview');

    const proofSection = document.getElementById('proofSection');
    const proofInput = document.getElementById('proof');
    const proofTitle = document.getElementById('proofTitle');
    const proofDesc = document.getElementById('proofDesc');
    const proofLabel = document.getElementById('proofLabel');
    const proofPreview = document.getElementById('proofPreview');

    const form = document.getElementById('supportForm');

    const anonCheckbox = document.getElementById('is_anonymous');
    const donorWrapper = document.getElementById('donorNameWrapper');
    const donorInput = document.getElementById('donor_name');

    const submitButton = document.getElementById('submitButton');

    // =====================================
    // ANONIM
    // =====================================

    function syncAnonymous() {

        if (!anonCheckbox || !donorWrapper || !donorInput) {
            return;
        }

        const anonymous = anonCheckbox.checked;

        donorWrapper.style.display = anonymous ? 'none' : 'block';

        donorInput.disabled = anonymous;
        donorInput.required = !anonymous;

        if (anonymous) {
            donorInput.value = '';
        }
    }

    if (anonCheckbox) {
        anonCheckbox.addEventListener('change', syncAnonymous);
        syncAnonymous();
    }

    // =====================================
    // JENIS DUKUNGAN
    // =====================================

    function syncType() {

        const selected = document.querySelector(
            'input[name="type"]:checked'
        );

        const type = selected ? selected.value : '';
        const sponsorship = type === 'sponsorship';

        const hasPayments = Object.keys(paymentData).length > 0;

        if (paymentSection) {
            paymentSection.hidden = !sponsorship;
        }

        if (proofSection) {
            proofSection.hidden = !type;
        }

        if (paymentSelect) {
            paymentSelect.disabled = !sponsorship || !hasPayments;
            paymentSelect.required = sponsorship && hasPayments;
        }

        if (amountInput) {
            amountInput.disabled = !sponsorship;
            amountInput.required = sponsorship;
        }

        if (proofInput) {
            proofInput.required = sponsorship;
        }

        if (proofTitle && proofDesc && proofLabel) {

            if (sponsorship) {

                proofTitle.textContent = 'Bukti transfer';

                proofDesc.textContent =
                    'Unggah bukti transfer agar admin dapat memverifikasi dukungan Anda.';

                proofLabel.textContent =
                    'Pilih gambar bukti transfer';

            } else {

                proofTitle.textContent = 'Foto barang (opsional)';

                proofDesc.textContent =
                    'Lampirkan foto barang jika tersedia.';

                proofLabel.textContent =
                    'Pilih foto barang';
            }
        }

        if (!sponsorship && paymentInfo) {
            paymentInfo.hidden = true;
        }
    }

    document.querySelectorAll('input[name="type"]').forEach(input => {
        input.addEventListener('change', syncType);
    });

    syncType();

    // =====================================
    // INFORMASI METODE PEMBAYARAN
    // =====================================

    function updatePayment() {

        if (!paymentSelect || !paymentInfo) {
            return;
        }

        const payment = paymentData[paymentSelect.value];

        if (!payment) {

            paymentInfo.hidden = true;

            if (paymentNumber) {
                paymentNumber.textContent = '-';
            }

            if (paymentOwner) {
                paymentOwner.textContent = '';
            }

            if (paymentDescription) {
                paymentDescription.textContent = '';
            }

            return;
        }

        paymentInfo.hidden = false;

        if (paymentNumber) {
            paymentNumber.textContent =
                payment.account_number || '-';
        }

        if (paymentOwner) {
            paymentOwner.textContent =
                'Atas nama: ' + (payment.account_name || '-');
        }

        if (paymentDescription) {
            paymentDescription.textContent =
                payment.description || '';
        }
    }

    if (paymentSelect) {
        paymentSelect.addEventListener('change', updatePayment);
        updatePayment();
    }

    // =====================================
    // SALIN NOMOR REKENING
    // =====================================

    function copied() {

        if (!copyBtn) return;

        copyBtn.innerHTML =
            '<i class="bi bi-check2 me-1"></i>Berhasil disalin';

        setTimeout(function () {

            copyBtn.innerHTML =
                '<i class="bi bi-copy me-1"></i>Salin nomor tujuan';

        }, 1800);
    }

    if (copyBtn) {

        copyBtn.addEventListener('click', async function () {

            const number = paymentNumber
                ? paymentNumber.textContent.trim()
                : '';

            if (!number || number === '-') {
                return;
            }

            try {

                await navigator.clipboard.writeText(number);

                copied();

            } catch (error) {

                const temporary = document.createElement('textarea');

                temporary.value = number;

                document.body.appendChild(temporary);

                temporary.select();

                let success = false;

                try {
                    success = document.execCommand('copy');
                } catch (e) {
                    success = false;
                }

                temporary.remove();

                if (success) {
                    copied();
                } else {
                    alert('Nomor tujuan: ' + number);
                }
            }
        });
    }

    // =====================================
    // NOMINAL TRANSFER
    // =====================================

    function showAmount() {

        if (!amountInput || !amountPreview) {
            return;
        }

        const value = parseInt(amountInput.value, 10);

        amountPreview.textContent = value > 0
            ? '= Rp' + value.toLocaleString('id-ID')
            : '';
    }

    if (amountInput) {
        amountInput.addEventListener('input', showAmount);
    }

    document.querySelectorAll('.chip-amt').forEach(button => {

        button.addEventListener('click', function () {

            if (!amountInput || amountInput.disabled) {
                return;
            }

            amountInput.value = this.dataset.amount;

            showAmount();

            amountInput.focus();
        });
    });

    showAmount();

    // =====================================
    // PREVIEW GAMBAR
    // =====================================

    let previewUrl = null;

    if (proofInput && proofPreview) {

        proofInput.addEventListener('change', function () {

            const file = this.files[0];

            proofPreview.style.display = 'none';

            if (previewUrl) {

                URL.revokeObjectURL(previewUrl);

                previewUrl = null;
            }

            if (!file) {
                return;
            }

            const allowedTypes = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!allowedTypes.includes(file.type)) {

                alert('Gunakan gambar JPG, PNG, atau WEBP.');

                this.value = '';

                return;
            }

            if (file.size > 5 * 1024 * 1024) {

                alert('Ukuran gambar maksimal 5 MB.');

                this.value = '';

                return;
            }

            previewUrl = URL.createObjectURL(file);

            proofPreview.src = previewUrl;

            proofPreview.style.display = 'block';
        });
    }

    // =====================================
    // VALIDASI SEBELUM KIRIM
    // =====================================

    if (form) {

        form.addEventListener('submit', function (event) {

            const selected = document.querySelector(
                'input[name="type"]:checked'
            );

            if (!selected) {

                event.preventDefault();

                alert('Silakan pilih jenis dukungan terlebih dahulu.');

                return;
            }

            if (selected.value === 'sponsorship') {

                if (Object.keys(paymentData).length === 0) {

                    event.preventDefault();

                    alert(
                        'Belum tersedia metode pembayaran. Silakan hubungi admin.'
                    );

                    return;
                }

                if (!paymentSelect || !paymentSelect.value) {

                    event.preventDefault();

                    alert('Silakan pilih metode pembayaran.');

                    if (paymentSelect) {
                        paymentSelect.focus();
                    }

                    return;
                }

                if (
                    !amountInput ||
                    !amountInput.value ||
                    Number(amountInput.value) < 1000
                ) {

                    event.preventDefault();

                    alert('Nominal transfer minimal Rp1.000.');

                    if (amountInput) {
                        amountInput.focus();
                    }

                    return;
                }

                if (
                    !proofInput ||
                    !proofInput.files ||
                    !proofInput.files.length
                ) {

                    event.preventDefault();

                    alert('Silakan unggah bukti transfer.');

                    return;
                }
            }

            if (submitButton) {

                submitButton.disabled = true;

                submitButton.innerHTML =
                    '<span class="spinner-border spinner-border-sm me-2"></span>Mengirim dukungan...';
            }
        });
    }

    // =====================================
    // SCROLL NOTIFIKASI
    // =====================================

    const successBox = document.getElementById('successBox');
    const errorBox = document.getElementById('errorBox');

    if (successBox) {

        successBox.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

    } else if (errorBox) {

        errorBox.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }

});
</script>

</body>
</html>

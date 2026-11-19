<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Laporan — SIGAP KECAMATAN MUARA</title>

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
        .page-head h1 { font-weight: 800; font-size: clamp(2rem, 4.8vw, 3.2rem); line-height: 1.08; letter-spacing: -.02em; max-width: 20ch; margin: 1.1rem 0 .8rem; }
        .page-head p { color: rgba(255,255,255,.88); font-size: 1.08rem; line-height: 1.7; max-width: 56ch; margin: 0; }

        /* FORM */
        .panel { background: #fff; border: 1px solid var(--mint-100); border-radius: 28px; padding: 2.2rem; }
        .form-section { padding-bottom: 2rem; margin-bottom: 2rem; border-bottom: 1px solid var(--mint-100); }
        .form-section:last-of-type { border-bottom: 0; margin-bottom: 1rem; padding-bottom: 0; }
        .step-head { display: flex; align-items: center; gap: .9rem; margin-bottom: 1.3rem; }
        .step-no { width: 40px; height: 40px; flex-shrink: 0; border-radius: 50%; display: grid; place-items: center; background: var(--lake-800); color: #fff; font-family: 'Bricolage Grotesque', sans-serif; font-weight: 800; }
        .step-head h2 { font-weight: 800; font-size: 1.25rem; color: var(--lake-800); margin: 0; }
        .step-head p { margin: 0; color: var(--ink-soft); font-size: .88rem; }

        .form-label { color: var(--lake-800); font-weight: 700; font-size: .92rem; margin-bottom: .35rem; }
        .req { color: #DC2626; margin-left: .15rem; }
        .opt { color: var(--ink-soft); font-weight: 500; }
        .form-control { border-radius: 14px; padding: .8rem 1rem; border: 1.5px solid #D4E6DC; background: #FCFEFD; }
        .form-control:focus { border-color: var(--leaf); box-shadow: 0 0 0 .22rem rgba(16,185,129,.18); }
        .hint { color: var(--ink-soft); font-size: .85rem; margin-top: .4rem; display: block; }

        /* pilihan kepadatan */
        .choice-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: .8rem; }
        .choice { position: relative; }
        .choice input { position: absolute; inset: 0; opacity: 0; cursor: pointer; z-index: 1; }
        .choice-card { display: flex; flex-direction: column; align-items: center; gap: .4rem; text-align: center; height: 100%; border: 2px solid #D4E6DC; border-radius: 18px; padding: 1rem .6rem; background: #fff; transition: border-color .2s ease, background .2s ease; }
        .choice-card i { font-size: 1.6rem; color: var(--lake-600); }
        .choice-card strong { color: var(--lake-800); font-weight: 800; }
        .choice input:checked + .choice-card { border-color: var(--lake-600); background: var(--mint-50); box-shadow: 0 0 0 3px rgba(14,124,99,.12); }
        .choice input:focus-visible + .choice-card { outline: 3px solid var(--sun); outline-offset: 3px; }

        /* dampak */
        .impact-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: .8rem; }
        .impact-card { display: flex; align-items: center; gap: .8rem; border: 2px solid #D4E6DC; border-radius: 16px; padding: .85rem 1rem; background: #fff; font-weight: 600; transition: border-color .2s ease, background .2s ease; }
        .impact-card i { font-size: 1.3rem; color: var(--lake-600); }
        .choice input:checked + .impact-card { border-color: var(--lake-600); background: var(--mint-50); box-shadow: 0 0 0 3px rgba(14,124,99,.12); }
        .choice input:focus-visible + .impact-card { outline: 3px solid var(--sun); outline-offset: 3px; }

        /* unggah foto */
        .upload-box { border: 2px dashed #A9DCC3; border-radius: 20px; background: var(--mint-50); padding: 1.4rem; text-align: center; }
        .upload-box .form-control { max-width: 420px; margin: .8rem auto 0; }
        .upload-icon { font-size: 2.2rem; color: var(--leaf); }
        #photoPreview { display: none; width: 100%; max-height: 300px; object-fit: cover; border-radius: 16px; margin-top: 1rem; border: 1px solid var(--mint-100); }

        /* anonim */
        .anon-box { display: flex; align-items: center; gap: .9rem; background: var(--mint-50); border: 1.5px solid #CDEBDC; border-radius: 18px; padding: 1rem 1.2rem; margin-bottom: 1.2rem; }
        .anon-box .form-check-input { width: 2.6rem; height: 1.4rem; margin: 0; flex-shrink: 0; cursor: pointer; }
        .anon-box .form-check-input:checked { background-color: var(--lake-600); border-color: var(--lake-600); }
        .anon-box .form-check-input:focus { box-shadow: 0 0 0 .2rem rgba(16,185,129,.25); border-color: var(--leaf); }
        .anon-box label { cursor: pointer; font-weight: 700; color: var(--lake-800); margin: 0; line-height: 1.35; }
        .anon-box small { display: block; font-weight: 500; color: var(--ink-soft); }

        .notice { display: flex; gap: .7rem; background: var(--mint-50); border-radius: 14px; padding: .9rem 1.1rem; color: var(--ink-soft); font-size: .9rem; line-height: 1.6; margin-bottom: 1.4rem; }
        .notice i { color: var(--lake-600); margin-top: .15rem; }
        .btn-lake { background: var(--lake-600); color: #fff; font-weight: 700; border: 0; border-radius: 50px; padding: 1rem 1.5rem; font-size: 1.05rem; transition: background .2s ease, transform .2s ease; }
        .btn-lake:hover { background: var(--lake-800); color: #fff; transform: translateY(-2px); }
        .btn-back { display: block; text-align: center; color: var(--ink-soft); font-weight: 600; text-decoration: none; margin-top: 1rem; }
        .btn-back:hover { color: var(--lake-800); text-decoration: underline; }
        .alert { border: 0; border-radius: 16px; }

        /* FOOTER */
        .site-footer { background: var(--lake-950); color: rgba(255,255,255,.75); padding: 3.5rem 0 1.8rem; margin-top: 4.5rem; }
        .site-footer .brand-name { color: #fff; font-weight: 800; font-size: 1.4rem; }
        .site-footer a { color: rgba(255,255,255,.75); text-decoration: none; }
        .site-footer a:hover { color: #fff; text-decoration: underline; }
        .site-footer .footer-links li { margin-bottom: .45rem; }
        .site-footer .copy { border-top: 1px solid rgba(255,255,255,.14); margin-top: 2.2rem; padding-top: 1.2rem; font-size: .88rem; }

        @media (max-width: 575.98px) {
            .page-head { padding: 6.5rem 0 2.8rem; border-radius: 0 0 26px 26px; }
            .panel { padding: 1.4rem; }
            .impact-grid { grid-template-columns: 1fr; }
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

<!-- KEPALA HALAMAN -->
<header class="page-head">
    <div class="container">
        <span class="head-badge"><i class="bi bi-camera-fill"></i> Formulir laporan warga</span>
        <h1>Laporkan eceng gondok di kecamatan muara</h1>
        <p>Bantu kami menjaga kebersihan dan lingkungan kecamatan Muara. Isi beberapa bagian singkat di bawah ini.</p>
    </div>
</header>

<main class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="panel" id="form-laporan">

                <!-- PESAN ERROR -->
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <strong>Periksa kembali data laporan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- 1. LOKASI -->
                    <section class="form-section">
                        <div class="step-head">
                            <div class="step-no">1</div>
                            <div>
                                <h2>Informasi lokasi</h2>
                                <p>Di mana eceng gondok ditemukan?</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="location_name">Nama lokasi<span class="req" aria-hidden="true">*</span></label>
                            <input type="text" name="location_name" id="location_name"
                                class="form-control form-control-lg @error('location_name') is-invalid @enderror"
                                value="{{ old('location_name') }}"
                                placeholder="Contoh: Pelabuhan Muara"
                                maxlength="255" required>
                            @error('location_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="form-label" for="address_details"><i class="bi bi-map me-1"></i>Alamat lengkap / patokan<span class="req" aria-hidden="true">*</span></label>
                            <textarea name="address_details" id="address_details"
                                class="form-control @error('address_details') is-invalid @enderror"
                                rows="4" maxlength="2000"
                                placeholder="Contoh: Depan warung makan Pak Budi, pinggir dermaga utara..."
                                required>{{ old('address_details') }}</textarea>
                            @error('address_details')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="hint">Tuliskan alamat atau patokan yang memudahkan petugas menemukan lokasi.</span>
                        </div>
                    </section>

                    <!-- 2. KEPADATAN -->
                    <section class="form-section">
                        <div class="step-head">
                            <div class="step-no">2</div>
                            <div>
                                <h2>Tingkat kepadatan<span class="req" aria-hidden="true">*</span></h2>
                                <p>Pilih yang paling sesuai dengan kondisi di lokasi.</p>
                            </div>
                        </div>

                        <div class="choice-grid">
                            <div class="choice">
                                <input type="radio" name="density_level" id="density_ringan" value="ringan" {{ old('density_level') == 'ringan' ? 'checked' : '' }} required>
                                <div class="choice-card"><i class="bi bi-reception-1"></i><strong>Ringan</strong></div>
                            </div>
                            <div class="choice">
                                <input type="radio" name="density_level" id="density_sedang" value="sedang" {{ old('density_level') == 'sedang' ? 'checked' : '' }}>
                                <div class="choice-card"><i class="bi bi-reception-2"></i><strong>Sedang</strong></div>
                            </div>
                            <div class="choice">
                                <input type="radio" name="density_level" id="density_berat" value="berat" {{ old('density_level') == 'berat' ? 'checked' : '' }}>
                                <div class="choice-card"><i class="bi bi-reception-4"></i><strong>Berat</strong></div>
                            </div>
                        </div>

                        @error('density_level')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </section>

                    <!-- 3. DAMPAK -->
                    <section class="form-section">
                        <div class="step-head">
                            <div class="step-no">3</div>
                            <div>
                                <h2>Dampak yang ditimbulkan</h2>
                                <p>Pilih satu atau lebih dampak yang terjadi.</p>
                            </div>
                        </div>

                        @php
                            $selectedImpacts = old('impacts', []);
                        @endphp

                        <div class="impact-grid">
                            <div class="choice">
                                <input type="checkbox" name="impacts[]" value="perahu" id="dampak1" {{ in_array('perahu', $selectedImpacts) ? 'checked' : '' }}>
                                <label class="impact-card w-100 mb-0" for="dampak1"><i class="bi bi-water"></i>Menghambat perahu</label>
                            </div>
                            <div class="choice">
                                <input type="checkbox" name="impacts[]" value="nelayan" id="dampak2" {{ in_array('nelayan', $selectedImpacts) ? 'checked' : '' }}>
                                <label class="impact-card w-100 mb-0" for="dampak2"><i class="bi bi-people"></i>Mengganggu nelayan</label>
                            </div>
                            <div class="choice">
                                <input type="checkbox" name="impacts[]" value="bau" id="dampak3" {{ in_array('bau', $selectedImpacts) ? 'checked' : '' }}>
                                <label class="impact-card w-100 mb-0" for="dampak3"><i class="bi bi-wind"></i>Bau tidak sedap</label>
                            </div>
                            <div class="choice">
                                <input type="checkbox" name="impacts[]" value="lingkungan" id="dampak4" {{ in_array('lingkungan', $selectedImpacts) ? 'checked' : '' }}>
                                <label class="impact-card w-100 mb-0" for="dampak4"><i class="bi bi-tree"></i>Mencemari lingkungan</label>
                            </div>
                        </div>

                        @error('impacts')
                            <div class="text-danger small mt-2">{{ $message }}</div>
                        @enderror
                    </section>

                    <!-- 4. FOTO -->
                    <section class="form-section">
                        <div class="step-head">
                            <div class="step-no">4</div>
                            <div>
                                <h2>Foto kondisi<span class="req" aria-hidden="true">*</span></h2>
                                <p>Foto membantu petugas menilai kondisi di lapangan.</p>
                            </div>
                        </div>

                        <div class="upload-box">
                            <i class="bi bi-cloud-arrow-up upload-icon"></i>
                            <label class="form-label d-block mb-0" for="photo">Unggah foto lokasi</label>
                            <input type="file" name="photo" id="photo"
                                class="form-control @error('photo') is-invalid @enderror"
                                accept="image/jpeg,image/png,image/jpg,image/webp"
                                required>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <span class="hint">Format JPG, JPEG, PNG, atau WEBP.</span>
                            <img id="photoPreview" alt="Pratinjau foto yang dipilih">
                        </div>
                    </section>

                    <!-- 5. IDENTITAS -->
                    <section class="form-section">
                        <div class="step-head">
                            <div class="step-no">5</div>
                            <div>
                                <h2>Identitas pelapor</h2>
                                <p>Boleh dikirim tanpa nama.</p>
                            </div>
                        </div>

                        <div class="anon-box">
                            <input type="checkbox" class="form-check-input" role="switch"
                                name="is_anonymous" id="is_anonymous" value="1"
                                {{ old('is_anonymous') ? 'checked' : '' }}>
                            <label for="is_anonymous">
                                Kirim sebagai anonim
                                <small>Identitas Anda tidak akan ditampilkan sebagai pelapor.</small>
                            </label>
                        </div>

                        <div id="identitas-pelapor">
                            <div class="mb-3">
                                <label class="form-label" for="reporter_name">Nama pelapor</label>
                                <input type="text" name="reporter_name" id="reporter_name"
                                    class="form-control @error('reporter_name') is-invalid @enderror"
                                    value="{{ old('reporter_name') }}"
                                    placeholder="Masukkan nama lengkap" maxlength="255">
                                @error('reporter_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label" for="reporter_phone">Nomor HP</label>
                                <input type="tel" name="reporter_phone" id="reporter_phone"
                                    class="form-control @error('reporter_phone') is-invalid @enderror"
                                    value="{{ old('reporter_phone') }}"
                                    placeholder="Contoh: 08xxxxxxxxxx" maxlength="20">
                                @error('reporter_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <span class="hint">Nomor HP digunakan operator untuk menghubungi pelapor.</span>
                            </div>
                        </div>
                    </section>

                    <!-- 6. CATATAN -->
                    <section class="form-section">
                        <div class="step-head">
                            <div class="step-no">6</div>
                            <div>
                                <h2>Catatan tambahan <span class="opt">— opsional</span></h2>
                                <p>Berlaku juga untuk laporan anonim.</p>
                            </div>
                        </div>

                        <textarea name="notes" id="notes"
                            class="form-control @error('notes') is-invalid @enderror"
                            rows="3" maxlength="5000"
                            placeholder="Tambahkan informasi lain jika diperlukan...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </section>

                    <div class="notice">
                        <i class="bi bi-info-circle-fill"></i>
                        <span>Pastikan informasi dan foto yang dikirim sesuai dengan kondisi sebenarnya.</span>
                    </div>

                    <button type="submit" class="btn btn-lake w-100">
                        <i class="bi bi-send-fill me-2"></i>Kirim laporan
                    </button>

                    <a href="/" class="btn-back">Kembali ke beranda</a>

                </form>
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

<!-- SCRIPT -->
<script>
    // Anonim: sembunyikan dan nonaktifkan nama + nomor HP
    const anonymousCheckbox = document.getElementById('is_anonymous');
    const identitySection = document.getElementById('identitas-pelapor');
    const reporterName = document.getElementById('reporter_name');
    const reporterPhone = document.getElementById('reporter_phone');

    function toggleIdentity() {
        const isAnonymous = anonymousCheckbox.checked;

        identitySection.style.display = isAnonymous ? 'none' : 'block';
        reporterName.disabled = isAnonymous;
        reporterPhone.disabled = isAnonymous;

        if (isAnonymous) {
            reporterName.value = '';
            reporterPhone.value = '';
        }
    }

    anonymousCheckbox.addEventListener('change', toggleIdentity);
    toggleIdentity();

    // Pratinjau foto yang dipilih
    document.getElementById('photo').addEventListener('change', function () {
        var preview = document.getElementById('photoPreview');
        var file = this.files && this.files[0];
        if (file && file.type.indexOf('image/') === 0) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        } else {
            preview.style.display = 'none';
        }
    });
</script>
@if(session('error') || $errors->any())
<script>
    // Arahkan layar ke pesan galat setelah kirim
    document.getElementById('form-laporan').scrollIntoView({ block: 'start' });
</script>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
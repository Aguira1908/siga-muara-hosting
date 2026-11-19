<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Login Admin — SIGAP KECAMATAN MUARA</title>

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
        body { font-family: 'Plus Jakarta Sans', sans-serif; color: var(--ink); background: var(--mint-50); min-height: 100vh; }
        h1, h2, .brand-name { font-family: 'Bricolage Grotesque', 'Plus Jakarta Sans', sans-serif; }
        a:focus-visible, button:focus-visible { outline: 3px solid var(--sun); outline-offset: 3px; }

        .login-wrap { min-height: 100vh; display: grid; grid-template-columns: 1.05fr 1fr; }

        /* panel merek */
        .brand-panel {
            position: relative; overflow: hidden; color: #fff; padding: 3rem;
            background: linear-gradient(150deg, var(--lake-800), var(--lake-950));
            display: flex; flex-direction: column; justify-content: space-between;
        }
        .brand-panel::after {
            content: ''; position: absolute; right: -120px; bottom: -120px; width: 420px; height: 420px; border-radius: 50%;
            background: radial-gradient(circle, rgba(16,185,129,.35), rgba(16,185,129,0) 70%);
        }
        .brand-panel > * { position: relative; z-index: 1; }
        .brand-link { color: #fff; text-decoration: none; font-weight: 800; font-size: 1.4rem; display: inline-flex; align-items: center; gap: .6rem; }
        .brand-link i { color: var(--sun); }
        .brand-panel h1 { font-weight: 800; font-size: clamp(2rem, 3.6vw, 3rem); line-height: 1.08; letter-spacing: -.02em; max-width: 14ch; margin-bottom: 1rem; }
        .brand-panel p { color: rgba(255,255,255,.85); line-height: 1.7; max-width: 42ch; margin: 0; }
        .brand-foot { color: rgba(255,255,255,.6); font-size: .85rem; }

        /* panel formulir */
        .form-panel { display: flex; align-items: center; justify-content: center; padding: 2rem 1.2rem; }
        .login-card { width: 100%; max-width: 420px; }
        .lock-icon { width: 64px; height: 64px; border-radius: 20px; display: grid; place-items: center; background: var(--mint-100); color: var(--lake-600); font-size: 1.8rem; margin-bottom: 1.2rem; }
        .login-card h2 { font-weight: 800; font-size: 1.9rem; color: var(--lake-800); margin-bottom: .3rem; }
        .login-card .sub { color: var(--ink-soft); margin-bottom: 1.8rem; }

        .form-label { color: var(--lake-800); font-weight: 700; font-size: .9rem; margin-bottom: .35rem; }
        .field { position: relative; }
        .field > i.lead-icon { position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: var(--ink-soft); pointer-events: none; }
        .field .form-control { border-radius: 14px; padding: .85rem 1rem .85rem 2.8rem; border: 1.5px solid #D4E6DC; background: #fff; }
        .field .form-control:focus { border-color: var(--leaf); box-shadow: 0 0 0 .22rem rgba(16,185,129,.18); }
        .toggle-pass { position: absolute; right: .5rem; top: 50%; transform: translateY(-50%); border: 0; background: transparent; color: var(--ink-soft); width: 40px; height: 40px; border-radius: 12px; }
        .toggle-pass:hover { background: var(--mint-100); color: var(--lake-800); }
        #password { padding-right: 3.2rem; }

        .btn-lake { background: var(--lake-600); color: #fff; font-weight: 700; border: 0; border-radius: 50px; padding: .95rem 1.5rem; font-size: 1.05rem; transition: background .2s ease, transform .2s ease; }
        .btn-lake:hover { background: var(--lake-800); color: #fff; transform: translateY(-2px); }
        .alert { border: 0; border-radius: 14px; }
        .back-link { display: inline-flex; align-items: center; gap: .4rem; color: var(--ink-soft); text-decoration: none; font-weight: 600; }
        .back-link:hover { color: var(--lake-800); text-decoration: underline; }

        @media (max-width: 899.98px) {
            .login-wrap { grid-template-columns: 1fr; }
            .brand-panel { padding: 1.6rem 1.4rem 2rem; }
            .brand-panel h1 { font-size: 1.7rem; margin-bottom: .6rem; }
            .brand-panel p, .brand-foot { display: none; }
            .form-panel { align-items: flex-start; padding-top: 2.2rem; }
        }
    </style>
</head>
<body>

<div class="login-wrap">

    <!-- PANEL MEREK -->
    <aside class="brand-panel">
        <a href="/" class="brand-link brand-name"><i class="bi bi-shield-check"></i>SIGAP KECAMATAN MUARA</a>

        <div class="my-5">
            <h1>Kelola aksi bersih Kecamatan Muara</h1>
            <p>Verifikasi laporan warga, atur kegiatan gotong royong, dan pantau dukungan masyarakat dalam satu tempat.</p>
        </div>

        <div class="brand-foot">&copy; {{ date('Y') }} Khusus pengelola.</div>
    </aside>

    <!-- PANEL FORMULIR -->
    <main class="form-panel">
        <div class="login-card">

            <div class="lock-icon"><i class="bi bi-shield-lock-fill"></i></div>
            <h2>Login Admin</h2>
            <p class="sub">Masuk untuk mengelola SIGAP KECAMATAN MUARA.</p>

            @if($errors->any())
                <div class="alert alert-danger py-2 small" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="email">Email</label>
                    <div class="field">
                        <i class="bi bi-envelope lead-icon"></i>
                        <input type="email" name="email" id="email" class="form-control form-control-lg"
                               value="{{ old('email') }}" placeholder="nama@email.com"
                               autocomplete="username" autofocus required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="password">Password</label>
                    <div class="field">
                        <i class="bi bi-lock lead-icon"></i>
                        <input type="password" name="password" id="password" class="form-control form-control-lg"
                               placeholder="Masukkan password" autocomplete="current-password" required>
                        <button type="button" class="toggle-pass" id="togglePass" aria-label="Tampilkan password">
                            <i class="bi bi-eye" id="togglePassIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-lake w-100">Masuk</button>
            </form>

            <div class="text-center mt-4">
                <a href="/" class="back-link"><i class="bi bi-arrow-left"></i>Kembali ke beranda</a>
            </div>

        </div>
    </main>

</div>

<script>
    // Tampilkan / sembunyikan password
    (function () {
        var input = document.getElementById('password');
        var btn = document.getElementById('togglePass');
        var icon = document.getElementById('togglePassIcon');

        btn.addEventListener('click', function () {
            var show = input.type === 'password';
            input.type = show ? 'text' : 'password';
            icon.className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
            btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        });
    })();
</script>
</body>
</html>
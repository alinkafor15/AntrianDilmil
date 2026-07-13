<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Antrian Elektronik - DILMIL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            /* 🎨 LATAR BELAKANG TERANG, BERSIH & LEMBUT */
            background-color: #f4f6f9;
            color: #333333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        /* 📦 SINGLE BOX KOTAK UTAMA (PUTIH BERSIH DENGAN SHADOW HALUS) */
        .portal-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
        }

        /* Sisi Kiri: Form Login */
        .login-side {
            background: #fdfdfd;
            padding: 3.5rem 3rem;
            border-right: 1px solid #edf2f7;
        }

        /* Sisi Kanan: Menu Publik */
        .public-side {
            background: #ffffff;
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.5rem;
        }

        .form-control {
            background: #ffffff;
            color: #2d3748;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 14px;
            font-weight: 500;
        }

        .form-control:focus {
            background: #ffffff;
            color: #2d3748;
            border-color: #198754;
            /* Fokus Hijau Peradilan */
            box-shadow: 0 0 0 4px rgba(25, 135, 84, 0.15);
        }

        .input-group-text {
            background: #f8fafc;
            border: 2px solid #e2e8f0;
            border-right: none;
            border-radius: 10px;
            color: #718096;
            padding-left: 18px;
        }

        /* 🟢 TOMBOL LOGIN (HIJAU KORPS SOLID) */
        .btn-submit-ptsp {
            background-color: #198754;
            color: white;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-submit-ptsp:hover {
            background-color: #146c43;
            color: white;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2);
        }

        /* 🔓 MENU LINK PUBLIK (TERANG & INTERAKTIF) */
        .menu-link {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            color: #2d3748;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .menu-link:hover {
            background: #edf2f7;
            border-color: #cbd5e0;
            color: #1a202c;
            transform: translateX(6px);
        }

        /* Kotak Icon Kalem dengan Latar Terang */
        .icon-wrapper-gold {
            background: rgba(217, 119, 6, 0.1);
            color: #d97706;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .icon-wrapper-blue {
            background: rgba(3, 105, 161, 0.1);
            color: #0369a1;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold m-0 text-dark" style="font-size: 2.6rem; letter-spacing: 2px;">SISTEM ANTRIAN ELEKTRONIK
            </h1>
            <h4 class="text-muted fw-normal mt-2">Pengadilan Militer IV-15 Banjarmasin</h4>
        </div>

        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-11">

                <div class="portal-card">
                    <div class="row g-0">

                        <div class="col-md-6 login-side">
                            <div class="mb-4 text-center text-md-start">
                                <div
                                    class="d-inline-block bg-success bg-opacity-10 text-success px-3 py-1 rounded border border-success border-opacity-25 small fw-semibold mb-3">
                                    <i class="bi bi-shield-lock-fill me-1"></i> AUTENTIKASI OPERATOR
                                </div>
                                <h3 class="fw-bold m-0 text-dark">Login</h3>
                                <p class="text-muted small mt-1">Masukkan akun layanan Anda.</p>
                            </div>

                            <form action="/login" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label small fw-semibold text-secondary">Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person text-muted"></i></span>
                                        <input type="text" name="username" class="form-control"
                                            value="{{ old('username') }}" placeholder="Masukkan Username..." required
                                            autofocus autocomplete="off">
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label small fw-semibold text-secondary">Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-key text-muted"></i></span>
                                        <input type="password" name="password" id="password-field" class="form-control"
                                            placeholder="Masukkan Password..." required>
                                        <button class="btn btn-outline-secondary border-start-0" type="button"
                                            id="toggle-password" style="border-color: #e2e8f0; background: #ffffff;">
                                            <i class="bi bi-eye-slash text-muted" id="eye-icon"></i>
                                        </button>
                                    </div>
                                </div>

                                @if ($errors->any())
                                    <div
                                        class="alert alert-danger py-2 small border-0 bg-danger bg-opacity-10 text-danger mb-3 rounded-3">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
                                    </div>
                                @endif

                                <button type="submit"
                                    class="btn btn-submit-ptsp w-100 fw-bold py-3 rounded-3 mt-2 shadow-sm text-uppercase tracking-wider">
                                    Masuk Ke Operator Layanan <i class="bi bi-chevron-right ms-1"></i>
                                </button>
                            </form>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    const passwordField = document.getElementById("password-field");
                                    const togglePasswordBtn = document.getElementById("toggle-password");
                                    const eyeIcon = document.getElementById("eye-icon");

                                    togglePasswordBtn.addEventListener("click", function () {
                                        if (passwordField.type === "password") {
                                            passwordField.type = "text";
                                            eyeIcon.className = "bi bi-eye text-success";
                                        } else {
                                            passwordField.type = "password";
                                            eyeIcon.className = "bi bi-eye-slash text-muted";
                                        }
                                    });
                                });
                            </script>
                        </div>

                        <div class="col-md-6 public-side">
                            <div class="mb-2">
                                <h3 class="fw-bold m-0 text-dark">Menu Akses Terbuka</h3>
                                <p class="text-muted small mt-1">Dapat diakses langsung.
                                </p>
                            </div>

                            <a href="/ambil-antrian" class="menu-link">
                                <div class="icon-wrapper-gold">
                                    <i class="bi bi-printer fs-3"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold m-0 text-dark">Ambil Antrian Baru</h5>
                                    <p class="m-0 text-muted small mt-1">Cetak nomor antrian secara mandiri di
                                        mesin cetak nomor antrian(Jika Ada).</p>
                                </div>
                            </a>

                            <a href="/monitor-display" class="menu-link">
                                <div class="icon-wrapper-blue">
                                    <i class="bi bi-display fs-3"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold m-0 text-dark">Buka Monitor Ruang Tunggu</h5>
                                    <p class="m-0 text-muted small mt-1">Tampilkan papan informasi visual antrean ke TV
                                        monitor.</p>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
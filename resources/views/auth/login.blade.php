<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | MyApp</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
        }

        .login-card {
            border-radius: 1rem;
        }

        .input-group .form-control:focus {
            z-index: 2;
        }

        .toggle-password {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <!-- card login -->
        <div class="card shadow-sm p-4 login-card" style="width: 100%; max-width: 400px;">
            <h4 class="text-center mb-4">Login ke Akun Anda</h4>

            <!-- form login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf <!-- token keamanan untuk mencegah CSRF -->

                {{-- email user --}}
                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" name="email" class="form-control" id="email"
                        placeholder="email@example.com" required autofocus>
                </div>

                {{-- password --}}
                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <div class="input-group">
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="••••••••" required>
                        <!-- tombol toggle untuk melihat password -->
                        <span class="input-group-text toggle-password" onclick="togglePassword()">
                            <i class="bi bi-eye-slash" id="eyeIcon"></i>
                        </span>
                    </div>
                </div>

                {{-- button --}}
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <!-- link ke halaman register -->
            <div class="text-center mt-3">
                <small>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></small>
            </div>
        </div>
    </div>

    <!-- Script untuk toggle password -->
    <script>
        // fungsi ini akan dipanggil saat ikon "eye" diklik
        function togglePassword() {
            // ambil elemen input password berdasarkan id-nya
            const passwordInput = document.getElementById("password");

            // ambil elemen ikon mata berdasarkan id-nya (biasanya pakai Bootstrap Icons)
            const eyeIcon = document.getElementById("eyeIcon");

            // cek apakah input bertipe 'password'
            if (passwordInput.type === "password") {
                // kalau iya, ubah tipe input jadi 'text' agar password terlihat
                passwordInput.type = "text";

                // ganti ikon mata: hapus ikon "tertutup" dan tambahkan ikon "terbuka"
                eyeIcon.classList.remove("bi-eye-slash"); // ikon mata tertutup
                eyeIcon.classList.add("bi-eye"); // ikon mata terbuka
            } else {
                // kalau sekarang sudah 'text', ubah kembali ke 'password' agar disembunyikan
                passwordInput.type = "password";

                // balik lagi ke ikon mata tertutup
                eyeIcon.classList.remove("bi-eye"); // hapus ikon terbuka
                eyeIcon.classList.add("bi-eye-slash"); // tambahkan ikon tertutup
            }
        }
    </script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

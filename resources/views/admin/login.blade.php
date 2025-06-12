<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Teknik Metalurgi IT Del</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('aset/img/logo.png') }}">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* Mengatur background dan font utama */
        body {
            background-image: linear-gradient(rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.7)), url('/aset/img/poster.png');
            background-size: cover;
            background-position: center;
            font-family: 'Inter', sans-serif;
        }

        /* Efek kaca buram (glassmorphism) pada container */
        .login-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: slide-in 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
        }

        /* Animasi form muncul dari bawah */
        @keyframes slide-in {
            0% {
                transform: translateY(50px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Gaya custom untuk input field */
        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            /* text-gray-400 */
            transition: color 0.3s ease;
        }

        /*
         * PENTING:
         * Kita tidak perlu lagi mendefinisikan padding-left di sini
         * karena akan diatur oleh kelas utilitas Tailwind untuk menghindari konflik.
         */
        .input-field {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        .input-field::placeholder {
            color: #9ca3af;
            /* text-gray-400 */
        }

        .input-field:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #3b82f6;
            /* blue-500 */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.4);
        }

        .input-field:focus+.input-icon {
            color: #3b82f6;
            /* blue-500 */
        }

        /* Tombol dengan gradasi dan efek modern */
        .login-btn {
            background-image: linear-gradient(to right, #3b82f6, #60a5fa);
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(96, 165, 250, 0.2);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4 text-gray-200">

    <div class="w-full max-w-md login-container px-8 py-10">

        <!-- Header Form -->
        <div class="text-center mb-8">
            <img src="{{ asset('aset/img/logo.png') }}" alt="Logo IT Del" class="mx-auto h-20 w-20 mb-4 drop-shadow-lg">
            <h2 class="text-3xl font-bold text-white">Admin Panel</h2>
            <p class="text-gray-300 mt-1">Teknik Metalurgi IT Del</p>
        </div>

        <!-- Notifikasi Status -->
        @if (session('status'))
            <div class="bg-green-500/20 border border-green-500 text-green-200 text-sm px-4 py-3 rounded-lg relative mb-4"
                role="alert">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form Login -->
        <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Input Email -->
            <div>
                <label for="email" class="sr-only">Email</label>
                <div class="input-group">
                    {{-- PERBAIKAN: Gunakan padding kiri (pl) yang lebih besar dari padding kanan (pr) --}}
                    <input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}"
                        required class="input-field w-full pl-12 pr-4 py-3 rounded-lg focus:outline-none"
                        placeholder="Alamat Email">
                    <i class="input-icon fas fa-envelope"></i>
                </div>
                @error('email')
                    <p class="text-sm text-red-400 mt-2 animate-pulse">{{ $message }}</p>
                @enderror
            </div>

            <!-- Input Password -->
            <div>
                <label for="password" class="sr-only">Password</label>
                <div class="input-group">
                    {{-- PERBAIKAN: Sama seperti di atas --}}
                    <input id="password" name="password" type="password" autocomplete="current-password" required
                        class="input-field w-full pl-12 pr-4 py-3 rounded-lg focus:outline-none" placeholder="Password">
                    <i class="input-icon fas fa-lock"></i>
                </div>
            </div>


            <!-- Opsi Tambahan -->
            <div class="flex items-center justify-between">
                <div class="text-sm">
                    <a href="{{ route('admin.password.request') }}"
                        class="font-medium text-blue-400 hover:text-blue-300 transition-colors">
                        Lupa password?
                    </a>
                </div>
            </div>

            <!-- Tombol Login -->
            <div>
                <button type="submit"
                    class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white login-btn focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-900 focus:ring-blue-500">
                    Masuk
                </button>
            </div>
        </form>
    </div>

</body>

</html>

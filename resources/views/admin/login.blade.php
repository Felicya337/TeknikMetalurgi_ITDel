<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Teknik Metalurgi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: url('/aset/img/poster.png') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .login-container {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(12px);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .input-field:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3);
        }

        .login-btn:hover {
            transform: scale(1.02);
            box-shadow: 0 6px 16px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-md login-container px-8 py-10">
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Login Admin</h2>

        @if (session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-3 border input-field rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 border input-field rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-300">
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <label class="flex items-center text-sm text-gray-600">
                    <input type="checkbox" name="remember" class="mr-2">
                    Simpan Email & Password
                </label>
            </div>

            <button type="submit"
                class="w-full py-3 login-btn bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition-all">
                Masuk ke Dashboard
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-8">© Teknik Metalurgi. All rights reserved.</p>
    </div>
</body>

</html>

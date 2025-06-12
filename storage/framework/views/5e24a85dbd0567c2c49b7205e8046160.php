<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password | Admin Panel</title>
    <!-- Memuat semua aset yang sama dengan halaman login -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="icon" type="image/png" href="<?php echo e(asset('aset/img/logo.png')); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Memuat CSS yang sama persis untuk konsistensi -->
    <style>
        body {
            background-image: linear-gradient(rgba(15, 23, 42, 0.7), rgba(15, 23, 42, 0.7)), url('/aset/img/poster.png');
            background-size: cover;
            background-position: center;
            font-family: 'Inter', sans-serif;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            animation: slide-in 0.7s cubic-bezier(0.25, 0.46, 0.45, 0.94) both;
        }

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

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            transition: color 0.3s ease;
        }

        .input-field {
            padding-left: 3rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        .input-field::placeholder {
            color: #9ca3af;
        }

        .input-field:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.4);
        }

        .input-field:focus+.input-icon {
            color: #3b82f6;
        }

        .submit-btn {
            background-image: linear-gradient(to right, #3b82f6, #60a5fa);
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(96, 165, 250, 0.2);
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4 text-gray-200">
    <div class="w-full max-w-md form-container px-8 py-10">
        <h2 class="text-2xl font-bold text-center mb-4 text-white">Lupa Password?</h2>
        <p class="text-center text-gray-300 mb-6 text-sm">Jangan khawatir. Masukkan email Anda dan kami akan mengirimkan
            link untuk membuat password baru.</p>

        <?php if (session('status')): ?>
            <div class="bg-green-500/20 border border-green-500 text-green-200 text-sm px-4 py-3 rounded-lg relative mb-4"
                role="alert">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.password.email')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <div class="input-group">
                    <input id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" required
                        class="input-field w-full rounded-lg focus:outline-none" placeholder="Masukkan email terdaftar">
                    <i class="input-icon fas fa-envelope"></i>
                </div>
                <?php $__errorArgs = ['email'];
                $__bag = $errors->getBag($__errorArgs[1] ?? 'default');
                if ($__bag->has($__errorArgs[0])) :
                    if (isset($message)) {
                        $__messageOriginal = $message;
                    }
                    $message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-sm text-red-400 mt-2"><?php echo e($message); ?></p>
                <?php unset($message);
                    if (isset($__messageOriginal)) {
                        $message = $__messageOriginal;
                    }
                endif;
                unset($__errorArgs, $__bag); ?>
            </div>
            <div>
                <button type="submit"
                    class="submit-btn w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white">
                    Kirim Link Reset
                </button>
            </div>
        </form>
        <div class="text-center mt-6">
            <a href="<?php echo e(route('admin.login.form')); ?>"
                class="text-sm font-medium text-blue-400 hover:text-blue-300 transition-colors">
                <i class="fas fa-arrow-left mr-1"></i> Kembali ke Login
            </a>
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/admin/auth/forgot-password.blade.php ENDPATH**/ ?>
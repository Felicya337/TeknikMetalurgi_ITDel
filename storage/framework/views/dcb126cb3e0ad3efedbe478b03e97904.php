<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($inquiry->type === 'question' ? 'Jawaban untuk Pertanyaan Anda' : 'Tanggapan atas Ulasan Anda'); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
        }

        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid #dee2e6;
        }

        .content {
            padding: 20px;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
            font-size: 12px;
        }

        @media only screen and (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .content {
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1><?php echo e($inquiry->type === 'question' ? 'Jawaban untuk Pertanyaan Anda' : 'Tanggapan atas Ulasan Anda'); ?>

            </h1>
        </div>
        <div class="content">
            <p>Terima kasih telah menghubungi TeknikMetalurgiITDel.</p>
            <h3>Detail <?php echo e($inquiry->type === 'question' ? 'Pertanyaan' : 'Ulasan'); ?> Anda:</h3>
            <ul>
                <li><strong>Email:</strong> <?php echo e($inquiry->email); ?></li>
                <?php if($inquiry->type === 'question'): ?>
                    <li><strong>Tipe Pengguna:</strong>
                        <?php echo e($inquiry->user_type === 'internal' ? 'Mahasiswa/Dosen/Staff IT Del' : 'Masyarakat Umum'); ?>

                    </li>
                <?php else: ?>
                    <li><strong>Rating:</strong> <?php echo e(str_repeat('⭐', $inquiry->rating ?? 0)); ?></li>
                <?php endif; ?>
                <li><strong>Isi:</strong> <?php echo e(nl2br(e($inquiry->content))); ?></li>
            </ul>
            <h3>Tanggapan Admin:</h3>
            <p><?php echo e(nl2br(e($inquiry->admin_response))); ?></p>
            <p>Kami menghargai masukan Anda. Jika ada pertanyaan lebih lanjut, silakan hubungi kami di <a
                    href="mailto:info@del.ac.id" style="color: #007bff;">info@del.ac.id</a>.</p>
            <p style="text-align: center;">
                <a href="<?php echo e(url('/')); ?>" class="button">Kunjungi Website Kami</a>
            </p>
        </div>
        <div class="footer">
            <p>Terima kasih,<br>Tim TeknikMetalurgiITDel</p>
            <p>© <?php echo e(date('Y')); ?> IT Del. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/emails/inquiry_response.blade.php ENDPATH**/ ?>
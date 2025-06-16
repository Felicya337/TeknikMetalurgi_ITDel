 

<?php $__env->startSection('content'); ?>
    <div class="container">
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumbs">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(url('/metaprofile')); ?>" class="text-decoration-none">Profil</a>
                </li>
                <li class="breadcrumb-item current-page"><b>Kurikulum</b></li>
            </ol>
        </nav>

        
        <h3 class="header-title">KURIKULUM</h3>


        
        <div class="curriculum-description">
            <div class="curriculum-image">
                <img src="<?php echo e(asset('aset/img/kurikulum.jpg')); ?>" alt="Kurikulum Teknik Metalurgi">
            </div>
            <div class="curriculum-text">
                Salah satu unsur utama untuk mencapai pembelajaran yang baik, Perguruan Tinggi harus memiliki rancangan
                pembelajaran dalam bentuk kurikulum yang disusun berdasarkan kebutuhan dan tantangan di masa depan.
                Kurikulum 2023 merupakan kurikulum yang pertama kali yang diterapkan pada Prodi Teknik Metalurgi Institut
                Teknologi Del. Penyusunan kurikulum ini didasarkan pada konsep ilmu dasar serta perkembangan dan kebutuhan
                ilmu metalurgi pada dunia industri. Rumusan kompetensi dan urutan strategi pembelajarannya yang disusun
                secara bertahap menurut semesternya.
            </div>
        </div>

        
        <?php
            $maxSemester = 8; // Asumsi maksimal 8 semester
        ?>

        <?php for($i = 1; $i <= $maxSemester; $i += 2): ?>
            <div class="semester-container">
                
                <div class="semester-table-container">
                    <div class="semester-title">SEMESTER <?php echo e($i); ?></div>
                    <table class="semester-table">
                        <thead>
                            <tr>
                                <th>Kode Mata Kuliah</th>
                                <th>Nama Mata Kuliah</th>
                                <th>SKS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(isset($curriculums[$i]) && $curriculums[$i]->isNotEmpty()): ?>
                                <?php $__currentLoopData = $curriculums[$i]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($course->course_code); ?></td>
                                        <td><?php echo e($course->course_name); ?></td>
                                        <td><?php echo e($course->credits); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center">Belum ada data mata kuliah</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                
                <?php if($i + 1 <= $maxSemester): ?>
                    <div class="semester-table-container">
                        <div class="semester-title">SEMESTER <?php echo e($i + 1); ?></div>
                        <table class="semester-table">
                            <thead>
                                <tr>
                                    <th>Kode Mata Kuliah</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th>SKS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(isset($curriculums[$i + 1]) && $curriculums[$i + 1]->isNotEmpty()): ?>
                                    <?php $__currentLoopData = $curriculums[$i + 1]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($course->course_code); ?></td>
                                            <td><?php echo e($course->course_name); ?></td>
                                            <td><?php echo e($course->credits); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="text-center">Belum ada data mata kuliah</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="semester-table-container"></div>
                <?php endif; ?>
            </div>
        <?php endfor; ?>
    </div>

    <style>
        /* Header Styles */
        .header-title {
            text-align: center;
            font-size: 30px;
            font-weight: 700;
            color: #000000;
            margin-bottom: 3rem;
        }

        /* Curriculum Description */
        .curriculum-description {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            gap: 20px;
        }

        .curriculum-image {
            flex: 0 0 300px;
        }

        .curriculum-image img {
            width: 100%;
            height: auto;
            border-radius: 5px;
            object-fit: cover;
        }

        .curriculum-text {
            flex: 1;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
            text-align: justify;
        }

        /* Semester Table Styles */
        .semester-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            gap: 50px;
        }

        .semester-table-container {
            flex: 1;
            max-width: 100%;
        }

        .semester-title {
            text-align: center;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
            background-color: #ffffff;
            padding: 12px;
            border-radius: 5px;
        }

        .semester-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            border: 1px solid #ffffff;
            overflow: hidden;
        }

        .semester-table th,
        .semester-table td {
            padding: 10px 10px;
            text-align: center;
            border-bottom: 1px solid #000000;
        }

        .semester-table th {
            background-color: #D9D9D9;
            font-weight: 600;
            color: #333;
            font-size: 14px;
            border-bottom: 2px solid #dee2e6;
        }

        .semester-table td {
            font-size: 14px;
            color: #000000;
        }

        .semester-table td:first-child {
            font-weight: 500;
        }

        /* Mengatur lebar kolom sama */
        .semester-table th:nth-child(1),
        .semester-table th:nth-child(2),
        .semester-table td:nth-child(1),
        .semester-table td:nth-child(2) {
            width: 40%;
            /* Sesuaikan persentase agar sama */
            text-align: center;
            /* Mengatur teks di tengah untuk Nama Mata Kuliah */
        }

        /* Menghapus padding kiri spesifik untuk Nama Mata Kuliah jika tidak diperlukan */
        .semester-table td:nth-child(2) {
            text-align: center;
            /* Pastikan teks rata tengah */
        }

        .semester-table tbody tr:hover {
            background-color: #ffffff;
        }

        .text-center {
            text-align: center;
            color: #000000;
            font-style: italic;
        }

        /* Media Queries for Responsiveness */
        @media (max-width: 992px) {
            .semester-container {
                flex-direction: column;
                gap: 20px;
            }

            .semester-table-container {
                width: 100%;
                max-width: 100%;
            }

            .curriculum-description {
                flex-direction: column;
                text-align: center;
            }

            .curriculum-image {
                margin-bottom: 20px;
                width: 100%;
                max-width: 300px;
                align-self: center;
            }
        }

        @media (max-width: 768px) {
            .curriculum-description {
                padding: 15px;
            }

            .curriculum-image {
                max-width: 250px;
            }

            .semester-table th,
            .semester-table td {
                padding: 8px;
                font-size: 12px;
            }

            .semester-title {
                font-size: 16px;
            }
        }

        @media (max-width: 576px) {
            .header h1 {
                font-size: 20px;
            }

            .curriculum-text {
                font-size: 12px;
            }

            .semester-title {
                font-size: 14px;
            }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/curriculum.blade.php ENDPATH**/ ?>
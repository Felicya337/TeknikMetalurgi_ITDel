<?php $__env->startSection('content'); ?>
    <style>
        /* Updated CSS for proper dotted line alignment, text indentation, and vision-mission layout */
        .content-wrapper {
            background-color: #fff;
            padding-bottom: 40px;
        }

        .profile-container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-color: #fff;
        }

        .number-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            max-width: 1000px;
            position: relative;
            padding: 0;
        }

        .nav-number {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ddd;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            text-align: center;
            user-select: none;
            transition: background-color 0.3s ease;
            z-index: 1;
            flex-shrink: 0;
        }

        .nav-number.active {
            background-color: #007bff;
        }

        .nav-number:hover {
            background-color: #ccc;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            width: auto;
        }

        .nav-label {
            margin-top: 10px;
            color: #333;
            font-size: 12px;
            font-weight: normal;
            text-align: center;
            line-height: 1.2;
            max-width: 200px;
            white球球white-space: normal;
            z-index: 2;
        }

        .number-nav::before {
            content: "";
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            height: 2px;
            background: repeating-linear-gradient(to right,
                    #000 0,
                    #000 5px,
                    transparent 5px,
                    transparent 15px);
            z-index: 0;
        }

        @media (max-width: 768px) {
            .number-nav {
                flex-direction: column;
                align-items: center;
            }

            .nav-number {
                position: static;
                width: 30px;
                height: 30px;
                font-size: 14px;
                margin-bottom: 20px;
            }

            .nav-label {
                font-size: 12px;
                margin-top: 8px;
                max-width: 100%;
                white-space: normal;
            }

            .number-nav::before {
                display: none;
            }

            #nav-sejarah-btn,
            #nav-visi-misi-btn,
            #nav-prospek-btn {
                left: auto;
                right: auto;
                transform: none;
            }
        }

        .image-gallery {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 30px;
            padding: 0 20px;
        }

        .image-gallery img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .content-section#sejarah .image-gallery>p,
        .content-section#prospek-kerja .image-gallery>p {
            font-size: 14px;
            color: #333;
            line-height: 1.6;
            margin: 0;
            text-align: justify;
            padding: 10px 0;
            text-indent: 40px;
            padding-left: 50px;
            padding-right: 50px;
        }

        .title {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            background-color: #fff;
        }

        .image-overlay {
            position: relative;
            text-align: center;
            color: #fff;
            font-size: 24px;
            font-weight: bold;
        }

        .image-overlay img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .image-overlay span {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .vision-mission-container {
            display: flex;
            justify-content: space-between;
            align-items: stretch;
            padding: 0 50px;
        }

        .vision-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .vision-content:first-child {
            flex-basis: 40%;
            flex-grow: 0;
            padding-right: 20px;
        }

        .vision-content:last-child {
            flex-basis: 60%;
            flex-grow: 1;
            padding-left: 20px;
        }

        .vision-title {
            color: #007bff;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .vision-content p {
            font-size: 14px;
            color: #333;
            line-height: 1.6;
            text-align: justify;
            margin: 0;
            text-indent: 0px;
        }

        .divider-line {
            width: 2px;
            background-color: #000;
            align-self: stretch;
        }

        .content-section#prospek-kerja .prospek-title {
            color: #007bff;
            font-weight: bold;
            margin: 15px 0 5px 0;
            padding-left: 50px;
            padding-right: 50px;
        }

        .content-section#prospek-kerja .prospek-subtitle {
            font-weight: bold;
            margin: 10px 0 5px 0;
            padding-left: 50px;
            padding-right: 50px;
        }

        .content-section#prospek-kerja .prospek-list {
            padding-left: 70px;
            padding-right: 50px;
            list-style-position: outside;
        }

        .content-section#prospek-kerja .prospek-list li {
            margin-bottom: 5px;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
            text-align: justify;
        }

        .prospek-grid-container {
            padding: 20px 30px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .prospek-row {
            margin-bottom: 25px;
        }

        .prospek-category {
            color: #0078c3;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 5px;
            text-align: left;
        }

        .job-roles {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 15px;
        }

        .job-role {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            justify-content: flex-start;
            align-items: flex-start;
        }

        .role-title {
            color: #000000;
            padding: 5px 12px;
            font-size: 13px;
            font-weight: 500;
            white-space: nowrap;
        }

        .job-duties {
            list-style-type: disc;
            padding-left: 20px;
            margin: 0;
        }

        .job-duties li {
            margin-bottom: 8px;
            font-size: 14px;
            color: #333;
            line-height: 1.6;
            text-align: justify;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .prospek-grid-container {
                padding: 15px;
            }

            .prospek-card {
                padding: 15px;
            }

            .job-role {
                flex-direction: column;
                align-items: center;
                gap: 8px;
            }

            .prospek-category {
                font-size: 14px;
            }

            .role-title {
                font-size: 11px;
                padding: 4px 10px;
            }
        }
    </style>

    <!-- JavaScript for handling navigation and breadcrumb interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const navNumbers = document.querySelectorAll('.nav-number');
            const contentSections = document.querySelectorAll('.content-section');

            const navMap = {
                'nav-sejarah-btn': 0,
                'nav-visi-misi-btn': 1,
                'nav-prospek-btn': 2
            };

            function showSection(index) {
                contentSections.forEach(section => section.style.display = 'none');
                navNumbers.forEach(n => n.classList.remove('active'));

                if (contentSections[index]) {
                    contentSections[index].style.display = 'block';
                }
                if (navNumbers[index]) {
                    navNumbers[index].classList.add('active');
                }
            }

            navNumbers.forEach((numberElement) => {
                numberElement.addEventListener('click', function() {
                    const navId = this.id;
                    if (navMap.hasOwnProperty(navId)) {
                        showSection(navMap[navId]);
                        const hashes = ['#sejarah', '#visi-misi', '#prospek-kerja'];
                        if (window.location.hash !== hashes[navMap[navId]]) {
                            window.location.hash = hashes[navMap[navId]];
                        }
                    }
                });
            });

            function handleHash() {
                const hash = window.location.hash;
                let sectionIndexToShow = 0;
                if (hash === '#sejarah') {
                    sectionIndexToShow = 0;
                } else if (hash === '#visi-misi') {
                    sectionIndexToShow = 1;
                } else if (hash === '#prospek-kerja') {
                    sectionIndexToShow = 2;
                }
                showSection(sectionIndexToShow);
            }

            handleHash();
            window.addEventListener('hashchange', handleHash);

            document.querySelectorAll('.breadcrumb-link[data-target]').forEach(link => {
                link.addEventListener('click', function(e) {
                    const targetHash = this.getAttribute('data-target');
                    if (targetHash) {
                        e.preventDefault();
                        if (window.location.hash !== targetHash) {
                            window.location.hash = targetHash;
                        } else {
                            handleHash();
                        }
                    }
                });
            });
        });
    </script>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="<?php echo e(url('/metaprofile')); ?>" class="text-decoration-none">Profil</a>
            </li>
            <li class="breadcrumb-item current-page"><b>Sejarah, Visi dan Misi Keilmuan, Prospek Kerja</b></li>
        </ol>
    </nav>
    <!-- Judul -->
    <div class="title">PROFIL UMUM</div>

    <!-- Number Nav -->
    <div class="profile-container">
        <div class="number-nav">
            <div class="nav-item">
                <div class="nav-number active" id="nav-sejarah-btn">
                    <span>1</span>
                </div>
                <div class="nav-label">SEJARAH PROGRAM STUDI TEKNIK METALURGI</div>
            </div>
            <div class="nav-item">
                <div class="nav-number" id="nav-visi-misi-btn">
                    <span>2</span>
                </div>
                <div class="nav-label">VISI DAN MISI KEILMUAN</div>
            </div>
            <div class="nav-item">
                <div class="nav-number" id="nav-prospek-btn">
                    <span>3</span>
                </div>
                <div class="nav-label">PROSPEK KERJA</div>
            </div>
        </div>
    </div>

    <!-- Content Section 1: Sejarah (STATIC) -->
    <div class="content-section" id="sejarah">
        <div class="image-gallery">
            <div class="image-overlay">
                <img src="<?php echo e(asset('aset/img/mp1.png')); ?>" alt="Gambar 1">
            </div>
            <p>Program Studi Sarjana Teknik Metalurgi di Institut Teknologi Del (untuk selanjutnya disebut sebagai
                Prodi
                Teknik Metalurgi) didirikan berdasarkan Surat Keputusan Menteri Pendidikan, Kebudayaan, Riset dan
                Teknologi
                No.
                5698/E1/HK.03.00/0/2023 tahun 2023. Pendirian Prodi Teknik Metalurgi di Institut Teknologi Del
                merupakan
                bentuk dukungan terhadap program pemerintah dalam melakukan hilirisasi bahan tambang di Indonesia.
                Institut
                Teknologi Del menjalin kerja sama dengan sejumlah perusahaan dalam rangka mendukung pengembangan
                Program
                Studi baru,
                yaitu Program Studi Teknik Metalurgi. Kerja sama ini bertujuan untuk memperkuat kurikulum,
                menyediakan
                fasilitas
                pendukung, serta membuka peluang magang dan riset terapan bagi mahasiswa.</p>
            <div class="image-overlay">
                <img src="<?php echo e(asset('aset/img/mp2.png')); ?>" alt="Gambar 2">
            </div>
            <p>Politeknik Informatika Del didirikan oleh Yayasan Del sesuai dengan visi dan misinya untuk
                menyediakan akses
                pendidikan berkualitas di daerah terpencil bagi siswa berprestasi, khususnya yang berasal dari latar
                belakang ekonomi lemah. Politeknik Informatika Del (PI Del) resmi berdiri pada tahun 2001 dan
                menyelenggarakan
                pendidikan program Diploma 3 untuk Teknik Informatika, Teknik Komputer, dan Manajemen Informasi,
                serta
                Diploma 4 untuk
                Teknik Informatika. Berdasarkan Surat Keputusan Menteri Pendidikan dan Kebudayaan Republik Indonesia
                No.
                266/E/O/2013 tertanggal 6 Juli 2013, PI Del secara resmi berubah status menjadi Institut Teknologi
                Del (IT
                Del). Seiring dengan perubahan ini, IT Del mengembangkan Fakultas baru yaitu Fakultas Teknologi
                Industri.
                Fakultas
                Teknologi Industri memiliki Program Studi Manajemen Rekayasa (PSMR) dan pada tahun 2023 terdapat
                Program
                Studi baru yaitu Program Studi Teknik Metalurgi (PSTM). Fakultas Teknologi Industri didirikan pada
                tahun
                2013.
                Saat ini, Fakultas Teknologi Industri dipimpin oleh Dr. Fitriani Tupa R. Silalahi sebagai Dekan,
                dengan
                Rizal
                Horas Manahan Sinaga, S.Si., M.T., Ph.D. menjabat sebagai Kepala Program Studi Teknik Metalurgi.</p>
            <div class="image-overlay">
                <img src="<?php echo e(asset('aset/img/mp3.png')); ?>" alt="Gambar 3">
            </div>
            <p>Program Studi Teknik Metalurgi mulai menerima mahasiswa baru sejak tahun akademik 2023/2024, dengan
                total
                penerimaan awal sebanyak 35 orang mahasiswa pada tahun 2023 dan 55 orang mahasiswa pada tahun 2024.
                Saat
                ini, jumlah dosen Prodi Teknik Metalurgi secara de facto adalah sebanyak 5 orang, dan seluruhnya
                telah
                terdaftar
                pada Pangkalan Data Pendidikan Tinggi (PDDikti). Dengan jumlah mahasiswa aktif sebanyak 90 orang.
                Pada tahun
                2023, PSTM telah melaksanakan akreditasi dan memperoleh akreditasi B dari Badan Akreditasi Nasional
                Perguruan
                Tinggi (BAN-PT) berdasarkan Keputusan BAN-PT No. 0461/SK/LAM Teknik/PB.AS/XII/2023.</p>
            <div class="image-overlay">
                <img src="<?php echo e(asset('aset/img/mp4.png')); ?>" alt="mp 4">
            </div>
            <p>Untuk mendukung penyelenggaraan proses pembelajaran yang optimal pada Program Studi Teknik Metalurgi,
                Institut Teknologi Del mendirikan Gedung Program Studi Teknik Metalurgi. Gedung ini dirancang secara
                khusus
                untuk
                memenuhi kebutuhan akademik dan praktikum mahasiswa, serta menunjang kegiatan dosen dan tenaga
                kependidikan.
                Fasilitas yang tersedia mencakup ruang laboratorium, ruang kelas yang representatif, ruang staf dan
                dosen,
                serta berbagai ruangan dan sarana pendukung lainnya guna menciptakan lingkungan belajar yang
                kondusif dan
                berstandar tinggi.</p>
        </div>
    </div>

    <!-- Content Section 2: Visi dan Misi (DYNAMIC) -->
    <div class="content-section" id="visi-misi" style="display: none;">
        <div class="image-gallery">
            <!-- Header Image for Visi Misi -->
            <?php
                $vmHeaderImage = $metaprofiles->firstWhere('metakey', 'vm_header_image');
            ?>
            <div class="image-overlay">
                <?php if($vmHeaderImage && $vmHeaderImage->image && Storage::disk('public')->exists($vmHeaderImage->image)): ?>
                    <img src="<?php echo e(asset('storage/' . $vmHeaderImage->image)); ?>"
                        alt="<?php echo e($vmHeaderImage->title ?? 'Visi Misi Header'); ?>">
                <?php else: ?>
                    <img src="<?php echo e(asset('aset/img/mp5.png')); ?>" alt="Visi Misi Default Header">
                <?php endif; ?>
            </div>

            <!-- Dynamic Vision and Mission Items -->
            <?php
                $visiMisiItems = $metaprofiles
                    ->filter(function ($item) {
                        return Str::startsWith($item->metakey, 'vm_') &&
                            $item->metakey !== 'vm_header_image' &&
                            $item->is_active;
                    })
                    ->sortBy('created_at');
            ?>

            <?php if($visiMisiItems->isNotEmpty()): ?>
                <?php $__currentLoopData = $visiMisiItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="vision-mission-container">
                        <!-- Left Column: Title -->
                        <div class="vision-content">
                            <div class="vision-title"><?php echo e($item->title); ?></div>
                        </div>

                        <!-- Vertical Divider -->
                        <div class="divider-line"></div>

                        <!-- Right Column: Description -->
                        <div class="vision-content">
                            <p><?php echo $item->description; ?></p>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <div class="vision-mission-container" style="justify-content: center;">
                    <p>Data Visi dan Misi belum tersedia.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Content Section 3: Prospek Kerja (UPDATED LAYOUT) -->
    <div class="content-section" id="prospek-kerja" style="display: none;">
        <div class="image-gallery">
            <div class="image-overlay">
                <img src="<?php echo e(asset('aset/img/mp6.png')); ?>" alt="Prospek Kerja">
            </div>

            <!-- Grid Layout for Career Prospects -->
            <div class="prospek-grid-container">
                <!-- Row 1 -->
                <div class="prospek-row">
                    <div class="prospek-card">
                        <div class="prospek-category">PEREKAYASAAN MATERIAL DAN PROSES (Material and Process Engineer)</div>

                        <div class="job-roles">
                            <div class="job-role">
                                <span class="role-title">Material Scientist</span>
                                <span class="role-title">Metallurgical Engineer</span>
                                <span class="role-title">Process Engineer</span>
                            </div>
                        </div>

                        <ul class="job-duties">
                            <li>Mengidentifikasi dan merancang ulang sifat material untuk pengembangan produk baru atau
                                perbaikan performa material yang ada.</li>
                            <li>Monitoring dan mengoptimalkan proses metalurgi, seperti peleburan, perlakuan panas, dan
                                pengendalian struktur mikro untuk produk berkualitas.</li>
                        </ul>
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="prospek-row">
                    <div class="prospek-card">
                        <div class="prospek-category">PEREKAYASAAN KUALITAS MATERIAL (Material Quality Engineer)</div>

                        <div class="job-roles">
                            <div class="job-role">
                                <span class="role-title">Quality Assurance Engineer</span>
                                <span class="role-title">Failure Analyst</span>
                                <span class="role-title">Testing Specialist</span>
                            </div>
                        </div>

                        <ul class="job-duties">
                            <li>Melakukan pengujian dan analisis, baik, dan ketika situasi untuk memastikan kualitas sesuai
                                spesifikasi.</li>
                            <li>Menganalisis kegagalan material (failure analysis) dan memberikan rekomendasi perbaikan
                                untuk mencegah kekurutan di masa depan.</li>
                        </ul>
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="prospek-row">
                    <div class="prospek-card">
                        <div class="prospek-category">SUPERVISOR PRODUKSI METALURGI (Metallurgical Production Supervisor)
                        </div>
                        <div class="job-roles">
                            <div class="job-role">
                                <span class="role-title">Production Supervisor</span>
                                <span class="role-title">Process Coordinator</span>
                                <span class="role-title">Plant Supervisor</span>
                            </div>
                        </div>

                        <ul class="job-duties">
                            <li>Mengawasi proses produksi metalurgi, termasuk peleburan, pengecoran, atau pengerjaan logam.
                            </li>
                            <li>Memastikan kepatuhan produksi sesuai dengan standar keselamatan kerja dan regulasi
                                lingkungan operasional.</li>
                        </ul>
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="prospek-row">
                    <div class="prospek-card">
                        <div class="prospek-category">PEREKAYASAAN PENGEMBANGAN PRODUK METALURGI (Metallurgical Product
                            Development Engineer)</div>

                        <div class="job-roles">
                            <div class="job-role">
                                <span class="role-title">R&D Engineer</span>
                                <span class="role-title">Product Developer</span>
                                <span class="role-title">Innovation Specialist</span>
                            </div>
                        </div>

                        <ul class="job-duties">
                            <li>Mengembangkan inovasi produk berbasis logam atau paduan baru untuk aplikasi di berbagai
                                industri.</li>
                            <li>Melakukan penelitian teknologi material dan baru yang dapat meningkatkan performa produk
                                secara signifikan.</li>
                        </ul>
                    </div>
                </div>

                <!-- Row 5 -->
                <div class="prospek-row">
                    <div class="prospek-card">
                        <div class="prospek-category">PEREKAYASAAN PROSES METALURGI (Metallurgical Process Engineer)</div>

                        <div class="job-roles">
                            <div class="job-role">
                                <span class="role-title">Process Engineer</span>
                                <span class="role-title">Pyrometallurgy Engineer</span>
                                <span class="role-title">Hydrometallurgy Engineer</span>
                            </div>
                        </div>

                        <ul class="job-duties">
                            <li>Merancang dan mengoptimalkan proses ekstraksi logam dan bijih menggunakan metode
                                pirometalurgi, hidrometalurgi, atau elektrometalurgi.</li>
                            <li>Menganalisis efisiensi proses ekstraksi dan melakukan inovasi untuk meningkatkan hasil dan
                                sistem energi.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\MetalurgiITDEL\resources\views/metaprofile.blade.php ENDPATH**/ ?>
@extends('layouts.main')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    {{-- ... (style Anda tidak berubah signifikan, saya akan singkat untuk fokus ke logika) ... --}}
    <style>
        .section-title {
            font-size: 2rem;
            font-weight: 600;
            text-align: center;
            margin-top: 5px;
            /* dikurangi dari 20px menjadi 10px */
            color: #000000;
        }


        .lecturer-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .lecturer-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .profile-section {
            display: flex;
            min-height: 400px;
        }

        .profile-image {
            width: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .profile-image img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .profile-content {
            flex: 1;
            padding: 0;
        }

        .profile-tabs {
            display: flex;
            background: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
        }

        .tab-button {
            flex: 1;
            padding: 20px 15px;
            background: transparent;
            border: none;
            font-weight: 600;
            font-size: 14px;
            color: #6c757d;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .tab-button:hover {
            background: #e9ecef;
            color: #495057;
        }

        .tab-button.active {
            background: #007bff;
            color: white;
            border-bottom: 3px solid #0056b3;
        }

        .tab-content {
            padding: 30px;
            min-height: 300px;
        }

        .tab-pane {
            display: none;
        }

        .tab-pane.active {
            display: block;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .info-item i {
            width: 25px;
            color: #007bff;
            margin-right: 15px;
        }

        .lecturer-name {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .content-area {
            line-height: 1.8;
            color: #495057;
        }

        .content-area h1,
        .content-area h2,
        .content-area h3,
        .content-area h4,
        .content-area h5,
        .content-area h6 {
            color: #2c3e50;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .content-area ul,
        .content-area ol {
            padding-left: 20px;
        }

        .content-area p {
            margin-bottom: 15px;
        }

        .no-content {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            padding: 40px;
        }

        .role-badge {
            display: inline-block;
            background: linear-gradient(45deg, #007bff, #0056b3);
            color: white;
            padding: 8px 20px;
            border-radius: 25px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }

        .lecturer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            padding: 0 20px;
        }

        .list-view .lecturer-card {
            max-width: 1200px;
            margin: 0 auto 40px auto;
        }

        @media (max-width: 768px) {
            .profile-section {
                flex-direction: column;
                min-height: auto;
            }

            .profile-image {
                width: 100%;
                padding: 20px;
            }

            .profile-image img {
                width: 150px;
                height: 150px;
            }

            .profile-tabs {
                flex-wrap: wrap;
            }

            .tab-button {
                flex-basis: 50%;
                padding: 15px 10px;
                font-size: 12px;
            }

            .lecturer-grid {
                grid-template-columns: 1fr;
                padding: 0 10px;
            }

            .header-section h1 {
                font-size: 2rem;
            }

            .section-title {
                font-size: 1.5rem;
                margin: 40px 0 30px 0;
            }
        }
    </style>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumbs">
            <li class="breadcrumb-item">
                <a href="{{ url('/metaprofile') }}" class="text-decoration-none">Profil</a>
            </li>
            <li class="breadcrumb-item current-page"><b>Dosen/Staff</b></li>
        </ol>
    </nav>
    <div class="container-fluid">
        {{-- Tampilan Daftar Dosen dan Staf --}}
        <h3 class="text-center mb-5 fw-bold">DOSEN & STAFF</h3>


        <div class="container py-5">
            @foreach (['dosen', 'staf'] as $role)
                @if (isset($lecturers[$role]) && $lecturers[$role]->count())
                    <div class="section-title">{{ strtoupper($role) }}</div>

                    <div class="list-view">
                        @foreach ($lecturers[$role] as $lecturer)
                            <div class="lecturer-card">
                                <div class="profile-section">
                                    <div class="profile-image">
                                        @if ($lecturer->image)
                                            <img src="{{ asset('storage/' . $lecturer->image) }}"
                                                alt="{{ $lecturer->name }}">
                                        @else
                                            <div
                                                style="width: 200px; height: 200px; border-radius: 50%; background: #e9ecef; display: flex; align-items: center; justify-content: center; color: #6c757d; font-size: 48px;">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="profile-content">
                                        <div class="profile-tabs">
                                            <button class="tab-button active"
                                                onclick="openTab(event, 'profile-tab-{{ $lecturer->id }}', {{ $lecturer->id }})">
                                                <i class="fas fa-user"></i>
                                                <span>PROFIL {{ strtoupper($lecturer->role) }}</span>
                                            </button>
                                            <button class="tab-button"
                                                onclick="openTab(event, 'education-tab-{{ $lecturer->id }}', {{ $lecturer->id }})">
                                                <i class="fas fa-graduation-cap"></i>
                                                <span>PENDIDIKAN</span>
                                            </button>
                                            <button class="tab-button"
                                                onclick="openTab(event, 'research-tab-{{ $lecturer->id }}', {{ $lecturer->id }})">
                                                <i class="fas fa-flask"></i>
                                                <span>RISET</span>
                                            </button>
                                            <!-- Removed the dosen-only condition for the Mata Kuliah tab -->
                                            <button class="tab-button"
                                                onclick="openTab(event, 'courses-tab-{{ $lecturer->id }}', {{ $lecturer->id }})">
                                                <i class="fas fa-book"></i>
                                                <span>MATA KULIAH</span>
                                            </button>
                                        </div>

                                        <div class="tab-content">
                                            {{-- Tab Profil --}}
                                            <div id="profile-tab-{{ $lecturer->id }}" class="tab-pane active">
                                                <div class="role-badge">{{ strtoupper($lecturer->role) }}</div>
                                                <div class="lecturer-name">{{ $lecturer->name }}</div>

                                                <div class="info-item">
                                                    <i class="fas fa-id-card"></i>
                                                    <span><strong>NIDN:</strong> {{ $lecturer->employee_id }}</span>
                                                </div>

                                                <div class="info-item">
                                                    <i class="fas fa-envelope"></i>
                                                    <span>
                                                        <a href="mailto:{{ $lecturer->email }}"
                                                            style="color: #000000; text-decoration: none;">
                                                            {{ $lecturer->email }}
                                                        </a>
                                                    </span>
                                                </div>

                                                @if ($lecturer->linkedIn_url)
                                                    <div class="info-item">
                                                        <i class="fab fa-linkedin"></i>
                                                        <span>
                                                            <a href="{{ $lecturer->linkedIn_url }}" target="_blank"
                                                                style="color: #000000; text-decoration: none;">
                                                                {{ $lecturer->linkedIn_username }}
                                                            </a>
                                                        </span>
                                                    </div>
                                                @endif

                                                <div class="info-item">
                                                    <i class="fas fa-building"></i>
                                                    <span> {{ $lecturer->room }}</span>
                                                </div>
                                            </div>

                                            {{-- Tab Pendidikan --}}
                                            <div id="education-tab-{{ $lecturer->id }}" class="tab-pane">
                                                @if ($lecturer->education)
                                                    <div class="content-area">
                                                        {!! $lecturer->education !!}
                                                    </div>
                                                @else
                                                    <div class="no-content">
                                                        <i class="fas fa-graduation-cap"
                                                            style="font-size: 48px; margin-bottom: 20px; color: #dee2e6;"></i>
                                                        <p>Informasi pendidikan belum tersedia.</p>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Tab Penelitian --}}
                                            <div id="research-tab-{{ $lecturer->id }}" class="tab-pane">
                                                @if ($lecturer->research)
                                                    <div class="content-area">
                                                        {!! $lecturer->research !!}
                                                    </div>
                                                @else
                                                    <div class="no-content">
                                                        <i class="fas fa-flask"
                                                            style="font-size: 48px; margin-bottom: 20px; color: #dee2e6;"></i>
                                                        <p>Informasi penelitian belum tersedia.</p>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Tab Mata Kuliah (Now for both Dosen and Staf) --}}
                                            <div id="courses-tab-{{ $lecturer->id }}" class="tab-pane">
                                                @if ($lecturer->courses)
                                                    <div class="content-area">
                                                        {!! $lecturer->courses !!}
                                                    </div>
                                                @else
                                                    <div class="no-content">
                                                        <i class="fas fa-book"
                                                            style="font-size: 48px; margin-bottom: 20px; color: #dee2e6;"></i>
                                                        <p>Informasi mata kuliah belum tersedia.</p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach
            @if (
                (!isset($lecturers['dosen']) || $lecturers['dosen']->count() == 0) &&
                    (!isset($lecturers['staf']) || $lecturers['staf']->count() == 0))
                <div class="text-center py-5">
                    <i class="fas fa-users" style="font-size: 72px; color: #dee2e6; margin-bottom: 20px;"></i>
                    <h3 class="text-muted">Belum ada data dosen atau staf</h3>
                    <p class="text-muted">Data akan ditampilkan setelah admin menambahkan informasi.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        function openTab(evt, tabName, lecturerId) {
            var i, tabcontent, tablinks;

            // Get all elements with class="tab-pane" inside the specific lecturer's card and hide them
            var parentCard = document.getElementById(tabName).closest('.lecturer-card');
            tabcontent = parentCard.querySelectorAll('.tab-pane');
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
                tabcontent[i].classList.remove('active');
            }

            // Get all elements with class="tab-button" inside the specific lecturer's card and remove the class "active"
            tablinks = parentCard.querySelectorAll('.tab-button');
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove('active');
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).style.display = "block";
            document.getElementById(tabName).classList.add('active');
            evt.currentTarget.classList.add('active');
        }

        // Initialize default active tabs for each card
        document.addEventListener('DOMContentLoaded', function() {
            var lecturerCards = document.querySelectorAll('.lecturer-card');
            lecturerCards.forEach(function(card) {
                var firstTabButton = card.querySelector('.tab-button');
                if (firstTabButton) {
                    firstTabButton.click(); // Simulate a click to open the first tab
                }
            });
        });
    </script>
@endsection

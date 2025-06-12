<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AdminTM | Dashboard')</title>

    <!-- Preload Critical Resources -->
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" as="style">
    <link rel="preload" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}" as="style">
    <link rel="preload" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}" as="style">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700">
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet">

    <!-- Toast CSS -->
    <style>
        .toast-container {
            z-index: 1050;
        }

        .toast {
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .toast-header {
            background-color: var(--primary);
            color: white;
        }

        .toast-body {
            background-color: var(--light);
            color: var(--dark);
        }

        .toast-body a.btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .toast-body a.btn-primary:hover {
            background-color: var(--primary-dark);
            border-color: var(--primary-dark);
        }
    </style>

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            @if (isset($subtitle))
                                <p class="text-muted mt-1">@yield('subtitle')</p>
                            @endif
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                @yield('breadcrumbs')
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        <!-- Footer -->
        @include('layouts.footer')

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <div class="p-3">
                <h5>Quick Settings</h5>
                <p>Admin panel settings</p>
            </div>
        </aside>

        <!-- Toast Notification -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="adminNotificationToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Notifikasi Baru</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    <p>Baru saja menerima <span id="notificationType"></span> dari: <span id="notificationEmail"></span>
                    </p>
                    <a href="{{ route('admin.inquiries.index') }}" class="btn btn-primary btn-sm">Lihat</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Core Scripts -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- CSRF Token Setup -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <!-- Summernote Initialization -->
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                placeholder: 'Masukkan deskripsi di sini...',
                fontNames: ['Inter', 'Arial', 'Courier New', 'Times New Roman', 'Sans Serif'],
                fontNamesIgnoreCheck: ['Inter'],
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>

    <!-- Pusher and Notification Script -->
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.Echo.private('admin.inquiries')
                .listen('App\\Events\\NewInquiryNotification', (e) => {
                    const toast = new bootstrap.Toast(document.getElementById('adminNotificationToast'));
                    document.getElementById('notificationType').textContent = e.inquiry?.type === 'question' ?
                        'pertanyaan' : 'review';
                    document.getElementById('notificationEmail').textContent = e.inquiry?.email || e.email;
                    toast.show();
                });
        });
    </script>

    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Image Upload and Preview -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Choices
            const academicDays = new Choices('#academic_days', {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'Pilih hari',
                searchEnabled: false,
                itemSelectText: '',
            });

            // Image Preview Functionality
            const imageInput = document.getElementById('images');
            const previewContainer = document.getElementById('image-preview-container');
            const maxImages = 5;

            if (imageInput && previewContainer) {
                imageInput.addEventListener('change', function() {
                    previewContainer.innerHTML = '';
                    const existingImagesCount = document.querySelectorAll('input[name="existing_images[]"]')
                        .length;
                    const remainingSlots = maxImages - existingImagesCount;

                    if (this.files.length > remainingSlots) {
                        alert(
                            `Anda dapat mengunggah maksimal ${maxImages} gambar (${remainingSlots} slot tersisa).`
                        );
                        this.value = '';
                        return;
                    }

                    Array.from(this.files).slice(0, remainingSlots).forEach(file => {
                        if (!file.type.match('image.*')) return;

                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const previewItem = document.createElement('div');
                            previewItem.className = 'image-preview-item mb-2';
                            previewItem.innerHTML = `
                                <div class="position-relative d-inline-block">
                                    <img src="${e.target.result}" class="img-thumbnail" width="120">
                                    <button type="button" class="btn btn-danger btn-xs remove-preview-btn position-absolute top-0 end-0">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            `;
                            previewContainer.appendChild(previewItem);

                            previewItem.querySelector('.remove-preview-btn').addEventListener(
                                'click',
                                function() {
                                    previewItem.remove();
                                });
                        };
                        reader.readAsDataURL(file);
                    });
                });
            }

            // Existing Image Removal
            document.querySelectorAll('.remove-image-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const imagePath = this.dataset.image;
                    const item = this.closest('.image-preview-item');

                    if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                        item.remove();

                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'removed_images[]';
                        input.value = imagePath;
                        document.querySelector('form').appendChild(input);
                    }
                });
            });
        });
    </script>

    <!-- Sidebar Toggle -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.querySelector("[data-widget='pushmenu']");
            const sidebar = document.querySelector(".main-sidebar");

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener("click", function() {
                    sidebar.classList.toggle("open");
                    localStorage.setItem('sidebarState', sidebar.classList.contains("open") ? 'open' :
                        'closed');
                });

                if (localStorage.getItem('sidebarState') === 'open') {
                    sidebar.classList.add("open");
                }
            }
        });
    </script>

    @stack('scripts')
</body>

</html>

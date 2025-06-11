import Pusher from 'pusher-js';
window.Pusher = Pusher;

// Kode ini akan menginisialisasi Laravel Echo, yang lebih terstruktur
// Pastikan Anda sudah menjalankan: npm install --save-dev laravel-echo pusher-js
import Echo from 'laravel-echo';

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

// Anda bisa langsung menggunakan Echo sekarang
document.addEventListener('DOMContentLoaded', () => {
    const channel = window.Echo.private('admin.inquiries'); // Gunakan private channel untuk keamanan

    channel.listen('NewInquiryNotification', (e) => {
        console.log('New inquiry received:', e.inquiry);

        const toastContainer = document.querySelector('.toast-container'); // Pastikan elemen ini ada di layout admin Anda
        if (!toastContainer) {
            console.error('Toast container not found!');
            return;
        }

        const inquiry = e.inquiry;
        const userTypeText = inquiry.user_type === 'internal' ? 'Internal (Dosen/Staff/Mhs)' : 'Masyarakat Umum';
        const toastId = `toast-${Date.now()}`;

        const toastHTML = `
            <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <i class="fas fa-bell me-2"></i>
                    <strong class="me-auto">Notifikasi Baru</strong>
                    <small>Baru saja</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${inquiry.type === 'question' ? 'Pertanyaan baru' : 'Ulasan baru'} dari <strong>${inquiry.email}</strong>.
                    <p class="mt-2 mb-0 fst-italic">"${inquiry.content.substring(0, 70)}..."</p>
                    <a href="/admin/inquiries/${inquiry.id}" class="btn btn-sm btn-primary mt-2 w-100">Lihat Detail</a>
                </div>
            </div>
        `;

        toastContainer.insertAdjacentHTML('beforeend', toastHTML);

        // Inisialisasi dan tampilkan toast
        const toastElement = document.getElementById(toastId);
        const bsToast = new bootstrap.Toast(toastElement);
        bsToast.show();

        // Hapus elemen toast dari DOM setelah ditutup
        toastElement.addEventListener('hidden.bs.toast', () => {
            toastElement.remove();
        });
    });
});

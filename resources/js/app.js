import Alpine from 'alpinejs';
import { initMotionEngine } from './motion/animation-manager';
import Alert from './alert';

// Make Alert globally available
window.Alert = Alert;

// Global Form Interceptor for SweetAlert2
document.addEventListener('submit', function(e) {
    if (e.target.closest('form')) {
        const form = e.target;
        
        // Skip specific forms if needed
        if (form.hasAttribute('data-no-alert')) return;
        
        const methodInput = form.querySelector('input[name="_method"]');
        const isDelete = methodInput && methodInput.value.toUpperCase() === 'DELETE';
        const isLogout = form.action.includes('logout');

        if (isDelete) {
            e.preventDefault();
            Alert.confirm({
                title: 'Hapus Data?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal',
                isDanger: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Alert.loading('Menghapus data...');
                    HTMLFormElement.prototype.submit.call(form);
                }
            });
            return;
        }

        if (isLogout) {
            e.preventDefault();
            Alert.confirm({
                title: 'Keluar?',
                text: 'Anda akan keluar dari Admin Panel.',
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal',
                isDanger: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Alert.loading('Keluar...');
                    form.submit();
                }
            });
            return;
        }

        // Standard Loading for Save/Update/Upload
        if (form.target !== '_blank') {
            Alert.loading('Memproses...');
        }
    }
});

// Setup Alpine
window.Alpine = Alpine;
Alpine.start();

// Initialize GSAP Motion Engine once DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    initMotionEngine();
});

import Swal from 'sweetalert2';

/**
 * Global SweetAlert2 Helper for Admin Panel
 */
const defaultCustomClass = {
    popup: 'rounded-2xl shadow-ambient border border-gray-200 p-6',
    title: 'text-xl font-bold text-gray-900 mt-2',
    htmlContainer: 'text-sm text-gray-600 mt-2',
    actions: 'mt-6 w-full flex justify-center gap-3',
    confirmButton: 'inline-flex items-center justify-center px-5 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors shadow-sm',
    cancelButton: 'inline-flex items-center justify-center px-5 py-2.5 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors font-medium shadow-sm'
};

const tailwindSwal = Swal.mixin({
    buttonsStyling: false,
    heightAuto: false,
    scrollbarPadding: false,
    customClass: defaultCustomClass
});

const Alert = {
    // Primary/Success Configuration
    success(message) {
        return tailwindSwal.fire({
            title: 'Berhasil!',
            html: message || '✅ Data berhasil disimpan.',
            icon: 'success',
            confirmButtonText: 'Tutup'
        });
    },

    // Error Configuration
    error(message) {
        return tailwindSwal.fire({
            title: 'Gagal!',
            html: message || '❌ Gagal memproses permintaan.',
            icon: 'error',
            confirmButtonText: 'Tutup',
            customClass: {
                ...defaultCustomClass,
                confirmButton: 'inline-flex items-center justify-center px-5 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors shadow-sm'
            }
        });
    },

    // Warning Configuration
    warning(message) {
        return tailwindSwal.fire({
            title: 'Perhatian!',
            html: message,
            icon: 'warning',
            confirmButtonText: 'Mengerti',
            customClass: {
                ...defaultCustomClass,
                confirmButton: 'inline-flex items-center justify-center px-5 py-2.5 bg-amber-500 text-white font-medium rounded-lg hover:bg-amber-600 transition-colors shadow-sm'
            }
        });
    },

    // Info Configuration
    info(message) {
        return tailwindSwal.fire({
            title: 'Informasi',
            html: message,
            icon: 'info',
            confirmButtonText: 'OK'
        });
    },

    // Confirmation Configuration
    confirm({ title, text, confirmButtonText, cancelButtonText, isDanger = true }) {
        return tailwindSwal.fire({
            title: title || 'Apakah Anda Yakin?',
            html: text || '',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: confirmButtonText || 'Ya',
            cancelButtonText: cancelButtonText || 'Batal',
            reverseButtons: true,
            customClass: {
                ...defaultCustomClass,
                confirmButton: isDanger 
                    ? 'inline-flex items-center justify-center px-5 py-2.5 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors shadow-sm'
                    : 'inline-flex items-center justify-center px-5 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/90 transition-colors shadow-sm'
            }
        });
    },

    // Loading State
    loading(message = 'Memproses data...') {
        return tailwindSwal.fire({
            title: message,
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            customClass: {
                ...defaultCustomClass,
                title: 'text-lg font-bold text-gray-900 mt-4',
            },
            didOpen: () => {
                Swal.showLoading();
            }
        });
    },

    // Close open alerts (like loading)
    close() {
        Swal.close();
    }
};

export default Alert;

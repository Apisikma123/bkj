@props([
    'id', 
    'name', 
    'label' => 'Upload Image', 
    'description' => 'Pilih gambar untuk dipotong.', 
    'aspectRatio' => 'NaN',
    'required' => false,
    'currentImageUrl' => null,
])

<div x-data="imageCropper('{{ $aspectRatio }}', '{{ $id }}')" class="space-y-1">
    @if($label)
        <x-input-label for="{{ $id }}" value="{{ $label }}" />
    @endif
    
    <!-- Real File Input -->
    <input type="file" 
           name="{{ $name }}" 
           id="{{ $id }}" 
           accept="image/*" 
           x-ref="fileInput"
           @change="fileSelected($event)"
           {{ $required ? 'required' : '' }}
           class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20 border border-outline-variant/40 rounded-lg bg-white mt-1 cursor-pointer">
           
    @if($description)
        <p class="text-sm text-gray-500 mt-1">{!! $description !!}</p>
    @endif
    
    @error($name) <p class="text-error text-xs mt-1">{{ $message }}</p> @enderror

    <!-- Current Image Preview -->
    @if($currentImageUrl)
        <div class="mt-3" x-show="!hasCroppedImage">
            <p class="text-xs text-gray-500 mb-1">Gambar saat ini:</p>
            <img src="{{ $currentImageUrl }}" alt="Current Image" class="w-32 h-32 object-cover rounded-lg border border-gray-200">
        </div>
    @endif

    <!-- Cropped Image Preview -->
    <div class="mt-3" x-show="hasCroppedImage" style="display: none;">
        <p class="text-xs text-secondary font-medium mb-1">Hasil potongan gambar (akan diunggah):</p>
        <img x-ref="croppedPreview" src="" alt="Cropped Preview" class="w-48 h-auto object-cover rounded-lg border-2 border-secondary/50 shadow-sm">
    </div>

    <!-- Cropper Modal -->
        <div x-show="showModal" 
             style="display: none;"
             class="fixed inset-0 z-[100] overflow-y-auto bg-black/80 backdrop-blur-sm p-4 md:p-10 flex justify-center items-start"
             x-transition.opacity>
             
            <div class="bg-surface rounded-2xl shadow-2xl w-full max-w-2xl my-8 bg-white" @click.away="cancelCrop">
                <!-- Header -->
                <div class="px-6 py-4 border-b border-outline-variant/30 flex justify-between items-center bg-white">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Sesuaikan Gambar (Crop)</h3>
                        <p class="text-sm text-gray-500 mt-1">Geser kotak pemotong untuk menyesuaikan rasio dan fokus gambar.</p>
                    </div>
                    <button type="button" @click="cancelCrop" class="text-gray-500 hover:text-error transition-colors p-2 rounded-lg hover:bg-error/10">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                
                <!-- Cropper Container -->
                <div class="bg-gray-900 relative p-4">
                    <div class="flex items-center justify-center">
                        <img x-ref="cropperImage" src="" class="block w-full" alt="Image to crop">
                    </div>
                </div>
                
                <!-- Footer -->
                <div class="px-6 py-4 border-t border-outline-variant/30 bg-white flex justify-end gap-3">
                    <button type="button" @click="cancelCrop" class="px-5 py-2.5 bg-gray-100 text-gray-700 font-medium rounded-xl hover:bg-gray-200 transition-colors">
                        Batal
                    </button>
                    <button type="button" @click="applyCrop" class="px-6 py-2.5 bg-primary text-white font-medium rounded-xl hover:bg-primary/90 transition-colors shadow-md flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Potong & Simpan
                    </button>
                </div>
            </div>
        </div>
</div>

@once
@push('scripts')
<style>
    /* Prevent cropper drag box from being transparent to clicks in Alpine */
    .cropper-view-box,
    .cropper-face {
        border-radius: 4px;
    }
</style>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('imageCropper', (aspectRatioStr, inputId) => {
            let parsedRatio = NaN;
            if (aspectRatioStr && aspectRatioStr !== 'NaN') {
                if (String(aspectRatioStr).includes('/')) {
                    const parts = String(aspectRatioStr).split('/');
                    parsedRatio = parseFloat(parts[0]) / parseFloat(parts[1]);
                } else {
                    parsedRatio = parseFloat(aspectRatioStr);
                }
            }
            return {
                showModal: false,
                cropper: null,
                hasCroppedImage: false,
                aspectRatio: parsedRatio,
                originalFile: null,
            
            fileSelected(event) {
                console.log('fileSelected triggered', event);
                const files = event.target.files;
                if (!files || files.length === 0) return;
                
                // If it's not an image, just let it pass natively
                const file = files[0];
                console.log('Selected file:', file);
                if (!file.type.startsWith('image/')) return;
                
                this.originalFile = file;
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = this.$refs.cropperImage;
                    img.onload = () => {
                        this.initCropper();
                        img.onload = null;
                    };
                    img.src = e.target.result;
                    this.showModal = true;
                    // Disable scrolling on body
                    document.body.style.overflow = 'hidden';
                };
                reader.readAsDataURL(file);
            },
            
            initCropper() {
                if (this.cropper) {
                    this.cropper.destroy();
                }
                
                this.cropper = new Cropper(this.$refs.cropperImage, {
                    aspectRatio: this.aspectRatio,
                    viewMode: 2, // Restrict the crop box not to exceed the size of the canvas.
                    autoCropArea: 1,
                    responsive: true,
                    background: false,
                    zoomable: true,
                });
            },
            
            cancelCrop() {
                this.showModal = false;
                document.body.style.overflow = ''; // Restore scrolling
                
                if (this.cropper) {
                    this.cropper.destroy();
                    this.cropper = null;
                }
                // If they hadn't cropped anything before, clear the input
                if (!this.hasCroppedImage) {
                    this.$refs.fileInput.value = '';
                }
            },
            
            applyCrop() {
                if (!this.cropper) return;
                
                this.cropper.getCroppedCanvas({
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                    fillColor: '#fff', // for transparent PNGs converted to JPEG
                }).toBlob((blob) => {
                    if (!blob) return;
                    
                    // Create a new File object
                    const fileName = this.originalFile.name;
                    const croppedFile = new File([blob], fileName, { type: blob.type, lastModified: new Date().getTime() });
                    
                    // Update the file input using DataTransfer
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(croppedFile);
                    this.$refs.fileInput.files = dataTransfer.files;
                    
                    // Create preview URL
                    const previewUrl = URL.createObjectURL(blob);
                    this.$refs.croppedPreview.src = previewUrl;
                    this.hasCroppedImage = true;
                    
                    // Close modal and cleanup
                    this.showModal = false;
                    document.body.style.overflow = '';
                    
                    this.cropper.destroy();
                    this.cropper = null;
                }, this.originalFile.type);
            }
        };
        });
    });
</script>
@endpush
@endonce

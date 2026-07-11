<section class="space-y-6">
    <header>
        <h2 class="text-headline-md text-primary">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-body-md text-on-surface-variant">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi apa pun yang ingin Anda simpan.') }}
        </p>
    </header>

    <button
        class="inline-flex items-center justify-center font-semibold rounded-DEFAULT transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 bg-error text-white hover:bg-error-container hover:text-on-error-container px-6 py-3 text-body-md"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Hapus Akun') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-8">
            @csrf
            @method('delete')

            <h2 class="text-headline-md text-primary">
                {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
            </h2>

            <p class="mt-1 text-body-md text-on-surface-variant">
                {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi penghapusan akun secara permanen.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Kata Sandi') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 bg-surface border-outline-variant focus:border-error focus:ring-error/20"
                    placeholder="{{ __('Kata Sandi') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-error" />
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <x-ui.button variant="secondary" size="md" type="button" x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-ui.button>

                <button type="submit" class="inline-flex items-center justify-center font-semibold rounded-DEFAULT transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 bg-error text-white hover:bg-error-container hover:text-on-error-container px-6 py-3 text-body-md">
                    {{ __('Hapus Akun') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>

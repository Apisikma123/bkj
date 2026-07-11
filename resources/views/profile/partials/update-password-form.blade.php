<section>
    <header>
        <h2 class="text-headline-md text-primary">
            {{ __('Ubah Kata Sandi') }}
        </h2>

        <p class="mt-1 text-body-md text-on-surface-variant">
            {{ __('Pastikan akun Anda menggunakan kata sandi acak yang panjang agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Kata Sandi Saat Ini')" class="text-on-surface" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full bg-surface border-outline-variant focus:border-secondary focus:ring-secondary/20" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-error" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Kata Sandi Baru')" class="text-on-surface" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full bg-surface border-outline-variant focus:border-secondary focus:ring-secondary/20" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-error" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Konfirmasi Kata Sandi')" class="text-on-surface" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full bg-surface border-outline-variant focus:border-secondary focus:ring-secondary/20" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-error" />
        </div>

        <div class="flex items-center gap-4">
            <x-ui.button variant="primary" size="md" type="submit">{{ __('Simpan') }}</x-ui.button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-on-surface-variant font-medium"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>

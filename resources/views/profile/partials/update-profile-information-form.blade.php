<section>
    <header>
        <h2 class="text-headline-md text-primary">
            {{ __('Informasi Profil') }}
        </h2>

        <p class="mt-1 text-body-md text-on-surface-variant">
            {{ __("Perbarui informasi profil dan alamat email akun Anda.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nama')" class="text-on-surface" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-surface border-outline-variant focus:border-secondary focus:ring-secondary/20" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-error" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-on-surface" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full bg-surface border-outline-variant focus:border-secondary focus:ring-secondary/20" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 text-error" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-body-md mt-2 text-on-surface">
                        {{ __('Alamat email Anda belum diverifikasi.') }}

                        <button form="send-verification" class="underline text-sm text-on-surface-variant hover:text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            {{ __('Klik di sini untuk mengirim ulang email verifikasi.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-secondary">
                            {{ __('Tautan verifikasi baru telah dikirim ke alamat email Anda.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <x-ui.button variant="primary" size="md" type="submit">{{ __('Simpan') }}</x-ui.button>

            @if (session('status') === 'profile-updated')
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

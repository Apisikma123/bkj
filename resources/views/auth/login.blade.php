<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h2 class="text-headline-md font-display font-bold text-primary mb-2">Welcome Back</h2>
        <p class="text-body-md text-on-surface-variant">Sign in to manage your operations</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1">
                <x-input-label for="password" :value="__('Password')" class="mb-0" />
                @if (Route::has('password.request'))
                    <a class="text-label-md text-primary hover:text-secondary transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary rounded" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-outline-variant/40 text-secondary shadow-sm focus:ring-secondary group-hover:border-secondary transition-colors" name="remember">
                <span class="ms-2 text-body-md text-on-surface-variant group-hover:text-primary transition-colors">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-8">
            <x-ui.button variant="primary" class="w-full" type="submit">
                {{ __('Log in') }}
            </x-ui.button>
        </div>
    </form>
</x-guest-layout>

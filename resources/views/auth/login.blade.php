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
        <div x-data="{ showPassword: false }">
            <div class="flex justify-between items-center mb-1">
                <x-input-label for="password" :value="__('Password')" class="mb-0" />
                @if (Route::has('password.request'))
                    <a class="text-label-md text-primary hover:text-secondary transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary rounded" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <div class="relative">
                <x-text-input id="password" class="block w-full pr-12"
                                ::type="showPassword ? 'text' : 'password'"
                                name="password"
                                required autocomplete="current-password" />
                
                <button type="button" 
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors focus:outline-none cursor-pointer"
                        @click="showPassword = !showPassword">
                    <x-lucide-eye class="w-5 h-5" x-show="!showPassword" />
                    <x-lucide-eye-off class="w-5 h-5" x-show="showPassword" style="display: none;" />
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                <input id="remember_me" type="checkbox" class="rounded border-outline-variant/40 text-secondary shadow-sm focus:ring-secondary group-hover:border-secondary transition-colors" name="remember">
                <span class="ms-2 text-body-md text-on-surface-variant group-hover:text-primary transition-colors">{{ __('Remember me') }}</span>
            </label>
        </div>

        @if(!app()->environment('testing') && !empty(env('TURNSTILE_SITE_KEY')))
            <div class="mt-4 flex justify-center">
                <div class="cf-turnstile" data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}" data-theme="light"></div>
            </div>
            @error('cf-turnstile-response')
                <x-input-error :messages="$message" class="mt-2 text-center" />
            @enderror
        @endif

        <div class="mt-8">
            <x-ui.button variant="primary" class="w-full" type="submit">
                {{ __('Log in') }}
            </x-ui.button>
        </div>
    </form>

    @if(!app()->environment('testing') && !empty(env('TURNSTILE_SITE_KEY')))
        <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
    @endif
</x-guest-layout>

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-8 text-center">
        <h2 class="text-headline-md font-display font-bold text-primary mb-2">Forgot Password?</h2>
        <p class="text-body-md text-on-surface-variant">Enter your email address and we'll send you a link to reset your password.</p>
    </div>

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-8 space-y-4">
            <x-ui.button variant="primary" class="w-full" type="submit">
                {{ __('Email Password Reset Link') }}
            </x-ui.button>
            
            <div class="text-center">
                <a href="{{ route('login') }}" class="text-label-md text-secondary hover:text-secondary-container transition-colors font-semibold">
                    Back to Sign In
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>

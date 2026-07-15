<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-headline-md font-display font-bold text-primary mb-2">Reset Password</h2>
        <p class="text-body-md text-on-surface-variant">Please choose a strong password to secure your account.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6" x-data="{ showPassword: false, showConfirmPassword: false }">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('New Password')" />
            <div class="relative mt-1">
                <x-text-input id="password" class="block w-full pr-12" ::type="showPassword ? 'text' : 'password'" name="password" required autocomplete="new-password" />
                <button type="button" 
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors focus:outline-none cursor-pointer"
                        @click="showPassword = !showPassword">
                    <x-lucide-eye class="w-5 h-5" x-show="!showPassword" />
                    <x-lucide-eye-off class="w-5 h-5" x-show="showPassword" style="display: none;" />
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm New Password')" />
            <div class="relative mt-1">
                <x-text-input id="password_confirmation" class="block w-full pr-12" ::type="showConfirmPassword ? 'text' : 'password'" name="password_confirmation" required autocomplete="new-password" />
                <button type="button" 
                        class="absolute right-4 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors focus:outline-none cursor-pointer"
                        @click="showConfirmPassword = !showConfirmPassword">
                    <x-lucide-eye class="w-5 h-5" x-show="!showConfirmPassword" />
                    <x-lucide-eye-off class="w-5 h-5" x-show="showConfirmPassword" style="display: none;" />
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-8">
            <x-ui.button variant="primary" class="w-full" type="submit">
                {{ __('Reset Password') }}
            </x-ui.button>
        </div>
    </form>
</x-guest-layout>

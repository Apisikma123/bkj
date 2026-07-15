<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-headline-md font-display font-bold text-primary mb-2">Confirm Password</h2>
        <p class="text-body-md text-on-surface-variant">This is a secure area of the portal. Please verify your password to continue.</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-8">
            <x-ui.button variant="primary" class="w-full" type="submit">
                {{ __('Confirm') }}
            </x-ui.button>
        </div>
    </form>
</x-guest-layout>

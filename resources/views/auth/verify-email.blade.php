<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-headline-md font-display font-bold text-primary mb-2">Verify Your Email</h2>
        <p class="text-body-md text-on-surface-variant">Thanks for signing up! Please verify your email address by clicking the link we just sent you.</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 text-sm font-semibold text-secondary bg-secondary-container/20 border border-secondary-container/30 px-4 py-3 rounded-DEFAULT text-center">
            {{ __('A new verification link has been sent to your email address.') }}
        </div>
    @endif

    <div class="mt-8 space-y-6">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-ui.button variant="primary" class="w-full" type="submit">
                {{ __('Resend Verification Email') }}
            </x-ui.button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="text-center">
            @csrf
            <button type="submit" class="text-label-md text-outline hover:text-primary transition-colors font-semibold underline cursor-pointer">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>

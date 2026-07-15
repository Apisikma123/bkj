<x-guest-layout>
    <!-- Session Status -->
    @if(session('status'))
        <div class="mb-4 text-sm font-semibold text-secondary bg-secondary-container/20 border border-secondary-container/30 px-4 py-3 rounded-DEFAULT">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-8 text-center">
        <h2 class="text-headline-md font-display font-bold text-primary mb-2">Security Verification</h2>
        <p class="text-body-md text-on-surface-variant">We have sent a 6-digit OTP code to your registered email address.</p>
    </div>

    <form method="POST" action="{{ route('otp.verify') }}" class="space-y-6">
        @csrf

        <!-- OTP Code -->
        <div>
            <x-input-label for="otp_code" :value="__('Enter OTP Code')" class="text-center block mb-2" />
            <div class="relative">
                <input id="otp_code" 
                       type="text" 
                       name="otp_code" 
                       maxlength="6" 
                       placeholder="••••••"
                       class="px-4 py-3.5 bg-surface-container-low border border-outline-variant/40 text-primary text-center font-display font-bold tracking-[0.5em] text-xl rounded-DEFAULT focus:ring-[3px] focus:ring-secondary/20 focus:border-secondary block w-full transition-all duration-200 shadow-sm outline-none" 
                       required 
                       autofocus 
                       autocomplete="one-time-code" />
            </div>
            <x-input-error :messages="$errors->get('otp_code')" class="mt-2 text-center" />
        </div>

        <div class="mt-8">
            <x-ui.button variant="primary" class="w-full" type="submit">
                {{ __('Verify Code') }}
            </x-ui.button>
        </div>
    </form>

    <div class="text-center mt-8 text-body-md">
        <form action="{{ route('otp.resend') }}" method="POST" id="resendForm">
            @csrf
            <span class="text-on-surface-variant">Didn't receive the code?</span> 
            <button type="submit" 
                    id="resendButton" 
                    class="text-secondary font-bold hover:underline disabled:opacity-50 disabled:cursor-not-allowed disabled:no-underline ml-1 cursor-pointer" 
                    {{ $cooldown > 0 ? 'disabled' : '' }}>
                Resend OTP <span id="countdownText" class="{{ $cooldown > 0 ? '' : 'hidden' }}">(<span id="timer">{{ $cooldown }}</span>s)</span>
            </button>
        </form>
    </div>

    @if($cooldown > 0)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let cooldown = {{ $cooldown }};
                const resendButton = document.getElementById('resendButton');
                const countdownText = document.getElementById('countdownText');
                const timerSpan = document.getElementById('timer');

                const interval = setInterval(() => {
                    cooldown--;
                    timerSpan.textContent = cooldown;
                    
                    if (cooldown <= 0) {
                        clearInterval(interval);
                        resendButton.disabled = false;
                        countdownText.classList.add('hidden');
                    }
                }, 1000);
            });
        </script>
    @endif
</x-guest-layout>

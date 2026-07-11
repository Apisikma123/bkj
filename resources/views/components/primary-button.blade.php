<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-2.5 bg-primary border border-transparent rounded-lg font-medium text-sm text-white tracking-wide hover:bg-primary-container hover:text-white focus:bg-primary-container active:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 transition-all duration-200 shadow-sm']) }}>
    {{ $slot }}
</button>

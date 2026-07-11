<x-admin-layout>
    <x-admin.page-header title="{{ __('Profil') }}" subtitle="Kelola pengaturan profil dan kata sandi Anda." />

    <div class="py-6">
        <div class="space-y-8">
            <x-ui.card>
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </x-ui.card>

            <x-ui.card>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </x-ui.card>
        </div>
    </div>
</x-admin-layout>

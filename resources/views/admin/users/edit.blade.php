<x-admin-layout>
    <x-admin.page-header title="Edit User" icon="edit" backRoute="{{ route('admin.users.index') }}" />
    <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 p-6 max-w-3xl">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <x-input-label for="name" value="Name" required />
                <x-text-input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required />
            </div>
            <div class="mb-6">
                <x-input-label for="email" value="Email" required />
                <x-text-input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required />
            </div>
            <div class="mb-6">
                <x-input-label for="password" value="Password (Leave blank to keep current)" />
                <x-text-input id="password" name="password" type="password" />
            </div>
            <div class="mb-6">
                <x-input-label for="password_confirmation" value="Confirm Password" />
                <x-text-input id="password_confirmation" name="password_confirmation" type="password" />
            </div>
            <div class="mb-6">
                <x-input-label for="role_id" value="Role" required />
                <x-select-input name="role_id" id="role_id" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ (old('role_id', $user->role_id) == $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </x-select-input>
            </div>
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-outline-variant/20">
                <a href="{{ route('admin.users.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors font-medium text-sm shadow-sm">Cancel</a>
                <x-primary-button>
                    <x-lucide-save class="w-4 h-4 mr-2" /> Update User
                </x-primary-button>
            </div>
        </form>
    </div>
</x-admin-layout>
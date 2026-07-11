<x-admin-layout>
    <x-admin.page-header title="Add Bank Account" icon="plus" backRoute="{{ route('admin.bank-accounts.index') }}" />
    <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 p-6 max-w-3xl">
        <form action="{{ route('admin.bank-accounts.store') }}" method="POST">
            @csrf
            <div class="mb-6">
                <x-input-label for="bank_name" value="Bank Name" required />
                <x-text-input id="bank_name" name="bank_name" type="text" value="{{ old('bank_name') }}" required autofocus />
            </div>
            <div class="mb-6">
                <x-input-label for="account_number" value="Account Number" required />
                <x-text-input id="account_number" name="account_number" type="text" value="{{ old('account_number') }}" required />
            </div>
            <div class="mb-6">
                <x-input-label for="account_name" value="Account Name" required />
                <x-text-input id="account_name" name="account_name" type="text" value="{{ old('account_name') }}" required />
            </div>
            <div class="mb-6">
                <x-input-label for="subsidiary_id" value="Subsidiary" required />
                <x-select-input name="subsidiary_id" id="subsidiary_id" required>
                    <option value="">-- Select Subsidiary --</option>
                    @foreach($subsidiaries as $sub)
                        <option value="{{ $sub->id }}" {{ old('subsidiary_id') == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                    @endforeach
                </x-select-input>
            </div>
            <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-outline-variant/20">
                <a href="{{ route('admin.bank-accounts.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors font-medium text-sm shadow-sm">Cancel</a>
                <x-primary-button>
                    <x-lucide-save class="w-4 h-4 mr-2" /> Save Account
                </x-primary-button>
            </div>
        </form>
    </div>
</x-admin-layout>
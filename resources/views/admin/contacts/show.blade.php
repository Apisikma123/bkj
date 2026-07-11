<x-admin-layout>
    <x-admin.page-header title="View Message" icon="mail" backRoute="{{ route('admin.contacts.index') }}" />
    <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 p-6 max-w-3xl">
        <div class="mb-6 pb-4 border-b border-outline-variant/20">
            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $contact->company ?? 'No Company specified' }}</h3>
            <div class="flex justify-between items-center text-sm text-gray-500">
                <p>From: <span class="font-medium text-gray-900">{{ $contact->name }}</span> ({{ $contact->email }})</p>
                <p class="text-xs">{{ $contact->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
        <div class="p-5 bg-surface-container-lowest border border-outline-variant/30 rounded-xl mb-6 whitespace-pre-wrap text-on-surface">
{{ $contact->message }}
        </div>
        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-outline-variant/20">
            <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-200 transition-colors font-medium text-sm shadow-sm">Back to Inbox</a>
        </div>
    </div>
</x-admin-layout>
<x-admin-layout>
    <x-admin.page-header title="View Message" icon="mail" backRoute="{{ route('admin.contacts.index') }}" />
    <div class="bg-white rounded-2xl shadow-sm border border-outline-variant/30 p-6 max-w-3xl">
        <div class="mb-6 pb-4 border-b border-outline-variant/20">
            <h3 class="text-xl font-bold text-on-surface mb-1">{{ $contact->company ?? 'No Company specified' }}</h3>
            @if($contact->business_unit)
                <div class="mb-2">
                    <span class="inline-block text-xs font-semibold bg-secondary/15 text-secondary px-2 py-0.5 rounded">Target Unit: {{ $contact->business_unit }}</span>
                </div>
            @endif
            <div class="flex justify-between items-center text-sm text-outline">
                <p>From: <span class="font-medium text-on-surface">{{ $contact->name }}</span> ({{ $contact->email }})</p>
                <p class="text-xs">{{ $contact->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
        <div class="p-5 bg-surface-container-lowest border border-outline-variant/30 rounded-xl mb-6 whitespace-pre-wrap text-on-surface">
{{ $contact->message }}
        </div>
        <div class="flex justify-end gap-3 mt-8 pt-6 border-t border-outline-variant/20">
            <a href="{{ route('admin.contacts.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-surface-container text-on-surface-variant border border-outline-variant rounded-lg hover:bg-surface-container-high transition-colors font-medium text-sm shadow-sm">Back to Inbox</a>
        </div>
    </div>
</x-admin-layout>
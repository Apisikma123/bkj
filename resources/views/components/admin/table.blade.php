@props(['headers'])

<div class="bg-white rounded-lg border border-outline-variant/30 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-on-surface-variant uppercase bg-surface-container-low border-b border-outline-variant/30">
                <tr>
                    @foreach($headers as $header)
                        <th scope="col" class="px-6 py-4 font-semibold tracking-wider">{{ $header }}</th>
                    @endforeach
                    <th scope="col" class="px-6 py-4 font-semibold tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-outline-variant/20">
                {{ $slot }}
            </tbody>
        </table>
    </div>
</div>

<x-admin-layout>
    <div class="space-y-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kelola Struktur Organisasi & Tim</h1>
                <p class="text-lg text-gray-600 mt-1">Kelola personil yang tampil di bagan organisasi halaman utama.</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.team-members.create') }}" class="inline-flex items-center px-5 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-primary/95 transition-colors shadow-sm text-lg">
                    <x-lucide-plus class="w-5 h-5 mr-2" /> Tambah Anggota Tim
                </a>
            </div>
        </div>

        {{-- Branch Tabs --}}
        <div class="flex flex-wrap space-x-1 space-y-1 md:space-y-0 bg-gray-100/50 p-1 rounded-xl mb-6 w-full max-w-2xl border border-gray-200">
            <a href="{{ route('admin.team-members.index', ['branch' => 'main', 'q' => request('q'), 'level' => request('level')]) }}" class="flex-1 text-center py-2.5 px-3 rounded-lg text-sm md:text-base font-bold transition-all {{ $branch === 'main' ? 'bg-white text-primary shadow-sm ring-1 ring-gray-200' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200/50' }}">PT Batam Kepri Jaya</a>
            <a href="{{ route('admin.team-members.index', ['branch' => 'koperasi', 'q' => request('q'), 'level' => request('level')]) }}" class="flex-1 text-center py-2.5 px-3 rounded-lg text-sm md:text-base font-bold transition-all {{ $branch === 'koperasi' ? 'bg-white text-primary shadow-sm ring-1 ring-gray-200' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200/50' }}">Koperasi TKBM BKJ</a>
            <a href="{{ route('admin.team-members.index', ['branch' => 'pt-bintang-kepri-jaya', 'q' => request('q'), 'level' => request('level')]) }}" class="flex-1 text-center py-2.5 px-3 rounded-lg text-sm md:text-base font-bold transition-all {{ $branch === 'pt-bintang-kepri-jaya' ? 'bg-white text-primary shadow-sm ring-1 ring-gray-200' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-200/50' }}">PT Bintang Kepri Jaya</a>
        </div>

        {{-- Search & Filter --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <form action="{{ route('admin.team-members.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <input type="hidden" name="branch" value="{{ $branch }}">
                <div class="flex-grow">
                    <x-text-input name="q" value="{{ request('q') }}" placeholder="Cari nama atau jabatan..." class="w-full text-lg py-3 px-4" />
                </div>
                <div class="w-full md:w-56">
                    <select name="level" class="w-full bg-white border border-outline-variant/40 rounded-lg text-lg py-3 px-4 focus:border-secondary focus:ring-secondary transition-colors" onchange="this.form.submit()">
                        <option value="all">Semua Tingkat</option>
                        @if($branch === 'koperasi')
                            <option value="supervisor" {{ request('level') === 'supervisor' ? 'selected' : '' }}>Pengawas</option>
                            <option value="management" {{ request('level') === 'management' ? 'selected' : '' }}>Pengurus</option>
                        @elseif($branch === 'pt-bintang-kepri-jaya')
                            <option value="director" {{ request('level') === 'director' ? 'selected' : '' }}>Direktur</option>
                            <option value="manager" {{ request('level') === 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="operational" {{ request('level') === 'operational' ? 'selected' : '' }}>Staff/Operasional</option>
                        @else
                            <option value="commissioner" {{ request('level') === 'commissioner' ? 'selected' : '' }}>Komisaris (Commissioner)</option>
                            <option value="director" {{ request('level') === 'director' ? 'selected' : '' }}>Direktur (Director)</option>
                            <option value="manager" {{ request('level') === 'manager' ? 'selected' : '' }}>Manager</option>
                            <option value="operational" {{ request('level') === 'operational' ? 'selected' : '' }}>Operasional (Operational)</option>
                        @endif
                    </select>
                </div>
                <button type="submit" class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-bold rounded-xl hover:bg-gray-200 transition-colors text-lg">
                    Cari
                </button>
            </form>
        </div>

        {{-- List --}}
        <x-admin.table :headers="['Nama', 'Jabatan', 'Tingkat Bagan', 'No. Urut', 'Status']">
            @forelse($members as $member)
                <tr>
                    <td class="px-6 py-4 font-bold text-gray-900 text-lg">
                        {{ $member->name }}
                    </td>
                    <td class="px-6 py-4 text-gray-700 text-lg">
                        {{ $member->role }}
                        <span class="block text-sm text-gray-500 font-normal mt-0.5">EN: {{ $member->role_en ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold bg-primary/5 text-primary">
                            @if($member->level === 'commissioner') Komisaris
                            @elseif($member->level === 'director') Direktur
                            @elseif($member->level === 'manager') Manager
                            @elseif($member->level === 'operational') Operasional
                            @elseif($member->level === 'supervisor') Pengawas
                            @elseif($member->level === 'management') Pengurus
                            @else {{ ucfirst($member->level) }}
                            @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-600 text-lg">
                        {{ $member->order }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $member->status === 'published' ? 'bg-green-50 text-green-700 border border-green-200' : 'bg-gray-50 text-gray-700 border border-gray-200' }}">
                            {{ $member->status === 'published' ? 'Diterbitkan' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.team-members.edit', $member) }}" class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <x-lucide-edit class="w-4 h-4" />
                            </a>
                            <form action="{{ route('admin.team-members.destroy', $member) }}" method="POST" class="inline" data-no-alert>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Delete" onclick="return confirm('Apakah Anda yakin ingin menghapus anggota tim ini?')">
                                    <x-lucide-trash-2 class="w-4 h-4" />
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center justify-center">
                            <x-lucide-users class="w-12 h-12 text-gray-300 mx-auto mb-4" />
                            <h3 class="text-xl font-bold text-gray-900">Belum ada data anggota tim</h3>
                            <p class="text-gray-500 mt-2 max-w-md mx-auto">Klik tombol "Tambah Anggota Tim" di atas untuk membuat personil bagan pertama.</p>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-admin.table>
        
        <div class="mt-4">
            {{ $members->links() }}
        </div>
        </div>
    </div>
</x-admin-layout>

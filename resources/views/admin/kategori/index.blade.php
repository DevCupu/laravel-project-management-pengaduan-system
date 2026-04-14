@extends('layouts.admin')

@section('content')
    <div class="container mx-auto py-8">
        <div class="flex items-center justify-between mb-8 px-4">
            <div>
                <h1 class="text-3xl font-black text-gray-900 leading-tight">Manajemen Bidang Layanan</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola kategori aspirasi yang dapat dipilih oleh warga Malimongan.</p>
            </div>
            <a href="{{ route('admin.kategori.create') }}"
                class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-6 py-3 rounded-xl shadow-lg shadow-indigo-200 transition transform active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v16m8-8H4" />
                </svg>
                Tambah Bidang Baru
            </a>
        </div>

        @if (session('success'))
            <div class="mx-4 mb-6 flex items-center bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        <div class="mx-4 overflow-hidden bg-white rounded-2xl shadow-sm border border-gray-100">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 uppercase text-[10px] font-black tracking-widest text-gray-500">
                    <tr>
                        <th class="px-6 py-4 text-left">No</th>
                        <th class="px-6 py-4 text-left">Nama Bidang / Layanan</th>
                        <th class="px-6 py-4 text-center">Tindakan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse ($kategoris as $item)
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-400">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-base font-bold text-gray-900">{{ $item->name_kategori }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-center space-x-2">
                                <a href="{{ route('admin.kategori.edit', $item->id) }}"
                                    class="inline-flex items-center px-4 py-2 bg-amber-50 text-amber-700 border border-amber-100 rounded-lg hover:bg-amber-100 transition font-bold text-xs uppercase"
                                    title="Ubah Data">
                                    Ubah
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $item->id) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus bidang layanan ini? Langkah ini tidak dapat dibatalkan.')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-red-50 text-red-700 border border-red-100 rounded-lg hover:bg-red-100 transition font-bold text-xs uppercase"
                                        title="Hapus Data">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                    <p class="text-gray-500 font-medium">Belum ada data bidang layanan yang terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{-- Pagination jika ada --}}
            {{ $kategoris->links() }}
        </div>
    </div>
@endsection

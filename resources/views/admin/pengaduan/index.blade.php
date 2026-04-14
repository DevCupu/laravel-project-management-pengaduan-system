@extends('layouts.admin')

@section('title', 'Daftar Pengaduan')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Page Header -->
        <div class="sm:flex sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">Manajemen Aspirasi Warga</h1>
                <p class="mt-2 text-sm text-gray-700">Pantau dan tindak lanjuti setiap aspirasi masyarakat Malimongan dari sini.</p>
            </div>
            <div class="mt-4 sm:mt-0 flex gap-2">
                 <div class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700">
                    <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Total: {{ $pengaduans->total() }} Aspirasi Masuk
                </div>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div class="col-span-1 md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Data</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-2.5"
                            placeholder="Ketik kata kunci, nama warga, atau isi laporan...">
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Filter Status Pelayanan</label>
                    <select name="status" id="status" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-lg py-2.5">
                        <option value="">Tampilkan Semua</option>
                        <option value="terkirim" {{ request('status') == 'terkirim' ? 'selected' : '' }}>Butuh Verifikasi (Baru)</option>
                        <option value="diproses" {{ request('status') == 'diproses' ? 'selected' : '' }}>Sedang Ditindaklanjuti</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Tuntas</option>
                    </select>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2.5 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Terapkan Filter
                    </button>
                     @if (request()->has('status') || request()->has('search'))
                        <a href="{{ route('admin.pengaduan.index') }}" class="inline-flex justify-center items-center px-4 py-2.5 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            Sapu Filter
                        </a>
                    @endif
                </div>
            </form>
        </div>

        @if (session('success'))
            <div class="rounded-lg bg-green-50 p-4 border border-green-200 mb-6 flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white shadow-sm rounded-xl border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Waktu Masuk</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Nama Warga</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aspirasi & Bidang</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Status Pelayanan</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($pengaduans as $pengaduan)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $pengaduan->created_at->format('d M Y') }}
                                    <span class="block text-xs text-gray-400">{{ $pengaduan->created_at->format('H:i') }} WIB</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 font-bold border border-indigo-200 uppercase">
                                                {{ substr($pengaduan->user->name ?? 'A', 0, 1) }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-bold text-gray-900">{{ Str::limit($pengaduan->user->name, 25) }}</div>
                                            <div class="text-xs text-gray-500">{{ Str::limit($pengaduan->user->email ?? '', 25) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900 mb-1 leading-snug">{{ Str::limit($pengaduan->judul, 50) }}</div>
                                     @if($pengaduan->kategori)
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-700 border border-indigo-100 uppercase tracking-tight mt-1">
                                            {{ $pengaduan->kategori->name_kategori }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold uppercase tracking-wide
                                        @if ($pengaduan->status == 'terkirim') bg-yellow-100 text-yellow-800
                                        @elseif ($pengaduan->status == 'diproses') bg-blue-100 text-blue-800
                                        @elseif ($pengaduan->status == 'selesai') bg-green-100 text-green-800
                                        @endif">
                                        @if ($pengaduan->status == 'terkirim') Baru
                                        @elseif ($pengaduan->status == 'diproses') Pengerjaan
                                        @elseif ($pengaduan->status == 'selesai') Tuntas
                                        @else {{ ucfirst($pengaduan->status) }}
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                    <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}" class="inline-flex items-center text-indigo-700 font-bold hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-4 py-2 rounded-lg transition-colors border border-indigo-100">
                                        Periksa
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <svg class="h-12 w-12 text-gray-300 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <p class="text-base font-bold text-gray-900">Belum ada data aspirasi</p>
                                        <p class="text-sm text-gray-500 mt-1">Data yang Anda cari tidak tersedia dalam database saat ini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                 {{ $pengaduans->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection

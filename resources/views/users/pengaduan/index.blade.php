@extends('layouts.users')

@section('content')
    <div class="max-w-6xl mx-auto mt-10 px-4">
        <h1 class="text-3xl font-extrabold mb-8 text-gray-900 flex items-center gap-2">
            Riwayat Aspirasi Saya
        </h1>

        {{-- Section: Tambah Pengaduan --}}
        <div class="mb-8">
            <a href="{{ route('users.pengaduan.create') }}"
                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-bold rounded-xl shadow hover:bg-blue-700 transition active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                </svg>
                Sampaikan Aspirasi Baru
            </a>
        </div>

        @forelse ($pengaduans as $pengaduan)
            <div
                class="bg-white shadow-lg p-6 rounded-2xl mb-6 border-l-8
                @if ($pengaduan->status == 'selesai') border-green-500
                @elseif($pengaduan->status == 'diproses') border-blue-500
                @else border-yellow-500 @endif transition hover:shadow-xl border border-gray-100">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                    <h2 class="text-xl font-bold text-gray-800">
                        {{ $pengaduan->judul }}
                    </h2>
                    <span
                        class="inline-flex items-center px-4 py-1 rounded-full text-xs font-black uppercase tracking-wider
                        @if ($pengaduan->status == 'selesai') bg-green-100 text-green-700
                        @elseif($pengaduan->status == 'diproses') bg-blue-100 text-blue-700
                        @else bg-yellow-100 text-yellow-700 @endif">
                        @if ($pengaduan->status == 'selesai') Tuntas
                        @elseif($pengaduan->status == 'diproses') Sedang Ditindak
                        @else Menunggu @endif
                    </span>
                </div>
                
                {{-- Status description --}}
                <div class="mb-4 p-3 rounded-lg @if($pengaduan->status == 'selesai') bg-green-50 @elseif($pengaduan->status == 'diproses') bg-blue-50 @else bg-yellow-50 @endif">
                    <p class="text-sm font-medium">
                        @if ($pengaduan->status == 'selesai')
                            <span class="text-green-800">Alhamdulillah, aspirasi Anda telah tuntas ditangani oleh tim kami. Terima kasih atas partisipasinya!</span>
                        @elseif ($pengaduan->status == 'diproses')
                            <span class="text-blue-800">Laporan Anda sedang dalam tahap pengerjaan oleh tim terkait di lapangan.</span>
                        @else
                            <span class="text-yellow-800">Laporan telah kami terima. Mohon tunggu tim kami melakukan verifikasi data terlebih dahulu.</span>
                        @endif
                    </p>
                </div>

                <div class="flex items-center gap-4 text-xs text-gray-400 mb-4">
                    <span class="flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                        {{ $pengaduan->created_at->format('d M Y') }}
                    </span>
                    <span class="px-2 py-0.5 bg-gray-100 rounded-md text-gray-600 font-semibold">{{ $pengaduan->kategori->name_kategori ?? 'Umum' }}</span>
                </div>

                <p class="text-gray-600 leading-relaxed">{{ Str::limit($pengaduan->isi, 150) }}</p>

                <div class="mt-6 pt-6 border-t border-gray-100 flex flex-wrap gap-4 items-center justify-between">
                    <div class="flex gap-4">
                        <a href="{{ route('users.pengaduan.show', $pengaduan->id) }}"
                            class="text-blue-600 font-bold hover:text-blue-800 flex items-center gap-1 text-sm">
                            Detail Laporan
                        </a>
                        @if($pengaduan->status == 'terkirim')
                        <a href="{{ route('users.pengaduan.edit', $pengaduan->id) }}"
                            class="text-yellow-600 font-bold hover:text-yellow-800 flex items-center gap-1 text-sm">
                            Ubah
                        </a>
                        @endif
                    </div>
                    
                    @if($pengaduan->status == 'terkirim')
                    <form action="{{ route('users.pengaduan.destroy', $pengaduan->id) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin membatalkan laporan ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="text-gray-400 font-bold hover:text-red-600 flex items-center gap-1 text-sm transition-colors">
                            Batalkan
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-gray-50 border-2 border-dashed border-gray-200 p-12 rounded-3xl text-center">
                <div class="text-5xl mb-4">📝</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Belum ada aspirasi terkirim</h3>
                <p class="text-gray-500 mb-6 italic">Yuk, ikut berkontribusi membangun Malimongan dengan melaporkan kendala atau memberi saran di lingkungan Anda.</p>
                <a href="{{ route('users.pengaduan.create') }}" class="text-blue-600 font-bold hover:underline">Mulai sampaikan aspirasi →</a>
            </div>
        @endforelse
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto mt-8 px-4 sm:px-6 lg:px-8 pb-12">
        <!-- Header Section -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8 flex flex-col md:flex-row items-start md:items-center gap-6">
            <div class="flex-shrink-0">
                <div class="h-16 w-16 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 shadow-sm border border-indigo-100">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
            </div>
            <div class="flex-grow">
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Detail Aspirasi Warga</h2>
                <div class="flex flex-wrap items-center gap-3 text-sm text-gray-500">
                    <span class="font-bold text-gray-900 bg-gray-100 px-3 py-1 rounded-full flex items-center">
                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        {{ $pengaduan->user->name }}
                    </span>
                    <span>•</span>
                    <span class="flex items-center font-medium">
                        <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $pengaduan->created_at->format('d M Y, H:i') }} WIB
                    </span>
                    <span>•</span>
                    <span class="font-mono text-gray-400">ID: #{{ $pengaduan->id }}</span>
                </div>
            </div>
             <div class="flex-shrink-0">
                <span class="inline-flex items-center px-4 py-2 rounded-full text-xs font-black uppercase tracking-widest shadow-sm border
                    @if ($pengaduan->status == 'terkirim') bg-yellow-50 text-yellow-700 border-yellow-200
                    @elseif($pengaduan->status == 'diproses') bg-blue-50 text-blue-700 border-blue-200
                    @else bg-green-50 text-green-700 border-green-200 @endif">
                    @if ($pengaduan->status == 'terkirim')
                        Baru
                    @elseif($pengaduan->status == 'diproses')
                        Tindak Lanjut
                    @else
                        Tuntas
                    @endif
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Description Card -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <div class="mb-6 border-b border-gray-100 pb-4">
                         <h3 class="text-xl font-black text-gray-900 mb-2 leading-tight">{{ $pengaduan->judul }}</h3>
                         <div class="inline-flex items-center bg-indigo-50 text-indigo-700 px-3 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider border border-indigo-100">
                            {{ $pengaduan->kategori->name_kategori ?? 'Aspirasi Umum' }}
                        </div>
                    </div>

                    <div class="prose max-w-none text-gray-700 leading-relaxed text-lg">
                        {{ $pengaduan->isi }}
                    </div>
                </div>

                <!-- Images -->
                @if ($pengaduan->gambar)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center uppercase tracking-wider text-xs">
                        <svg class="w-5 h-5 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Foto Pendukung Lokasi
                    </h4>
                    <div class="rounded-2xl overflow-hidden border border-gray-200 shadow-inner">
                        <img src="{{ asset('storage/' . $pengaduan->gambar) }}" class="w-full h-auto object-cover" style="max-height: 600px">
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-8">
                 <!-- Attachments -->
                @if ($pengaduan->lampiran && $pengaduan->lampiran->isNotEmpty())
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h4 class="font-bold text-gray-900 mb-4 flex items-center text-[10px] uppercase tracking-widest">
                        Berkas Pendukung
                    </h4>
                    <ul class="space-y-3">
                        @foreach ($pengaduan->lampiran as $lampiran)
                            <li>
                                <a href="{{ asset('storage/' . $lampiran->file_path) }}" target="_blank"
                                    class="flex items-center p-4 rounded-xl bg-gray-50 border border-gray-200 hover:border-indigo-300 hover:bg-white transition-all group text-sm">
                                    <span class="flex-shrink-0 mr-3 text-gray-400 group-hover:text-indigo-500">
                                         <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    </span>
                                    <span class="font-bold text-gray-700 group-hover:text-indigo-700 truncate">
                                        {{ basename($lampiran->file_path) }}
                                    </span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Admin Actions Box -->
                <div class="bg-indigo-900 rounded-2xl shadow-xl p-8 text-white overflow-hidden relative">
                    <div class="relative z-10">
                        <h4 class="font-bold text-lg mb-6 text-white border-b border-indigo-800 pb-3">Respon Laporan</h4>
                        <form method="POST" action="{{ route('admin.pengaduan.update', $pengaduan) }}" class="space-y-6">
                            @csrf
                            @method('PUT')
                            <div>
                                <label class="text-[10px] uppercase font-black text-indigo-300 mb-2 block tracking-widest">Update Progres</label>
                                <select name="status" class="w-full bg-indigo-800 border-indigo-700 text-white rounded-xl focus:ring-indigo-400 focus:border-indigo-400 font-bold p-3">
                                    <option value="terkirim" {{ $pengaduan->status == 'terkirim' ? 'selected' : '' }}>Konfirmasi Baru (Pending)</option>
                                    <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Sedang Ditindaklanjuti</option>
                                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Tuntas / Selesai</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full bg-white text-indigo-900 font-black py-4 px-4 rounded-xl hover:bg-indigo-50 transition-all flex justify-center items-center shadow-lg active:scale-95">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                PERBARUI STATUS
                            </button>
                        </form>
                    </div>
                     <!-- Decorative circles -->
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-800 rounded-full opacity-50 blur-xl"></div>
                    <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-24 h-24 bg-indigo-600 rounded-full opacity-50 blur-xl"></div>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8 mb-10">
            <h3 class="text-xl font-bold text-gray-900 mb-8 flex items-center">
                <svg class="w-6 h-6 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
                Layanan Diskusi & Solusi
            </h3>

            <!-- Comment Form -->
            <form action="{{ route('admin.pengaduan.komentar.store', $pengaduan->id) }}" method="POST" class="mb-10 p-6 bg-slate-50 rounded-2xl border border-dashed border-slate-200">
                @csrf
                <div class="flex gap-4 items-start">
                    <div class="flex-shrink-0 hidden md:block">
                        <div class="h-12 w-12 rounded-full bg-indigo-600 flex items-center justify-center text-white font-black shadow-md uppercase">
                             {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                    </div>
                    <div class="flex-grow">
                        <textarea name="isi_komentar"
                            class="w-full border border-gray-200 rounded-2xl p-4 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 min-h-[120px] shadow-sm text-gray-900 placeholder-gray-400"
                            placeholder="Tulis pesan respon untuk warga atau instruksi internal tim..." required></textarea>
                        <div class="mt-4 flex justify-end">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold px-8 py-3 rounded-xl shadow-md transition-all flex items-center active:scale-95">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                KIRIM RESPON
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="space-y-8">
                @forelse ($pengaduan->komentar as $komentar)
                    <div class="flex gap-4 group">
                        <div class="flex-shrink-0">
                            <div class="h-12 w-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-500 font-bold border border-slate-200 uppercase shadow-sm">
                                {{ substr($komentar->user->name, 0, 1) }}
                            </div>
                        </div>
                        <div class="flex-grow">
                            <div class="bg-white rounded-3xl rounded-tl-none px-8 py-6 border border-slate-100 shadow-sm relative group-hover:shadow-md transition-all">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <span class="font-black text-gray-900 block text-base">{{ $komentar->user->name }}</span>
                                        <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">{{ $komentar->created_at->format('d M Y, H:i') }}</span>
                                    </div>

                                     @if (auth()->user()->id === $komentar->user_id)
                                    <form action="{{ route('admin.pengaduan.komentar.destroy', $komentar->id) }}" method="POST"
                                        class="opacity-0 group-hover:opacity-100 transition-opacity"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus tanggapan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-300 hover:text-red-500 transition-colors p-2" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                                <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $komentar->isi_komentar }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white shadow-sm mb-4">
                            <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                        </div>
                        <p class="text-slate-500 font-medium">Belum ada respon yang dicatat untuk aspirasi ini.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="mb-10 text-center">
             <a href="{{ route('admin.pengaduan.index') }}" class="inline-flex items-center text-slate-400 hover:text-slate-900 font-bold transition-colors uppercase tracking-widest text-[10px]">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                KEMBALI KE MANAJEMEN ASPIRASI
            </a>
        </div>
    </div>
@endsection

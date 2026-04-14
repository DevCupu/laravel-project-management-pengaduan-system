@extends('layouts.users')

@section('content')
    <div class="max-w-4xl mx-auto bg-white shadow-xl rounded-2xl p-8 border border-gray-100 mt-6">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-extrabold text-gray-900">Ubah Aspirasi / Keluhan</h2>
            <a href="{{ route('users.pengaduan.index') }}" class="text-sm text-slate-500 hover:text-slate-800 font-medium flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke Riwayat
            </a>
        </div>

        @if (session('success'))
            <div class="mb-6 px-4 py-3 rounded-lg bg-green-50 text-green-700 border border-green-200 flex items-center shadow-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('users.pengaduan.update', $pengaduan->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Judul -->
            <div>
                <label for="judul" class="block text-base font-semibold text-gray-700 mb-2">Judul Aspirasi / Keluhan <span class="text-red-500">*</span></label>
                <input type="text" name="judul" id="judul"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400"
                    value="{{ old('judul', $pengaduan->judul) }}" required placeholder="Contoh: Lampu Jalan Mati di Gang 5" />
            </div>

            <!-- Kategori -->
            <div>
                <label for="kategori_id" class="block text-base font-semibold text-gray-700 mb-2">Jenis Layanan / Bidang <span class="text-red-500">*</span></label>
                <div class="relative">
                    <select name="kategori_id" id="kategori_id"
                        class="w-full border border-gray-300 rounded-xl p-3 bg-white text-gray-900 text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 appearance-none transition"
                        required>
                        <option value="" disabled selected>- Pilih Bidang Terkait -</option>
                        @forelse ($kategori as $item)
                            <option value="{{ $item->id }}" {{ $pengaduan->kategori_id == $item->id ? 'selected' : '' }}>
                                {{ $item->name_kategori ?? 'Tanpa Nama' }}
                            </option>
                        @empty
                            <option value="">Tidak ada kategori</option>
                        @endforelse
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            <!-- Isi Pengaduan -->
            <div>
                <label for="isi" class="block text-base font-semibold text-gray-700 mb-2">Ceritakan Detail Masalah Anda <span class="text-red-500">*</span></label>
                <textarea name="isi" id="isi" rows="6"
                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition placeholder-gray-400 leading-relaxed"
                    required placeholder="Jelaskan secara rinci lokasi dan kronologi masalah...">{{ old('isi', $pengaduan->isi) }}</textarea>
            </div>

            <div class="pt-4 flex items-center justify-end gap-4 border-t border-gray-100">
                <a href="{{ route('users.pengaduan.index') }}" class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-semibold hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-bold rounded-xl shadow-lg shadow-teal-200 transition transform active:scale-95">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection

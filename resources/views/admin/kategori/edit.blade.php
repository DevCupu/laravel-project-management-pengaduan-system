@extends('layouts.admin')

@section('content')
    <div class="container mx-auto py-12 flex justify-center px-4">
        <div class="w-full max-w-lg bg-white shadow-2xl shadow-slate-200 rounded-3xl p-10 border border-slate-100">
            <h1 class="text-3xl font-black text-gray-900 mb-2 text-center">Ubah Bidang Layanan</h1>
            <p class="text-center text-slate-500 mb-8 text-sm">Sesuaikan nama bidang layanan untuk memudahkan pengelompokan aspirasi warga.</p>

            <form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-gray-700 font-bold mb-3 text-base">Nama Bidang / Layanan <span class="text-red-500">*</span></label>
                    <input
                        type="text"
                        name="name_kategori"
                        class="w-full border border-slate-200 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 p-4 rounded-2xl transition duration-200 text-lg font-medium placeholder-slate-400"
                        value="{{ old('name_kategori', $kategori->name_kategori) }}"
                        required
                        autocomplete="off"
                    >
                    @error('name_kategori')
                        <div class="text-red-500 text-sm mt-2 font-medium flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="flex flex-col gap-4">
                    <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 transition-all text-white font-black py-4 rounded-2xl shadow-lg shadow-indigo-100 active:scale-95 text-lg">
                        SIMPAN PERUBAHAN
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="text-center text-slate-400 hover:text-slate-700 transition font-bold text-xs uppercase tracking-widest py-2">
                        BATAL & KEMBALI
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

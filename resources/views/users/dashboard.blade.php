@extends('layouts.users')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-10 px-2 pb-12">
    <!-- Welcome Header -->
    <div class="mb-10">
        <span class="text-indigo-600 font-black text-xs uppercase tracking-[0.2em] mb-2 block">Resident Hub</span>
        <h2 class="text-4xl font-black text-[#191c1e] tracking-tight">Halo, {{ Auth::user()->name }}</h2>
        <p class="text-slate-500 font-medium mt-1">Sampaikan aspirasi Anda dan pantau kemajuan penanganan masalah di lingkungan kita.</p>
    </div>

    <!-- Metric Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- My Aspirations -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-indigo-600 border border-slate-100 transition-all hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <span class="p-2.5 bg-indigo-50 rounded-xl text-indigo-600 border border-indigo-100">
                    <span class="material-symbols-outlined text-xl">history</span>
                </span>
                <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-2 py-1 rounded-lg uppercase tracking-wider">Total</span>
            </div>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mb-1">Aspirasi Saya</p>
            <h3 class="text-3xl font-black text-[#191c1e] tracking-tighter">{{ \App\Models\Pengaduan::where('user_id', Auth::id())->count() }}</h3>
        </div>

        <!-- In Progress -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-amber-500 border border-slate-100 transition-all hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <span class="p-2.5 bg-amber-50 rounded-xl text-amber-600 border border-amber-100">
                    <span class="material-symbols-outlined text-xl">sync</span>
                </span>
                <span class="text-[10px] font-black text-amber-600 bg-amber-50 px-2 py-1 rounded-lg uppercase tracking-wider">Proses</span>
            </div>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mb-1">Sedang Ditindak</p>
            <h3 class="text-3xl font-black text-[#191c1e] tracking-tighter">{{ \App\Models\Pengaduan::where('user_id', Auth::id())->where('status', 'diproses')->count() }}</h3>
        </div>

        <!-- Completed -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-green-500 border border-slate-100 transition-all hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <span class="p-2.5 bg-green-50 rounded-xl text-green-600 border border-green-100">
                    <span class="material-symbols-outlined text-xl">check_circle</span>
                </span>
                <span class="text-[10px] font-black text-green-600 bg-green-50 px-2 py-1 rounded-lg uppercase tracking-wider">Selesai</span>
            </div>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mb-1">Tuntas</p>
            <h3 class="text-3xl font-black text-[#191c1e] tracking-tighter">{{ \App\Models\Pengaduan::where('user_id', Auth::id())->where('status', 'selesai')->count() }}</h3>
        </div>
    </div>

    <!-- Actions & History -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- New Aspiration Card -->
        <div class="lg:col-span-1 bg-indigo-900 rounded-[2.5rem] p-10 relative overflow-hidden flex flex-col justify-between shadow-2xl shadow-indigo-200 min-h-[400px]">
            <div class="relative z-10">
                <span class="text-indigo-400 font-black text-[10px] uppercase tracking-widest mb-4 block">Quick Action</span>
                <h4 class="text-3xl font-black text-white tracking-tight mb-4 leading-tight">Suarakan Aspirasi Anda</h4>
                <p class="text-indigo-200 text-sm font-medium opacity-80 leading-relaxed mb-8">Punya keluhan atau saran untuk lingkungan Malimongan? Tim kami siap mendengar dan menindaklanjuti setiap laporan Anda.</p>
                
                <a href="{{ route('users.pengaduan.create') }}" class="inline-flex items-center gap-3 bg-white text-indigo-900 px-8 py-4 rounded-2xl font-black text-sm shadow-xl hover:bg-slate-50 transition-all hover:-translate-y-1 active:scale-95 group">
                    Buat Laporan
                    <span class="material-symbols-outlined text-lg transition-transform group-hover:translate-x-1">arrow_forward</span>
                </a>
            </div>
            
            <!-- Decoration -->
            <div class="absolute -right-10 -bottom-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
        </div>

        <!-- History Timeline -->
        <div class="lg:col-span-2 bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
            <div class="flex justify-between items-center mb-8">
                <h4 class="text-xl font-black text-[#191c1e] tracking-tight">Riwayat Pengaduan</h4>
                <a href="{{ route('users.pengaduan.index') }}" class="p-2 bg-slate-50 text-slate-400 hover:text-indigo-600 rounded-xl transition-colors">
                    <span class="material-symbols-outlined text-xl">manage_search</span>
                </a>
            </div>

            <div class="space-y-8 relative">
                @forelse(\App\Models\Pengaduan::where('user_id', Auth::id())->latest()->take(4)->get() as $item)
                <div class="flex gap-4 relative">
                    @if(!$loop->last)
                    <div class="absolute left-6 top-10 bottom-[-32px] w-[1px] bg-slate-100"></div>
                    @endif
                    <div class="relative z-10 w-12 h-12 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-slate-400 text-lg">
                            @if($item->status == 'terkirim') mail @elseif($item->status == 'diproses') sync @else task_alt @endif
                        </span>
                    </div>
                    <div class="flex-1 flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <div>
                            <p class="text-sm font-black text-[#191c1e] line-clamp-1 pr-2 mb-0.5">{{ $item->judul }}</p>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $item->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-[9px] px-3 py-1 font-black uppercase tracking-widest rounded-lg 
                                @if($item->status == 'terkirim') bg-amber-50 text-amber-600 border border-amber-100 @elseif($item->status == 'diproses') bg-blue-50 text-blue-600 border border-blue-100 @else bg-green-50 text-green-600 border border-green-100 @endif">
                                {{ $item->status }}
                            </span>
                            <a href="{{ route('users.pengaduan.show', $item->id) }}" class="p-2 bg-slate-50 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-lg transition-all text-[10px] font-black uppercase tracking-widest">Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-12">
                    <span class="material-symbols-outlined text-slate-200 text-5xl mb-4">history_toggle_off</span>
                    <p class="text-slate-400 text-sm font-medium">Anda belum pernah mengirim aspirasi.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection


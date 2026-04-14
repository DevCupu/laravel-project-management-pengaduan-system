@extends('layouts.admin')

@section('title', 'Overview')

@section('content')
<div class="space-y-10 px-2 pb-12">
    <!-- Welcome Header -->
    <div class="mb-10">
        <span class="text-indigo-600 font-black text-xs uppercase tracking-[0.2em] mb-2 block">Executive Insights</span>
        <h2 class="text-4xl font-black text-[#191c1e] tracking-tight">Selamat Bekerja, {{ Auth::user()->name }}</h2>
        <p class="text-slate-500 font-medium mt-1">Pantau rincian aspirasi dan monitor efisiensi pelayanan warga hari ini.</p>
    </div>

    <!-- Metric Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Reports -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-indigo-600 border border-slate-100 transition-all hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <span class="p-2.5 bg-indigo-50 rounded-xl text-indigo-600 border border-indigo-100">
                    <span class="material-symbols-outlined text-xl">analytics</span>
                </span>
                <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 px-2 py-1 rounded-lg uppercase tracking-wider">Total</span>
            </div>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mb-1">Total Aspirasi</p>
            <h3 class="text-3xl font-black text-[#191c1e] tracking-tighter">{{ \App\Models\Pengaduan::count() }}</h3>
        </div>

        <!-- Reports to Verify -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-amber-500 border border-slate-100 transition-all hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <span class="p-2.5 bg-amber-50 rounded-xl text-amber-600 border border-amber-100">
                    <span class="material-symbols-outlined text-xl">pending_actions</span>
                </span>
                <span class="text-[10px] font-black text-amber-600 bg-amber-50 px-2 py-1 rounded-lg uppercase tracking-wider">Pending</span>
            </div>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mb-1">Butuh Verifikasi</p>
            <h3 class="text-3xl font-black text-[#191c1e] tracking-tighter">{{ \App\Models\Pengaduan::where('status', 'terkirim')->count() }}</h3>
        </div>

        <!-- In Progress -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-blue-500 border border-slate-100 transition-all hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <span class="p-2.5 bg-blue-50 rounded-xl text-blue-600 border border-blue-100">
                    <span class="material-symbols-outlined text-xl">sync</span>
                </span>
                <span class="text-[10px] font-black text-blue-600 bg-blue-50 px-2 py-1 rounded-lg uppercase tracking-wider">Aktif</span>
            </div>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mb-1">Sedang Diproses</p>
            <h3 class="text-3xl font-black text-[#191c1e] tracking-tighter">{{ \App\Models\Pengaduan::where('status', 'diproses')->count() }}</h3>
        </div>

        <!-- Completed -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-green-500 border border-slate-100 transition-all hover:shadow-md">
            <div class="flex justify-between items-start mb-4">
                <span class="p-2.5 bg-green-50 rounded-xl text-green-600 border border-green-100">
                    <span class="material-symbols-outlined text-xl">check_circle</span>
                </span>
                <span class="text-[10px] font-black text-green-600 bg-green-50 px-2 py-1 rounded-lg uppercase tracking-wider">Tuntas</span>
            </div>
            <p class="text-slate-500 text-[10px] font-bold uppercase tracking-widest mb-1">Laporan Selesai</p>
            <h3 class="text-3xl font-black text-[#191c1e] tracking-tighter">{{ \App\Models\Pengaduan::where('status', 'selesai')->count() }}</h3>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Efficiency Chart Visual -->
        <div class="lg:col-span-2 bg-indigo-900 rounded-[2.5rem] p-10 relative overflow-hidden flex flex-col justify-between shadow-2xl shadow-indigo-200">
            <div class="relative z-10">
                <h4 class="text-2xl font-black text-white tracking-tight mb-2">Efisiensi Pelayanan</h4>
                <p class="text-indigo-200 text-sm font-medium opacity-80 max-w-sm leading-relaxed">Persentase laporan warga yang telah mendapatkan respon dan penyelesaian tepat waktu bulan ini.</p>
            </div>
            
            <div class="mt-12 flex flex-col sm:flex-row items-center justify-between gap-8 relative z-10">
                <div class="relative h-48 w-48">
                    @php
                        $total = \App\Models\Pengaduan::count();
                        $done = \App\Models\Pengaduan::where('status', 'selesai')->count();
                        $percent = $total > 0 ? round(($done / $total) * 100) : 0;
                    @endphp
                    <svg class="h-full w-full rotate-[-90deg]" viewBox="0 0 36 36">
                        <path class="text-indigo-800" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-width="3"></path>
                        <path class="text-indigo-400" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="currentColor" stroke-dasharray="{{ $percent }}, 100" stroke-linecap="round" stroke-width="3"></path>
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-4xl font-black text-white tracking-tighter">{{ $percent }}%</span>
                        <span class="text-[10px] font-black text-indigo-300 uppercase tracking-widest mt-1">Resolved</span>
                    </div>
                </div>

                <div class="flex-1 w-full space-y-6">
                    <div class="space-y-2">
                        <div class="flex justify-between items-end">
                            <span class="text-white font-bold text-xs uppercase tracking-widest">Kepuasan Warga</span>
                            <span class="text-white font-black text-sm">85%</span>
                        </div>
                        <div class="h-2 w-full bg-indigo-800 rounded-full overflow-hidden">
                            <div class="h-full bg-indigo-400 w-[85%] rounded-full shadow-[0_0_10px_rgba(129,140,248,0.5)]"></div>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between items-end">
                            <span class="text-white font-bold text-xs uppercase tracking-widest">Kecepatan Respon</span>
                            <span class="text-white font-black text-sm">72%</span>
                        </div>
                        <div class="h-2 w-full bg-indigo-800 rounded-full overflow-hidden">
                            <div class="h-full bg-indigo-400 w-[72%] rounded-full shadow-[0_0_10px_rgba(129,140,248,0.5)]"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Decoration -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl"></div>
        </div>

        <!-- Recent Activity Timeline -->
        <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100">
            <div class="flex justify-between items-center mb-8">
                <h4 class="text-xl font-black text-[#191c1e] tracking-tight">Aspirasi Terbaru</h4>
                <a href="{{ route('admin.pengaduan.index') }}" class="p-2 bg-slate-50 text-slate-400 hover:text-indigo-600 rounded-xl transition-colors">
                    <span class="material-symbols-outlined text-xl">arrow_forward</span>
                </a>
            </div>

            <div class="space-y-8 relative">
                @forelse(\App\Models\Pengaduan::with('user')->latest()->take(4)->get() as $item)
                <div class="flex gap-4 relative">
                    @if(!$loop->last)
                    <div class="absolute left-6 top-10 bottom-[-32px] w-[1px] bg-slate-100"></div>
                    @endif
                    <div class="relative z-10 w-12 h-12 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-slate-400 text-lg">
                            @if($item->status == 'terkirim') mail @elseif($item->status == 'diproses') sync @else task_alt @endif
                        </span>
                    </div>
                    <div class="flex-1">
                        <div class="flex justify-between items-start mb-0.5">
                            <p class="text-sm font-black text-[#191c1e] line-clamp-1 pr-2">{{ $item->judul }}</p>
                            <span class="text-[9px] font-black text-slate-400 uppercase whitespace-nowrap">{{ $item->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-xs text-slate-500 font-medium line-clamp-1 mb-2">{{ $item->user->name ?? 'Anonim' }}</p>
                        <span class="text-[9px] px-2 py-0.5 font-black uppercase tracking-widest rounded-lg 
                            @if($item->status == 'terkirim') bg-amber-50 text-amber-600 @elseif($item->status == 'diproses') bg-blue-50 text-blue-600 @else bg-green-50 text-green-600 @endif">
                            {{ $item->status }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="text-center py-8">
                    <p class="text-slate-400 text-sm font-medium">Belum ada aktifitas terbaru.</p>
                </div>
                @endforelse
            </div>

            <a href="{{ route('admin.pengaduan.index') }}" class="w-full mt-10 py-4 text-[10px] font-black text-slate-400 hover:text-indigo-600 border-2 border-dashed border-slate-100 hover:border-indigo-100 transition-all rounded-2xl uppercase tracking-widest flex items-center justify-center gap-2 group">
                Lihat Semua Laporan
                <span class="material-symbols-outlined text-sm transition-transform group-hover:translate-x-1">arrow_forward</span>
            </a>
        </div>
    </div>
</div>
@endsection

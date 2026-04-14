<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Malimo Report - Suara Warga Malimongan</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Inter', sans-serif; background-color: #f7f9fb; }
        h1, h2, h3 { font-family: 'Public Sans', sans-serif; }
    </style>
</head>
<body class="text-on-surface">
<!-- TopNavBar -->
<nav class="fixed top-0 w-full z-50 bg-white/80 dark:bg-slate-900/80 backdrop-blur-xl shadow-sm dark:shadow-none flex justify-between items-center px-8 h-16 w-full transition-all duration-300">
    <div class="flex items-center gap-3">
        <img src="{{ asset('images/logo.png') }}" alt="Malimo Report Logo" class="h-10 w-auto rounded-full">
        <div class="text-xl font-bold text-blue-900 dark:text-white font-headline tracking-tight">Malimo Report</div>
    </div>
    <div class="hidden md:flex space-x-8 items-center">
        <a class="text-slate-500 dark:text-slate-400 font-medium hover:text-blue-700 dark:hover:text-blue-300 transition-colors" href="#">Public Reports</a>
        <a class="text-slate-500 dark:text-slate-400 font-medium hover:text-blue-700 dark:hover:text-blue-300 transition-colors" href="#">Information</a>
        <a class="text-slate-500 dark:text-slate-400 font-medium hover:text-blue-700 dark:hover:text-blue-300 transition-colors" href="#">Map</a>
    </div>
    <div class="flex items-center space-x-4">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="text-slate-500 dark:text-slate-400 font-medium hover:text-blue-700 transition-colors">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-slate-500 dark:text-slate-400 font-medium hover:text-blue-700 transition-colors">Sign In</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="bg-primary hover:bg-primary-container text-white px-5 py-2 rounded-full font-semibold transition-all shadow-sm">Register</a>
                @endif
            @endauth
        @endif
    </div>
</nav>

<main class="pt-16">
    <!-- Hero Section -->
    <section class="relative min-h-[870px] flex items-center overflow-hidden bg-surface">
        <div class="absolute inset-0 z-0 overflow-hidden">
            <div class="absolute top-[-10%] right-[-10%] w-[600px] h-[600px] rounded-full bg-primary/5 blur-[120px]"></div>
            <div class="absolute bottom-[-5%] left-[-5%] w-[400px] h-[400px] rounded-full bg-secondary-container/20 blur-[100px]"></div>
        </div>
        <div class="max-w-7xl mx-auto px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">
            <div class="lg:col-span-7 space-y-8">
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container text-xs font-bold tracking-wider uppercase">
                    <span class="mr-2 flex h-2 w-2 rounded-full bg-primary"></span>
                    Pusat Aspirasi & Pengaduan Warga
                </div>
                <h1 class="text-5xl md:text-7xl font-black text-primary leading-[1.05] tracking-tighter">
                    Bangun <br/>Malimongan
                </h1>
                <p class="text-lg md:text-xl text-on-surface-variant max-w-xl leading-relaxed font-body">
                    Punya keluhan soal fasilitas umum atau ide untuk kemajuan lingkungan kita? Laporkan di sini. Kami pastikan aspirasi Anda didengar dan ditindaklanjuti oleh tim Kelurahan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ auth()->check() ? route('users.pengaduan.create') : route('login') }}" class="px-8 py-4 bg-gradient-to-b from-primary to-primary-container text-white rounded-full font-bold text-lg shadow-lg hover:shadow-xl transition-all active:scale-95 text-center">
                        Mulai Melapor
                    </a>
                    <a href="{{ auth()->check() ? route('users.pengaduan.index') : route('login') }}" class="px-8 py-4 bg-surface-container-lowest text-primary rounded-full font-bold text-lg hover:bg-surface-container-low transition-all text-center">
                        Lihat Laporan Publik
                    </a>
                </div>
            </div>
            <div class="lg:col-span-5">
                <div class="relative group">
                    <!-- Decorative backglow -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-primary to-blue-600 rounded-[2rem] blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                    
                    <div class="relative bg-white dark:bg-slate-800 p-8 md:p-10 rounded-[2rem] shadow-2xl border border-slate-100 dark:border-slate-700">
                        <div class="space-y-6">
                            <div class="space-y-2 text-center md:text-left">
                                <h3 class="text-2xl font-black text-primary tracking-tight">Apa yang ingin Anda lakukan hari ini?</h3>
                                <p class="text-slate-500 dark:text-slate-400 text-sm">Pilih layanan di bawah untuk mulai berkontribusi demi kenyamanan warga Malimongan.</p>
                            </div>
                            
                            <div class="space-y-4">
                                <a href="{{ auth()->check() ? route('users.pengaduan.create') : route('login') }}" class="flex items-center justify-between w-full p-4 bg-primary hover:bg-primary-container text-white rounded-2xl font-bold transition-all hover:scale-[1.02] active:scale-95 shadow-md">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-white/20 rounded-lg">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                        </div>
                                        <span>Buat Laporan / Aspirasi</span>
                                    </div>
                                    <svg class="w-5 h-5 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>

                                <a href="{{ auth()->check() ? route('users.pengaduan.index') : route('login') }}" class="flex items-center justify-between w-full p-4 bg-slate-50 dark:bg-slate-700 hover:bg-slate-100 dark:hover:bg-slate-600 text-slate-900 dark:text-white rounded-2xl font-bold transition-all hover:scale-[1.02] active:scale-95 border border-slate-200 dark:border-slate-600">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-slate-200 dark:bg-slate-600 rounded-lg text-slate-600 dark:text-slate-300">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                        </div>
                                        <span>Pantau Laporan Publik</span>
                                    </div>
                                    <svg class="w-5 h-5 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>

                            <div class="pt-4 border-t border-slate-100 dark:border-slate-700 text-center">
                                @guest
                                    <p class="text-xs text-slate-400">Belum punya akun? <a href="{{ route('register') }}" class="text-primary font-bold hover:underline">Daftar sekarang</a> untuk mulai melapor.</p>
                                @else
                                    <p class="text-xs text-slate-400">Anda masuk sebagai <span class="font-bold text-slate-600 dark:text-slate-300">{{ Auth::user()->name }}</span></p>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section - Tonal Layering -->
    <section class="py-20 bg-surface-container-low">
        <div class="max-w-7xl mx-auto px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Stat Card 1 -->
                <div class="bg-surface-container-lowest p-10 rounded-full flex flex-col items-center text-center space-y-4 shadow-sm">
                    <div class="text-sm font-bold text-on-surface-variant uppercase tracking-[0.2em]">Aspirasi Masuk</div>
                    <div class="text-5xl font-black text-primary tracking-tighter">{{ number_format($total) }}</div>
                    <div class="h-1 w-12 bg-primary-fixed"></div>
                </div>
                <!-- Stat Card 2 -->
                <div class="bg-surface-container-lowest p-10 rounded-full flex flex-col items-center text-center space-y-4 shadow-sm border-2 border-primary-fixed/20">
                    <div class="text-sm font-bold text-on-surface-variant uppercase tracking-[0.2em]">Sedang Diproses</div>
                    <div class="text-5xl font-black text-primary tracking-tighter">{{ number_format($terverifikasi) }}</div>
                    <div class="h-1 w-12 bg-primary-fixed"></div>
                </div>
                <!-- Stat Card 3 -->
                <div class="bg-surface-container-lowest p-10 rounded-full flex flex-col items-center text-center space-y-4 shadow-sm">
                    <div class="text-sm font-bold text-on-surface-variant uppercase tracking-[0.2em]">Selesai / Tuntas</div>
                    <div class="text-5xl font-black text-primary tracking-tighter">{{ number_format($selesai) }}</div>
                    <div class="h-1 w-12 bg-primary-fixed"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section - Asymmetric Editorial Layout -->
    <section class="py-32 bg-surface">
        <div class="max-w-7xl mx-auto px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-20 gap-8">
                <div class="max-w-2xl">
                    <span class="text-primary font-bold tracking-[0.3em] uppercase text-xs mb-4 block">Alur Kerja</span>
                    <h2 class="text-4xl md:text-5xl font-black text-on-surface tracking-tight">Bagaimana Malimo <br/>Bekerja Untuk Anda?</h2>
                </div>
                <div class="hidden md:block h-[2px] flex-grow bg-outline-variant/30 mx-12 mb-4"></div>
                <div class="text-on-surface-variant font-medium text-sm">3 Langkah Strategis</div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
                <!-- Step 1 -->
                <div class="group">
                    <div class="text-8xl font-black text-surface-container-high group-hover:text-primary-fixed transition-colors duration-500 mb-[-1.5rem] ml-[-0.5rem] select-none">01</div>
                    <div class="relative bg-white p-8 rounded-xl shadow-sm border-l-4 border-primary">
                       
                        <h3 class="text-xl font-bold text-on-surface mb-3">Tulis Aduan</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed">Ceritakan masalah atau ide Anda lewat formulir digital. Jangan lupa lampirkan foto agar tim kami bisa langsung melihat kondisinya.</p>
                    </div>
                </div>
                <!-- Step 2 -->
                <div class="group mt-8 lg:mt-12">
                    <div class="text-8xl font-black text-surface-container-high group-hover:text-primary-fixed transition-colors duration-500 mb-[-1.5rem] ml-[-0.5rem] select-none">02</div>
                    <div class="relative bg-white p-8 rounded-xl shadow-sm border-l-4 border-primary">
                        <h3 class="text-xl font-bold text-on-surface mb-3">Proses Kerja</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed">Tim Kelurahan akan memverifikasi dan meneruskan laporan Anda ke pihak terkait untuk segera ditindaklanjuti di lapangan.</p>
                    </div>
                </div>
                <!-- Step 3 -->
                <div class="group mt-16 lg:mt-24">
                    <div class="text-8xl font-black text-surface-container-high group-hover:text-primary-fixed transition-colors duration-500 mb-[-1.5rem] ml-[-0.5rem] select-none">03</div>
                    <div class="relative bg-white p-8 rounded-xl shadow-sm border-l-4 border-primary">
                        <h3 class="text-xl font-bold text-on-surface mb-3">Selesai</h3>
                        <p class="text-on-surface-variant text-sm leading-relaxed">Pantau terus progresnya. Begitu keluhan tuntas, Anda akan mendapat kabar dan bisa memberikan penilaian atas pelayanan kami.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section - Gradient Soul -->
    <section class="max-w-7xl mx-auto px-8 mb-24">
        <div class="rounded-[3rem] bg-gradient-to-br from-primary to-primary-container p-12 md:p-24 text-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuD5ysi0yM0PLHWAaItAQG0j1cTUxOBjQSE6HVRFaUol8JWaPIIJDbDgcIWG_RQj5O50m3f1n9mFoqQzNkG3zUTDuhKeR1sKEYJiZ43gZO87V-vEWtMzxXT9UyT-zgysFhqK7OdtqfxvAOjByvqMR1LPDTujx6IX-CJd-6W9hlIebEL9tXIRtPBnTx8gfW8MMGp3nygHKuOnWA2Mb6ZKwKHEoaX5cXg0zglqyhBueyNeegqbEQNerpXkulJcb9TrGwXqWuEofS8BPWke');"></div>
            <h2 class="text-3xl md:text-5xl font-black text-white mb-8 relative z-10">Ada yang Perlu Kami Perbaiki <br/>di Lingkungan Anda?</h2>
            <a href="{{ auth()->check() ? route('users.pengaduan.create') : route('login') }}" class="bg-white text-primary px-10 py-5 rounded-full font-black text-xl shadow-2xl hover:scale-105 active:scale-95 transition-all relative z-10 inline-block">
                Mulai Melapor Sekarang
            </a>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="bg-slate-50 dark:bg-slate-950 w-full py-12 border-t-0">
    <div class="max-w-7xl mx-auto px-8 flex flex-col md:flex-row justify-between items-center space-y-8 md:space-y-0">
        <div class="flex flex-col items-center md:items-start space-y-4">
            <div class="font-bold text-blue-900 dark:text-white text-lg font-headline">Malimo Report</div>
            <div class="text-slate-400 font-public-sans text-xs">© {{ date('Y') }} Malimongan Official. All rights reserved.</div>
        </div>
        <div class="flex space-x-8">
            <a class="text-slate-400 hover:text-blue-600 transition-colors text-xs font-medium" href="#">Kebijakan Privasi</a>
            <a class="text-slate-400 hover:text-blue-600 transition-colors text-xs font-medium" href="#">Syarat & Ketentuan</a>
            <a class="text-slate-400 hover:text-blue-600 transition-colors text-xs font-medium" href="#">Aksesibilitas</a>
            <a class="text-slate-400 hover:text-blue-600 transition-colors text-xs font-medium" href="#">Hubungi Kami</a>
        </div>
        <div class="flex space-x-4">
            <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center">
            </div>
            <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center">
            </div>
        </div>
    </div>
</footer>
</body>
</html>

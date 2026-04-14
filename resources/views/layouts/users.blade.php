<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Malimo Report') }} - Panel Warga</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, .font-public-sans { font-family: 'Public Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f7f9fb] text-[#191c1e] antialiased">
    <!-- SideNavBar -->
    <aside class="h-screen w-64 fixed left-0 top-0 border-r border-slate-200 bg-white flex flex-col p-4 space-y-2 z-40 transition-all duration-300 transform md:translate-x-0 -translate-x-full" id="userSidebar">
        <div class="mb-8 px-4 pt-4 flex items-center gap-3">
            <div class="w-10 h-10 shrink-0 bg-indigo-600 rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-7 h-7 object-contain brightness-0 invert">
            </div>
            <div>
                <h1 class="text-lg font-black text-indigo-900 leading-none">MALIMO</h1>
                <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-1">Aspiration Hub</p>
            </div>
        </div>
        
        <nav class="flex-1 space-y-1">
            <a href="{{ route('users.dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('users.dashboard') ? 'bg-indigo-50 text-indigo-900 font-bold shadow-sm border border-indigo-100' : 'text-slate-500 hover:bg-slate-50 hover:translate-x-1' }}">
                <span class="material-symbols-outlined text-xl">dashboard</span>
                <span class="text-sm">Dashboard</span>
            </a>

            <a href="{{ route('users.pengaduan.index') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 {{ request()->routeIs('users.pengaduan.*') ? 'bg-indigo-50 text-indigo-900 font-bold shadow-sm border border-indigo-100' : 'text-slate-500 hover:bg-slate-50 hover:translate-x-1' }}">
                <span class="material-symbols-outlined text-xl">chat_bubble</span>
                <span class="text-sm">Aspirasi Saya</span>
            </a>

            <div class="pt-6 pb-2 px-4 uppercase text-[10px] font-black text-slate-400 tracking-widest">Layanan</div>
            
            <a href="{{ route('users.pengaduan.create') }}" 
               class="flex items-center gap-3 px-4 py-3 bg-indigo-600 text-white rounded-xl shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-95 font-bold mb-4">
                <span class="material-symbols-outlined text-xl">add_circle</span>
                <span class="text-sm">Kirim Aspirasi Baru</span>
            </a>
        </nav>

        <div class="pt-4 mt-4 border-t border-slate-100">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-500 font-bold text-sm hover:bg-red-50 rounded-xl transition-all">
                    <span class="material-symbols-outlined text-xl">logout</span>
                    Keluar Akun
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay Mobile -->
    <div class="fixed inset-0 bg-black/20 backdrop-blur-sm z-30 hidden md:hidden" id="userSidebarOverlay"></div>

    <!-- Main Content Area -->
    <main class="md:ml-64 p-4 md:p-8 min-h-screen">
        <!-- Header -->
        <header class="flex justify-between items-center mb-10">
            <div class="flex items-center gap-4">
                <button class="md:hidden p-2 text-indigo-900 bg-white rounded-lg shadow-sm border border-slate-100" id="userSidebarToggle">
                    <span class="material-symbols-outlined">menu_open</span>
                </button>
                <div>
                    <span class="text-indigo-600 font-black text-[10px] uppercase tracking-widest mb-0.5 block">Resident Portal</span>
                    <h2 class="text-2xl md:text-3xl font-black text-[#191c1e] tracking-tight">Pusat Aspirasi Warga</h2>
                </div>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-black text-[#191c1e]">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">Warga Terdaftar</p>
                </div>
                <div class="w-10 h-10 rounded-xl overflow-hidden bg-white border border-slate-200 shadow-sm flex items-center justify-center font-black text-indigo-600">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </header>

        <!-- Dynamic Content -->
        <div class="max-w-7xl mx-auto">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="mt-20 pt-8 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4 pb-12">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">© 2024 Malimo Report. Layanan Pengaduan Malimongan.</p>
            <div class="flex gap-6 uppercase text-[10px] font-black text-slate-400 tracking-widest">
                <a href="#" class="hover:text-indigo-600 transition-colors">Panduan</a>
                <a href="#" class="hover:text-indigo-600 transition-colors">Kebijakan Privasi</a>
            </div>
        </footer>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggle = document.getElementById('userSidebarToggle');
            const sidebar = document.getElementById('userSidebar');
            const overlay = document.getElementById('userSidebarOverlay');

            if (toggle) {
                toggle.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                    overlay.classList.toggle('hidden');
                });
            }

            if (overlay) {
                overlay.addEventListener('click', () => {
                    sidebar.classList.add('-translate-x-full');
                    overlay.classList.add('hidden');
                });
            }
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Malimo Report') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;600;700;800;900&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet"/>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4 { font-family: 'Public Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#f7f9fb] text-[#191c1e] antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="mb-8 flex flex-col items-center">
            <a href="/" class="flex flex-col items-center gap-3 group">
                <div class="w-16 h-16 bg-indigo-600 rounded-[2rem] flex items-center justify-center shadow-2xl shadow-indigo-200 transition-transform group-hover:scale-105 duration-300">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain brightness-0 invert">
                </div>
                <div class="text-center mt-2">
                    <h1 class="text-2xl font-black text-indigo-900 tracking-tight">MALIMO REPORT</h1>
                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.3em]">Sovereign Service</p>
                </div>
            </a>
        </div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-slate-100 overflow-hidden sm:rounded-[2.5rem]">
            {{ $slot }}
        </div>

        <div class="mt-8 text-[10px] font-bold text-slate-300 uppercase tracking-widest">
            © 2024 Malimongan Aspiration Hub
        </div>
    </div>
</body>
</html>

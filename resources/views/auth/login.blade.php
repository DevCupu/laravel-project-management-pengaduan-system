<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @if (session('status'))
        <div class="alert alert-info border-none bg-blue-50 text-blue-700 rounded-xl p-4 mb-6 text-sm font-bold">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-10 text-center">
        <h2 class="text-3xl font-black text-[#191c1e] tracking-tight mb-2">Selamat Datang</h2>
        <p class="text-sm text-slate-500 font-medium">Masuk untuk mengawal aspirasi Anda demi Malimongan yang lebih baik.</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Alamat Email</label>
            <x-text-input id="email" class="block w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl p-4 text-sm font-medium" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-2 px-1">
                <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-[10px] font-black text-indigo-600 hover:text-indigo-800 uppercase tracking-widest"
                        href="{{ route('password.request') }}">
                        Lupa?
                    </a>
                @endif
            </div>

            <x-text-input id="password" class="block w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl p-4 text-sm font-medium" type="password" name="password" required
                autocomplete="current-password" placeholder="••••••••" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center px-1">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="w-4 h-4 rounded border-slate-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember">
                <span class="ms-3 text-xs font-bold text-slate-500 uppercase tracking-widest">{{ __('Ingat saya') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-2xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-[0.98] uppercase text-xs tracking-widest">
                Masuk ke Panel
            </button>
        </div>
        
        <div class="text-center pt-4">
            <p class="text-xs text-slate-400 font-medium">Belum terdaftar sebagai warga? 
                <a href="{{ route('register') }}" class="text-indigo-600 font-black hover:underline uppercase tracking-widest ml-1">Buat Akun</a>
            </p>
        </div>
    </form>
</x-guest-layout>

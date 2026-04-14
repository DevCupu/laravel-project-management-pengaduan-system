<x-guest-layout>
    <div class="mb-8 text-center">
        <h2 class="text-2xl font-black text-primary tracking-tight">Daftar Akun Baru</h2>
        <p class="text-sm text-on-surface-variant">Mari bergabung untuk Malimongan yang lebih baik</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Nama Lengkap</label>
            <x-text-input id="name" class="block w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl p-4 text-sm font-medium" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Nama sesuai KTP" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Alamat Email</label>
            <x-text-input id="email" class="block w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl p-4 text-sm font-medium" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Kata Sandi</label>
            <x-text-input id="password" class="block w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl p-4 text-sm font-medium" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2 px-1">Konfirmasi Kata Sandi</label>
            <x-text-input id="password_confirmation" class="block w-full border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 rounded-2xl p-4 text-sm font-medium" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi kata sandi" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="pt-4">
            <button type="submit" class="w-full bg-indigo-600 text-white font-black py-4 rounded-2xl shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-[0.98] uppercase text-xs tracking-widest">
                Daftar Sekarang
            </button>
        </div>

        <div class="text-center pt-4">
            <p class="text-xs text-slate-400 font-medium">Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-indigo-600 font-black hover:underline uppercase tracking-widest ml-1">Masuk</a>
            </p>
        </div>
    </form>
</x-guest-layout>

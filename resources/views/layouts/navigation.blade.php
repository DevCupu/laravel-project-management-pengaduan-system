<nav 
    x-data="{ open: false, darkMode: localStorage.getItem('theme') === 'dark' }"
    x-init="$watch('darkMode', val => { 
        localStorage.setItem('theme', val ? 'dark' : 'light'); 
        document.documentElement.classList.toggle('dark', val); 
    }); 
    document.documentElement.classList.toggle('dark', darkMode);"
    :class="{'dark': darkMode}"
    class="backdrop-blur-md bg-white/70 dark:bg-gray-900/70 border-b border-gray-200 dark:border-gray-700 shadow-sm transition-colors duration-500"
>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-indigo-600 dark:text-indigo-300 drop-shadow-lg transition-colors duration-500" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="relative group">
                        <span class="transition-colors duration-300 group-hover:text-indigo-600 ">
                            Beranda Saya
                        </span>
                        <span class="absolute left-0 -bottom-1 w-0 h-0.5 bg-indigo-500 transition-all duration-300"></span>
                    </x-nav-link>
                </div>
            </div>

            <!-- Dark Mode Toggle Button -->
            <div class="flex items-center me-4">
                <button 
                    @click="darkMode = !darkMode"
                    class="p-2 rounded-full transition-all duration-300 bg-gray-200/80 dark:bg-gray-700/80 text-gray-700 dark:text-gray-200 hover:scale-110 hover:bg-indigo-100 dark:hover:bg-indigo-700 shadow-md"
                    :aria-label="darkMode ? 'Switch to light mode' : 'Switch to dark mode'"
                >
                    <template x-if="!darkMode">
                        <svg class="w-6 h-6 transition-all duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 3v1m0 16v1m8.66-13.66l-.71.71M4.05 19.07l-.71.71M21 12h-1M4 12H3m16.66 6.66l-.71-.71M4.05 4.93l-.71-.71" stroke-linecap="round" stroke-linejoin="round"/>
                            <circle cx="12" cy="12" r="5" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </template>
                    <template x-if="darkMode">
                        <svg class="w-6 h-6 transition-all duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 12.79A9 9 0 1111.21 3a7 7 0 109.79 9.79z" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </template>
                </button>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-700 dark:text-gray-200 bg-white/80 dark:bg-gray-800/80 hover:text-indigo-600 dark:hover:text-indigo-400 shadow transition-all duration-300">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profil Pengguna
                        </x-dropdown-link>
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Keluar Sesi
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-indigo-100 dark:hover:bg-indigo-900 focus:outline-none focus:bg-indigo-100 dark:focus:bg-indigo-900 focus:text-indigo-600 dark:focus:text-indigo-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-300">
                Beranda Saya
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-300">
                    Profil Pengguna
                </x-responsive-nav-link>
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="hover:text-red-600 dark:hover:text-red-400 transition-colors duration-300">
                        Keluar Sesi
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

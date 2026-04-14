@extends('layouts.admin')

@section('content')
    <div class="container mx-auto py-8 px-4">
        <div class="flex flex-col sm:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-black text-gray-900 leading-tight">Verifikasi Akun Warga</h1>
                <p class="text-sm text-gray-500 mt-1">Lakukan validasi NIK (Nomor Induk Kependudukan) untuk menjamin keabsahan identitas pelapor.</p>
            </div>
            <span class="inline-flex items-center px-5 py-2.5 rounded-xl bg-indigo-50 text-indigo-700 font-bold border border-indigo-100 shadow-sm text-xs uppercase tracking-widest">
                Total Pendaftar: {{ $users->total() ?? $users->count() }} Orang
            </span>
        </div>

        <form method="GET" action="{{ route('admin.users.index') }}" class="mb-6 inline-flex flex-wrap items-center gap-3 bg-white p-4 rounded-2xl shadow-sm border border-slate-100">
            <label for="filter" class="text-slate-600 font-bold text-xs uppercase tracking-wider">Status Validasi:</label>
            <select id="filter" name="filter" onchange="this.form.submit()"
                class="block w-56 px-4 py-2.5 rounded-xl border border-slate-200 bg-slate-50 text-gray-900 font-semibold focus:outline-none focus:ring-2 focus:ring-indigo-500 transition text-sm">
                <option value="">Semua Pendaftar</option>
                <option value="verified" {{ request('filter') === 'verified' ? 'selected' : '' }}>Sudah Divalidasi</option>
                <option value="unverified" {{ request('filter') === 'unverified' ? 'selected' : '' }}>Butuh Validasi Segera</option>
            </select>
        </form>

        @if (session('success'))
            <div class="flex items-center bg-green-50 border border-green-200 text-green-800 px-5 py-4 rounded-2xl mb-6 relative shadow-sm"
                role="alert">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
                <span class="font-bold text-sm">{{ session('success') }}</span>
                <button type="button" class="absolute top-4 right-4 text-green-700 hover:text-green-900"
                    data-dismiss="alert" aria-label="Tutup">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        <div class="bg-white shadow-sm border border-slate-100 rounded-3xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">No</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Identitas Pendaftar</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Email Pendaftaran</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Nomor NIK</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black text-slate-400 uppercase tracking-widest">Status Data</th>
                            <th class="px-6 py-4 text-center text-[10px] font-black text-slate-400 uppercase tracking-widest">Tindakan Khusus</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100">
                        @forelse ($users as $index => $user)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 align-middle text-slate-500 font-medium">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 align-middle">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-12 h-12 rounded-2xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-black text-lg mr-4 border border-indigo-200">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="font-black text-gray-900 text-base">{{ $user->name }}</div>
                                            <div class="text-xs text-slate-500 flex items-center gap-1 mt-0.5 font-semibold">
                                                Daftar: {{ $user->created_at->format('d M Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-middle text-slate-600">
                                    <div class="flex items-center gap-2 font-medium">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" stroke-width="2"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0zm0 0v1a4 4 0 01-8 0v-1"></path>
                                        </svg>
                                        {{ $user->email }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    <span class="inline-block bg-slate-100 text-slate-800 text-sm px-3 py-1.5 rounded-lg font-mono font-bold tracking-widest border border-slate-200">{{ $user->nik }}</span>
                                </td>
                                <td class="px-6 py-4 align-middle">
                                    @if ($user->is_verified)
                                        <span class="inline-flex items-center px-4 py-2 rounded-xl bg-green-50 text-green-700 border border-green-200 text-xs font-black uppercase tracking-widest gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            Valid
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-4 py-2 rounded-xl bg-red-50 text-red-700 border border-red-200 text-xs font-black uppercase tracking-widest gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Blokir / Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 align-middle text-center">
                                    @if ($user->is_verified)
                                        <form action="{{ route('admin.users.unverify', $user) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin MENCABUT validasi warga ini? Mereka tidak akan bisa membuat laporan lagi.')" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 rounded-xl bg-amber-50 text-amber-700 border border-amber-200 text-xs font-black uppercase tracking-widest gap-2 hover:bg-amber-100 transition active:scale-95">
                                                Tangguhkan
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.users.verify', $user) }}" method="POST"
                                            onsubmit="return confirm('Silakan pastikan NIK sesuai sebelum melakukan validasi. Lanjutkan?')" class="inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="inline-flex items-center px-4 py-2 rounded-xl bg-indigo-600 text-white shadow-lg shadow-indigo-200 text-xs font-black uppercase tracking-widest gap-2 hover:bg-indigo-700 transition active:scale-95">
                                                Validasi Akun
                                            </button>
                                        </form>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-16 bg-slate-50">
                                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white shadow-sm mb-4 border border-slate-100">
                                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87M16 3.13a4 4 0 010 7.75M8 3.13a4 4 0 000 7.75"></path>
                                        </svg>
                                    </div>
                                    <p class="text-slate-500 font-bold text-base">Belum ada akun warga yang terdaftar.</p>
                                    <p class="text-slate-400 text-sm mt-1">Data warga yang mendaftar akan muncul di halaman ini.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($users->hasPages())
            <div class="px-6 py-4 bg-white border-t border-slate-100">
                {{ $users->withQueryString()->links() }}
            </div>
            @endif
        </div>
    </div>

    @push('styles')
        <style>
            /* Custom animation for shake */
            @keyframes shake {

                10%,
                90% {
                    transform: translateX(-1px);
                }

                20%,
                80% {
                    transform: translateX(2px);
                }

                30%,
                50%,
                70% {
                    transform: translateX(-4px);
                }

                40%,
                60% {
                    transform: translateX(4px);
                }
            }

            .animate-shake {
                animation: shake 0.8s cubic-bezier(.36, .07, .19, .97) both;
            }
        </style>
    @endpush
@endsection

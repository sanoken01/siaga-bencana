@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="container mx-auto px-4 max-w-2xl">
        <!-- Breadcrumb -->
        <nav class="mb-8 flex items-center gap-2 text-sm font-medium text-slate-500">
            <a href="{{ route('admin.dashboard') }}" class="transition hover:text-blue-600">Dashboard</a>
            <i class="fa-solid fa-chevron-right text-[10px]"></i>
            <span class="text-slate-900">Edit Pengguna</span>
        </nav>

        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-slate-200/50">
            <div class="flex items-center gap-6 border-b border-slate-100 bg-slate-50/50 px-8 py-6">
                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-200">
                    <i class="fa-solid fa-user-pen text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900">Edit Pengguna</h1>
                    <p class="text-sm font-medium text-slate-500">Perbarui informasi akun relawan atau admin.</p>
                </div>
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-8 space-y-6">
                @csrf
                @method('PUT')

                <div class="group space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-blue-600">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ $user->name }}" required class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                </div>

                <div class="group space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-blue-600">Alamat Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" required class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                </div>

                <div class="group space-y-2">
                    <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-blue-600">Role / Hak Akses</label>
                    <select name="role" required class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10">
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User / Relawan</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>

                <div class="border-t border-slate-50 pt-6">
                    <p class="text-xs font-medium text-slate-400 mb-4 italic">Biarkan kosong jika tidak ingin mengubah password.</p>
                    <div class="grid gap-6 sm:grid-cols-2">
                        <div class="group space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-blue-600">Password Baru</label>
                            <input type="password" name="password" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10" placeholder="Min. 8 karakter">
                        </div>

                        <div class="group space-y-2">
                            <label class="text-xs font-bold uppercase tracking-widest text-slate-400 transition group-focus-within:text-blue-600">Konfirmasi</label>
                            <input type="password" name="password_confirmation" class="w-full rounded-2xl border-slate-200 bg-slate-50 px-4 py-3 font-medium transition focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-500/10" placeholder="Ulangi password">
                        </div>
                    </div>
                </div>

                <div class="mt-10 flex items-center justify-end gap-4 border-t border-slate-100 pt-8">
                    <a href="{{ route('admin.dashboard') }}" class="rounded-2xl px-8 py-3.5 text-sm font-bold text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">Batal</a>
                    <button type="submit" class="rounded-2xl bg-slate-900 px-10 py-3.5 text-sm font-bold text-white shadow-xl shadow-slate-200 transition hover:bg-slate-800 active:scale-95">
                        Update Pengguna
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

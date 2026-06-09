@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-sky-50 via-cyan-50 to-blue-100 py-12">
    <div class="container mx-auto max-w-2xl px-4">
        <a href="{{ route('admin.dashboard', ['tab' => 'users']) }}" class="mb-5 inline-flex items-center gap-2 rounded-full border border-sky-200 bg-white/85 px-4 py-2 text-sm font-semibold text-sky-800 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>

        <div class="overflow-hidden rounded-[28px] border border-white/70 bg-white shadow-[0_28px_70px_rgba(14,116,144,0.14)]">
            <div class="bg-gradient-to-r from-sky-600 via-blue-600 to-indigo-700 px-8 py-7 text-white">
                <p class="text-xs font-semibold uppercase tracking-[0.3em] text-sky-100">Admin Panel</p>
                <h1 class="mt-2 text-2xl font-bold">Edit User</h1>
                <p class="mt-1 text-sm text-sky-100">Perbarui identitas dan hak akses pengguna.</p>
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6 p-8">
                @csrf
                @method('PUT')

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500" placeholder="Masukkan nama lengkap">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500" placeholder="email@contoh.com">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Role / Hak Akses</label>
                    <select name="role" required class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500">
                        <option value="user" @selected(old('role', $user->role) === 'user')>User / Relawan</option>
                        <option value="admin" @selected(old('role', $user->role) === 'admin')>Administrator</option>
                    </select>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Password Baru</label>
                        <input type="password" name="password" class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500" placeholder="Kosongkan jika tidak diubah">
                    </div>

                    <div class="space-y-2">
                        <label class="text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-cyan-500" placeholder="Ulangi password baru">
                    </div>
                </div>

                <div class="rounded-2xl border border-sky-100 bg-sky-50/70 px-4 py-3 text-sm text-sky-900">
                    <i class="fa-solid fa-circle-info mr-2"></i>
                    Password hanya perlu diisi jika ingin mengganti akun ini.
                </div>

                <div class="flex flex-wrap items-center justify-end gap-3 pt-2">
                    <a href="{{ route('admin.dashboard', ['tab' => 'users']) }}" class="rounded-xl border border-slate-200 bg-white px-5 py-2.5 font-semibold text-slate-600 transition hover:bg-slate-50">Batal</a>
                    <button type="submit" class="rounded-xl bg-gradient-to-r from-sky-600 to-blue-700 px-5 py-2.5 font-bold text-white shadow-lg shadow-sky-200 transition hover:scale-[1.01]">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
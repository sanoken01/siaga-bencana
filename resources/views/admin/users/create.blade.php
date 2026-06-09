@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 py-12">
    <div class="container mx-auto px-4 max-w-md">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6">
                <h1 class="text-2xl font-bold text-white">Tambah User Baru</h1>
                <p class="text-blue-100 text-sm mt-1">Buat akun relawan atau admin baru.</p>
            </div>

            <form action="{{ route('admin.users.store') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Nama Lengkap</label>
                    <input type="text" name="name" required class="w-full rounded-xl border-slate-200 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan nama lengkap">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Alamat Email</label>
                    <input type="email" name="email" required class="w-full rounded-xl border-slate-200 focus:ring-blue-500 focus:border-blue-500" placeholder="email@contoh.com">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Role / Hak Akses</label>
                    <select name="role" required class="w-full rounded-xl border-slate-200 focus:ring-blue-500 focus:border-blue-500">
                        <option value="user">User / Relawan</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Password</label>
                    <input type="password" name="password" required class="w-full rounded-xl border-slate-200 focus:ring-blue-500 focus:border-blue-500" placeholder="Minimal 8 karakter">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-semibold text-slate-700">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required class="w-full rounded-xl border-slate-200 focus:ring-blue-500 focus:border-blue-500" placeholder="Ulangi password">
                </div>

                <div class="flex items-center justify-end gap-4 pt-4">
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2.5 rounded-xl border border-slate-200 text-slate-600 font-semibold hover:bg-slate-50 transition">Batal</a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition">Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

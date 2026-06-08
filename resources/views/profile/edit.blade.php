<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya | Siaga Bencana</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .gradient-bg { background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%); }
        .card-shadow { box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05); }
    </style>
</head>
<body class="gradient-bg min-h-screen">
    <div class="max-w-4xl mx-auto px-4 py-12">
        <!-- Back Link -->
        <div class="mb-8">
            <a href="{{ url('/') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition">
                <i class="fa-solid fa-arrow-left mr-2"></i> Kembali ke Beranda
            </a>
        </div>

        @if (session('status'))
            <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-2xl flex items-center shadow-sm">
                <i class="fa-solid fa-circle-check mr-3 text-lg"></i>
                <span class="font-medium">
                    {{ session('status') === 'profile-updated' ? 'Profil berhasil diperbarui!' : session('status') }}
                </span>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Sidebar Info -->
            <div class="md:col-span-1 space-y-6">
                <div class="bg-white p-8 rounded-3xl card-shadow text-center">
                    <div class="relative inline-block mb-4">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-32 h-32 rounded-full border-4 border-blue-50 shadow-md object-cover">
                        @else
                            <div class="w-32 h-32 rounded-full bg-blue-100 border-4 border-blue-50 shadow-md flex items-center justify-center text-blue-500 text-4xl font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="absolute bottom-1 right-1 bg-green-500 w-6 h-6 rounded-full border-4 border-white"></div>
                    </div>
                    <h2 class="text-xl font-bold text-slate-800">{{ $user->name }}</h2>
                    <p class="text-sm text-slate-500 mb-4">{{ $user->email }}</p>
                    <span class="inline-block px-4 py-1.5 bg-blue-50 text-blue-600 text-xs font-bold rounded-full uppercase tracking-wider">
                        {{ $user->role === 'admin' ? 'Administrator' : 'Relawan' }}
                    </span>
                </div>

                <div class="bg-white p-6 rounded-3xl card-shadow">
                    <h3 class="text-sm font-bold text-slate-400 uppercase tracking-widest mb-4">Statistik Saya</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-slate-600">
                                <i class="fa-solid fa-file-invoice text-blue-500 mr-3 w-5"></i>
                                <span class="text-sm font-medium">Laporan</span>
                            </div>
                            <span class="text-sm font-bold text-slate-800">{{ $user->reports->count() }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center text-slate-600">
                                <i class="fa-solid fa-hand-holding-heart text-rose-500 mr-3 w-5"></i>
                                <span class="text-sm font-medium">Donasi</span>
                            </div>
                            <span class="text-sm font-bold text-slate-800">{{ \App\Models\Donation::where('email', $user->email)->count() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="md:col-span-2 space-y-8">
                <!-- Update Profile -->
                <div class="bg-white p-8 rounded-3xl card-shadow">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center text-white mr-4 shadow-lg shadow-blue-200">
                            <i class="fa-solid fa-user-pen"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Informasi Profil</h3>
                            <p class="text-xs text-slate-500">Perbarui informasi dasar akun Anda.</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                        @csrf
                        @method('patch')

                        <div>
                            <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-50 focus:border-blue-400 transition outline-none text-slate-800" required>
                            @if($errors->has('name'))
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $errors->first('name') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-50 focus:border-blue-400 transition outline-none text-slate-800" required>
                            @if($errors->has('email'))
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $errors->first('email') }}</p>
                            @endif
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-blue-200 transition transform hover:-translate-y-0.5 active:scale-95">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Update Password (Hanya jika bukan login via Google) -->
                @if(!$user->google_id)
                <div class="bg-white p-8 rounded-3xl card-shadow">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center text-white mr-4 shadow-lg shadow-slate-200">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Keamanan</h3>
                            <p class="text-xs text-slate-500">Pastikan akun Anda menggunakan password yang kuat.</p>
                        </div>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        @method('put')

                        <div>
                            <label for="current_password" class="block text-sm font-bold text-slate-700 mb-2">Password Saat Ini</label>
                            <input type="password" id="current_password" name="current_password" 
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-50 focus:border-blue-400 transition outline-none text-slate-800">
                            @if($errors->updatePassword->has('current_password'))
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $errors->updatePassword->first('current_password') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Password Baru</label>
                            <input type="password" id="password" name="password" 
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-50 focus:border-blue-400 transition outline-none text-slate-800">
                            @if($errors->updatePassword->has('password'))
                                <p class="mt-1 text-xs text-red-500 font-medium">{{ $errors->updatePassword->first('password') }}</p>
                            @endif
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" 
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:ring-4 focus:ring-blue-50 focus:border-blue-400 transition outline-none text-slate-800">
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white px-8 py-3 rounded-xl font-bold shadow-lg shadow-slate-200 transition transform hover:-translate-y-0.5 active:scale-95">
                                Ganti Password
                            </button>
                        </div>
                    </form>
                </div>
                @else
                <div class="bg-blue-50 p-6 rounded-3xl border border-blue-100 flex items-start">
                    <i class="fa-solid fa-circle-info text-blue-500 mt-1 mr-4 text-xl"></i>
                    <div>
                        <h4 class="font-bold text-blue-900 mb-1">Login via Google</h4>
                        <p class="text-sm text-blue-700 leading-relaxed">Akun Anda terhubung dengan Google. Anda tidak perlu mengelola password di sini demi alasan keamanan.</p>
                    </div>
                </div>
                @endif

                <!-- Danger Zone -->
                <div class="bg-red-50 p-8 rounded-3xl border border-red-100">
                    <h3 class="text-lg font-bold text-red-800 mb-2">Hapus Akun</h3>
                    <p class="text-sm text-red-600 mb-6">Sekali Anda menghapus akun, semua data laporan dan informasi lainnya akan dihapus secara permanen.</p>
                    
                    <button type="button" onclick="confirmDelete()" class="text-red-700 font-bold hover:text-red-900 transition flex items-center">
                        <i class="fa-solid fa-trash-can mr-2"></i> Hapus Akun Saya Permanen
                    </button>

                    <form id="delete-form" method="post" action="{{ route('profile.destroy') }}" class="hidden">
                        @csrf
                        @method('delete')
                        <input type="password" name="password" value="placeholder_not_used_for_google">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    @if($user->google_id)
                        document.getElementById('delete-form').submit();
                    @else
                        Swal.fire({
                            title: 'Konfirmasi Password',
                            input: 'password',
                            inputLabel: 'Masukkan password Anda untuk konfirmasi',
                            inputPlaceholder: 'Password Anda',
                            inputAttributes: {
                                autocapitalize: 'off',
                                autocorrect: 'off'
                            },
                            showCancelButton: true,
                            confirmButtonText: 'Konfirmasi Hapus',
                            confirmButtonColor: '#dc2626',
                        }).then((pwResult) => {
                            if (pwResult.value) {
                                const form = document.getElementById('delete-form');
                                form.querySelector('input[name="password"]').value = pwResult.value;
                                form.submit();
                            }
                        });
                    @endif
                }
            })
        }
    </script>
</body>
</html>

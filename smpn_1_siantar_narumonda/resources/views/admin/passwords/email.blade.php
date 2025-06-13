<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lupa Password Admin - SMP N 1 Siantar Narumonda</title>

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />

    {{-- Tailwind CSS --}}
    <link rel="stylesheet" href="{{ asset('admin/css/tailwind.output.css') }}">

    {{-- Alpine.js --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    {{-- Init Alpine --}}
    <script src="{{ asset('admin/js/init-alpine.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 dark:bg-gray-900">

    {{-- Ini untuk menampilkan pesan sukses dari session --}}
    @if (session('status'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('status') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    {{-- Ini untuk menampilkan pesan error validasi (jika ada) --}}
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Mengirim Tautan',
                text: "{{ $errors->first() }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <div class="flex items-center min-h-screen p-6">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                {{-- Gambar (opsional, bisa disesuaikan atau dihilangkan jika tidak relevan) --}}
                <div class="h-32 md:h-auto md:w-1/2">
                    <img
                        aria-hidden="true"
                        class="object-cover w-full h-full dark:hidden"
                        src="{{ asset('admin/img/login-office.jpeg') }}"
                        alt="Office"
                    />
                    <img
                        aria-hidden="true"
                        class="hidden object-cover w-full h-full dark:block"
                        src="{{ asset('admin/img/login-office-dark.jpeg') }}"
                        alt="Office"
                    />
                </div>
                {{-- Konten Utama Form --}}
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            {{ __('Lupa Password Admin') }}
                        </h1>

                        <form method="POST" action="{{ route('admin.password.email') }}">
                            @csrf

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">{{ __('Alamat Email') }}</span>
                                <input id="email" type="email" class="form-input w-full mt-1 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email@example.com">
                                @error('email')
                                    <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                                @enderror
                            </label>

                            <button
                                type="submit"
                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700"
                            >
                                {{ __('Kirim Tautan Reset Password') }}
                            </button>
                        </form>

                        {{-- Tautan kembali ke halaman login --}}
                        <p class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                            <a
                                class="font-medium text-purple-600 hover:underline"
                                href="{{ route('admin.login') }}"
                            >
                                Kembali ke halaman login
                            </a>
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Admin SMP N 1 Siantar Narumonda</title>

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

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: "{{ $errors->first() }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <div class="flex items-center min-h-screen p-6">
        <div class="flex-1 h-full max-w-4xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
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
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-xl font-semibold text-gray-700 dark:text-gray-200">
                            Login Admin
                        </h1>

                        {{-- Login Form --}}
                        <form method="POST" action="{{ route('admin.login.submit') }}">
                            @csrf
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email</span>
                                <input name="email" type="email" class="form-input w-full mt-1" placeholder="email@example.com" />
                            </label>

                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Password</span>
                                <input name="password" type="password" class="form-input w-full mt-1" placeholder="********" />
                            </label>

                            <button
                                type="submit"
                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg hover:bg-purple-700"
                            >
                                Log in
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

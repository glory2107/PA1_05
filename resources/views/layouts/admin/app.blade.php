<!DOCTYPE html>
<html lang="en" x-data="data()" :class="{ 'theme-dark': dark }">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Admin Dashboard')</title>

  <!-- Fonts and styles -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('admin/css/tailwind.output.css') }}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" />

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{ asset('admin/js/init-alpine.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
  <script src="{{ asset('admin/js/charts-lines.js') }}" defer></script>
  <script src="{{ asset('admin/js/charts-pie.js') }}" defer></script>
</head>
<body>

  <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
    
    {{-- Sidebar --}}
    @include('layouts.admin.sidebar')

    {{-- Content area --}}
    <div class="flex flex-col flex-1 w-full">

      {{-- Navbar --}}
      @include('layouts.admin.navbar')

      {{-- Main Content --}}
      <main class="h-full overflow-y-auto">
        <div class="container px-6 mx-auto grid">
          @yield('content')
        </div>
      </main>

    </div>
  </div>

</body>
</html>

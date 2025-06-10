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

  <!-- FontAwesome CDN (Sudah ada) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-dPYY56KW3kylqv6Mq2OJ2b+r6bmtKkkZ8O4X2x3ODmvxXzLvXrvTZax40M4kdeFQ6h7yI9NeVz9eOq9GqG7r3Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery harus sebelum Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
  <script src="{{ asset('admin/js/init-alpine.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script>
  <script src="{{ asset('admin/js/charts-lines.js') }}" defer></script>
  <script src="{{ asset('admin/js/charts-pie.js') }}" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

  {{-- Inisialisasi Select2 --}}
  <script>
    $(document).ready(function () {
      if($('#icon').length) {
        $('#icon').select2({
          templateResult: function(option) {
            if (!option.id) return option.text;
            var iconClass = $(option.element).data('icon');
            if(iconClass) {
              return $('<span><i class="' + iconClass + '" style="margin-right:8px;"></i>' + option.text + '</span>');
            }
            return option.text;
          },
          templateSelection: function(option) {
            if (!option.id) return option.text;
            var iconClass = $(option.element).data('icon');
            if(iconClass) {
              return $('<span><i class="' + iconClass + '" style="margin-right:8px;"></i>' + option.text + '</span>');
            }
            return option.text;
          },
          escapeMarkup: function(m) { return m; }
        });

        $('#icon').on('change', function() {
          var iconClass = $(this).find('option:selected').data('icon');
          var preview = document.getElementById('iconPreview');
          if(iconClass && preview) {
            preview.innerHTML = '<i class="' + iconClass + '"></i>';
          } else if(preview) {
            preview.innerHTML = '';
          }
        });

        $('#icon').trigger('change');
      }
    });
  </script>

</body>
</html>

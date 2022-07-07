<!doctype html>
<html lang="en">
  @include('components.frontend.head')
  @stack('styles')
  <body>
    <!-- Preloader Start -->
    {{-- <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center me-sm-5 me-md-0">
            <img src="{{ asset('images/logo.png') }}" alt="">
        </div>
    </div> --}}
    <!-- Preloader End -->
    @yield('content')
    @include('components.frontend.navbar-bottom')
    @include('components.frontend.scripts')
    <script>
        BASE_URL="{{ asset('') }}"
    </script>
    @stack('scripts')
  </body>
</html>

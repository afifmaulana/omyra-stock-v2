<!doctype html>
<html lang="en">
  @include('components.frontend.head')
  @stack('styles')
  <body>
    @yield('content')
    @include('components.frontend.navbar-bottom')
    @include('components.frontend.scripts')
    @stack('scripts')
  </body>
</html>

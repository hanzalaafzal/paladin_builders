<!DOCTYPE html>
<html lang="en" dir="ltr">
  @include('panel.includes.head')
  <body>
    <div id="main-wrapper">
      @include('panel.includes.header')
      @include('panel.includes.navbar')
      @yield('content')

    </div>
    @include('panel.includes.js')
    @stack('customjs')
  </body>
</html>

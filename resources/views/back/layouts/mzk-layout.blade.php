
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>@yield('pageTitle')</title>
    <!-- CSS files -->
    <link href="/back/mzk/dist/css/tabler.min.css" rel="stylesheet"/>
    <link href="/back/mzk/dist/css/tabler-flags.min.css" rel="stylesheet"/>
    <link href="/back/mzk/dist/css/tabler-payments.min.css" rel="stylesheet"/>
    <link href="/back/mzk/dist/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="/back/mzk/dist/css/demo.min.css" rel="stylesheet"/>
    @stack('stylesheets')
    <style>
      @import url('https://rsms.me/inter/inter.css');
      :root {
      	--tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
      }
      body {
      	font-feature-settings: "cv03", "cv04", "cv11";
      }
    </style>
  </head>
  <body  class=" d-flex flex-column">
    <script src="/back/mzk/dist/js/demo-theme.min.js"></script>
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
          <a href="/" class="navbar-brand navbar-brand-autodark">
            <img src="/back/mzk/static/akili_logo.png" width="110" height="32" alt="Tabler" class="navbar-brand-image">
          </a>
        </div>

        @yield('content')

        {{-- <div class="text-center text-secondary mt-3">
          Don't have account yet? <a href="./sign-up.html" tabindex="-1">Sign up</a>
        </div> --}}
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="/back/mzk/dist/js/tabler.min.js" defer></script>
    <script src="/back/mzk/dist/js/demo.min.js" defer></script>
    @stack('scripts')
  </body>
</html>
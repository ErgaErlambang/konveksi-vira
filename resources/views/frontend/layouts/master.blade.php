<!-- README ( demo purpose ):
    Made with Love from RocketAce
    Customize bootstraps 4 + BLK and requirement from client.
    getintouch with me : ergaaer@gmail.com
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <!-- Change this to your logo icon
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    -->

    <title>
        @yield('title') - Convection Fashion
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--   Fonts and icons  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/frontend/css/nucleo-icons.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('assets/frontend/css/font-awesome.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/css/argon-design-system.css?v=1.0.3') }}" rel="stylesheet" />
    <link href="{{ asset('assets/frontend/css/styles.css') }}" rel="stylesheet" />
    @stack('styles')

</head>
<body class="ecommerce-page">
    @include('frontend.layouts.header')
    <div class="wrapper">
        @yield('content')
        @include('frontend.layouts.footer')
    </div>
</body>

  <!--   Core JS Files   -->
  <script src="{{ asset('assets/frontend/js/core/jquery.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/core/popper.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
  <script src="{{ asset('assets/frontend/js/argon-design-system.min.js?v=1.0.3') }}" type="text/javascript"></script>
  <script src="{{ asset('assets/frontend/js/scripts.js') }}" type="text/javascript"></script>
  @stack('scripts')
</html>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Template</title>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap@5.0.2_dist_css_bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


    <!-- bootstrap js -->
    <script src="{{ asset('assets/js/bootstrap@5.0.2_dist_js_bootstrap.bundle.min.js') }}"></script>
    <style>
        .sorting-links a{
            color: #fff;
            text-decoration: none;
            margin-right: 10px;
        }
        img.hover-image{
            display: none;
            position: absolute;
            z-index: 9;
        }
        td:hover .hover-image{
            display: block;
        }
    </style>
</head>
  <body>

    @yield('content')

    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {{-- {!! Toastr::message() !!} --}}
    <script>
        @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @elseif(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @elseif(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
        @elseif(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
        @endif
    </script>
  </body>
</html>

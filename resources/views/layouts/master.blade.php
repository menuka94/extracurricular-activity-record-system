<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap.min.css') }}">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{ url('bootstrap/css/bootstrap-theme.min.css') }}">
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap-theme.min.css">--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/4.0.2/bootstrap-material-design.css">--}}
    <link rel="stylesheet" href="{{ url('css/simple-sidebar.css') }}">

    <title>@yield('title')</title>

    <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>

</head>
<body>

@include('layouts.navbar')

<div id="wrapper" class="toggled">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            {{--<li class="sidebar-brand">--}}
                {{--<a href="#">--}}
                   {{--ECAM--}}
                {{--</a>--}}
            {{--</li>--}}
            <li>
                <a href="{{ route('welcome') }}">Home</a>
            </li>
            <li>
                <a href="{{ route('admin.index') }}">Admin Control</a>
            </li>
            <li>
                <a href="#">Events</a>
            </li>
        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Sidebar</a>

                    <div class="container" style="padding: 20px">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>


@stack('scripts')
<div> @yield('begin_body')</div>

</body>
</html>
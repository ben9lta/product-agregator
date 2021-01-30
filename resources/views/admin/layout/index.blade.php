<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Админ панель</title>

    <!-- Bootstrap core CSS-->
    <link href="{{ asset('admin_assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Main styles -->
    <link href="{{ asset('admin_assets/css/admin.css')}}" rel="stylesheet">
    <!-- Icon fonts-->
    <link href="{{ asset('admin_assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div class="fixed-nav sticky-footer" id="page-top">

    <header>
        <nav class="navbar navbar-light bg-light justify-content-between">
            <a class="navbar-brand">{{env('APP_NAME')}}</a>
            <a class="nav-link form-inline" href="#" onclick="$('#logout').submit()" >Выйти</a>
            <form id="logout" method="post" action="{{route('logout')}}" hidden>
                @csrf
            </form>
        </nav>
    </header>

    <div class="main">
        <div class="sidebar">
            @yield('sidebar')
        </div>

        <div class="content">
            @yield('content')
        </div>

    </div>
</div>

<footer class="sticky-footer">
    <div class="container">
        <div class="text-center">
            <small>Copyright © {{env('APP_NAME') . ' ' . date("Y")}}</small>
        </div>
    </div>
</footer>

<script src="{{ asset('admin_assets/js/jquery.min.js')}}"></script>
<script src="{{ asset('admin_assets/js/popper.min.js')}}"></script>
<script src="{{ asset('admin_assets/js/bootstrap.min.js')}}"></script>
</body>
</html>

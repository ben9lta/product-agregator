<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS-->
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/icons.min.css')}}" rel="stylesheet">
    <!-- Main styles -->
    <link href="{{ asset('css/app.css')}}" rel="stylesheet">
    <link href="{{ asset('css/main.css')}}" rel="stylesheet">
    <!-- Icon fonts-->
    <link href="{{ asset('css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
</head>
<body>
<div id="root"></div>
<script>
    window.user = @json(auth()->user() ?? null)
</script>
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/popper.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
<script src="{{ asset('js/app.js')}}" type="text/javascript"></script>
</body>
</html>

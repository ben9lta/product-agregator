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
<div class="fixed-nav sticky-footer" id="page-top">

    @include('layouts.header')

    <div class="main">
        @yield('content')
    </div>

    <footer class="sticky-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Покупателям</h2>
                    <ul>
                        <li><a href="#">Как заказывать</a></li>
                        <li><a href="#">Доставка и оплата</a></li>
                        <li><a href="#">Возврат товара</a></li>
                        <li><a href="#">Пользовательское соглашение</a></li>
                        <li><a href="#">Согласие на обработку персональных данных</a></li>
                        <li><a href="#">Личный кабинет</a></li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <h2>О нас</h2>
                    <ul>
                        <li><a href="#">Контакты</a></li>
                    </ul>
                </div>
            </div>
            <div class="text-center">
                Copyright © {{env('APP_NAME') . ' ' . date("Y")}}
            </div>
        </div>
    </footer>
</div>



<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/popper.min.js')}}"></script>
<script src="{{ asset('js/bootstrap.min.js')}}"></script>
</body>
</html>

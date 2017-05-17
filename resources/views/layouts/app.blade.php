<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">--}}
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">--}}

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-theme.min.css') }}" rel="stylesheet">
    {{--<link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/commercialBanner.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/userMenu.css') }}" rel="stylesheet">
    <link href="{{ asset('css/productDetail.css') }}" rel="stylesheet">
    <link href="{{ asset('lightbox2/css/lightbox.css') }}" rel="stylesheet" >
    <link href="{{ asset('css/info.css') }}" rel="stylesheet">
    <link href="{{ asset('css/contacts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/products.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    @if(strpos( $_SERVER['REQUEST_URI'], 'admin' ) !== false)
        <link href="{{ asset('css/adminMain.css') }}" rel="stylesheet">
        <link href="{{ asset('css/adminMenu.css') }}" rel="stylesheet">
        <link href="{{ asset('css/image.css') }}" rel="stylesheet">
    @endif

    <!-- Scripts -->
    {{--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>--}}
    <script src="{{ asset('js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <style type="text/css">@font-face {font-family: 'taurus'; src: url('{{ asset('fonts/Neucha.ttf') }}');}</style>
    <style type="text/css">@font-face {font-family: 'Roboto-Medium'; src: url('{{ asset('fonts/Roboto-Medium.ttf') }}');}</style>
    <style type="text/css">@font-face {font-family: 'Roboto-Regular'; src: url('{{ asset('fonts/Roboto-Regular.ttf') }}');}</style>
    <style type="text/css">@font-face {font-family: 'Roboto-Bold'; src: url('{{ asset('fonts/Roboto-Bold.ttf') }}');}</style>
    <style type="text/css">@font-face {font-family: 'Roboto-Italic'; src: url('{{ asset('fonts/Roboto-Italic.ttf') }}');}</style>
</head>
<body>
    <div id="app" class="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container headContainer">
                <div class="navbar-header">

                    <div class="col-md-3 col-sm-3 headSiteName">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                    <div class="col-md-4 col-sm-4 headContacts">
                        <div class="col-md-12">Контакты:</div>
                        <div class="col-md-12 text-right">+7(707)2510220</div>
                        <div class="col-md-12 text-right">+7(701)2366000</div>
                    </div>
                    <div class="col-md-4 col-sm-4 headEmail">
                        <div class="col-md-12">Email:</div>
                        <div class="col-md-12 text-right headEmail">v.meshko1986@gmail.com</div>
                    </div>
                    <div class="col-md-1 col-sm-1"></div>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <ul class="nav navbar-nav navbar-left">
                        &nbsp;
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li class="headAuth"><a href="{{ url('/login') }}">Авторизация</a></li>
                            <li class="headReg"><a href="{{ url('/register') }}">Регистрация</a></li>
                        @else
                            @if(Auth::user()->role_id == 2)
                                <li class="headAdmin"><a href="{{ url('/admin/category') }}">Админка</a></li>
                            @endif
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Выход
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
        @yield('content')
        <br><br>
        <div class="footterUpContainer">
            <div class="container footerContainer">
                <footer>
                    <div id="back-top"><a href="#top"><i class="fa fa-arrow-circle-up fa-4x" aria-hidden="true"></i></a></div>
                    <p>&copy;<a href="http://palki.kz/">"Спорт товары". Астана (Казахстан) 2017 год.</a></p>
                </footer>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    {{--<script src="{{ asset('js/app.js') }}"></script>--}}
    <script src="{{ asset('js/home.js') }}"></script>
    <!-- Fonts -->
    <style type="text/css">@font-face {font-family:nav-font; src: url('{{ asset('fonts/glyphicons-halflings-regular.woff') }}');}</style>
    <style type="text/css">@font-face {font-family:nav-font; src: url('{{ asset('fonts/glyphicons-halflings-regular.woff2') }}');}</style>
    <style type="text/css">@font-face {font-family:nav-font; src: url('{{ asset('fonts/glyphicons-halflings-regular.ttf') }}');}</style>
</body>
</html>

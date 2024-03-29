<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Controle Financeiro</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"           rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"               rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/responsive/2.2.5/css/responsive.dataTables.min.css"  rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('style')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

</head>
<body style="background-color:rgb(240, 240, 240)">
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    Controle Financeiro
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if(Auth::user())
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('revenue.index')}}">Receitas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('expense.index')}}">Despesas</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Cadastros
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li>
                                    <a class="dropdown-item" aria-current="page" href="{{route('revenue_type.index')}}">Tipos de Receitas</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" aria-current="page" href="{{route('revenue_sub_type.index')}}">Subtipos de Receitas</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" aria-current="page" href="{{route('expense_type.index')}}">Tipos de Despesas</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" aria-current="page" href="{{route('expense_sub_type.index')}}">Subtipo de Despesas</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="">
            @yield('content')
        </main>
    </div>

    <!--Scripts-->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha256-Kg2zTcFO9LXOc7IwcBx1YeUBJmekycsnTsq2RuFHSZU=" crossorigin="anonymous"></script> --}}
    {{-- <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"              type="text/javascript"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"       type="text/javascript"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.1/chart.min.js" integrity="sha512-ymysWHuTOgC1h8/MdSMcEyWmmjtfSh/7PYIDCZYIjW9sfS5Lfs5VBGbkPYZSM11L+JzJ3+id+gXDF4ImKcnxgA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('scripts')
</body>
</html>

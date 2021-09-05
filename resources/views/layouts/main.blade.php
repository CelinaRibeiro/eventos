<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    {{--Font google--}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    {{--CSS Bootstrap--}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">


    {{--CSS da aplicaação--}}
    <link rel="stylesheet" href="/css/style.css" />
    <script src="/js/script.js"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbar">
                    <a href="/" class="navbar-brand"> Divulga Eventos</a>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="/" class="nav-link active">Eventos</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('event.create') }}" class="nav-link active">Criar Eventos</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('dashboard')}}" class="nav-link">Meus Eventos</a>
                            </li>
                            <li class="nav-item">
                                <form action="/logout" method="post">
                                @csrf
                                <a href="/logout" 
                                    class="nav-link" 
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                    Sair</a>
                                </form>
                            </li>
                        @endauth
                        @guest
                            <li class="nav-item">
                                <a href="/login" class="nav-link active">Entrar</a>
                            </li>
                            <li class="nav-item">
                                <a href="/register" class="nav-link active">Cadastrar</a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success" role="alert">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </header>

    @yield('content')
    
    <footer>
        <p> 
            &copy; 2021 - Todos os direitos reservados Divulga Eventos <br/> 
            Desenvolvido por: Celina Ferreira Ribeiro
        </p>
    </footer>

     {{--JS Bootstrap--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
     
    {{--Icons--}}
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

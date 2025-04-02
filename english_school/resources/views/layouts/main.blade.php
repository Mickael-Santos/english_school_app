<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts Google-->

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
       
        <!-- Styles / Scripts -->
        <link rel="stylesheet" href="/css/main.css">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    </head>
    <body>
        <header>
            <nav>
                <div class="nav-container">
                    <div class="nav-logo-container">
                        <img src="/img/english-book-vetor.png" alt="">
                    </div>
                    <ul class="nav-list">
                        @auth
                            <li><a href="/">Usuários</a></li>
                            <li><a href="/">Alunos</a></li>
                            <li><a href="/">Turmas</a></li>
                            <li><a href="/tutors">Tutores</a></li>
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger" id="exit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                                          <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
                                          <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
                                        </svg>
                                    </button>
                                </form>
                            </li>
                        @endauth
                        
                        @guest
                            <li><a href="/">Entrar</a></li>
                            <li><a href="/">Cadastrar</a></li>
                        @endguest
                        
                        
                    </ul>
                </div> 
            </nav>
        </header>
        <main>
            <div>
                @if(session('msg'))
                    <div class="alert alert-success" role="alert">
                        {{ session('msg') }}
                    </div>
                @endif
            </div>
            <div class="container-fluid content-container">
                @yield('content')
            </div>
        </main>
        <footer>

        </footer>
        <script src="/js/main.js"></script>
    </body>
        
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.ts'])


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <a class="navbar-brand" href="{{ route('authors.index') }}">
                   Authors
                </a>
                <a class="navbar-brand" href="{{ route('subjects.index')  }}">
                    Subjects
                </a>
                <a class="navbar-brand" href="{{ route('books.index') }}">
                    Books
                </a>
                <a class="navbar-brand" href="javascript:void(0);" onclick="generateReport('{{ route('generate-pdf') }}')">
                    Report
                </a>
                <div id="toast" style="
                        position: fixed;
                        top: 20px; /* Alinha no topo */
                        right: 20px; /* Alinha à direita */
                        background-color: #444;
                        color: white;
                        padding: 10px 20px;
                        border-radius: 5px;
                        display: none;
                        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                        z-index: 1000;
                        font-size: 14px;
                    ">
                </div>

                <div id="generating-message" style="display: none; margin-top: 10px;" class="alert alert-info" role="alert">
                    O relatório está sendo gerado...
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

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

        <script>
            function generateReport(route) {
                showToast('Relatório sendo gerado...');

                axios.get(route);
            }
            function showToast(message) {
                const toast = document.getElementById('toast');
                toast.textContent = message;
                toast.style.display = 'block'; // Exibe o toast

                // Remove o toast após 1 segundo
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 1000);
            }

        </script>



        <main class="py-4">
            @yield('content')
        </main>
        @yield('scripts') <!-- Inclui scripts adicionais -->

    </div>
</body>
</html>

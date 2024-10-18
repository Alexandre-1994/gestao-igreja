<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gestão de Membros da Igreja</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            {{-- <img src="img/download.png" alt=""> --}}
            {{-- <img src="{{ asset('/img/123.svg') }}" alt="Descrição da Imagem"> --}}
            {{-- <div class="head">
                <a class="navbar-brand" href="{{ url('/') }}">Igreja de Cristo Unida Em Mocambique </a>
                <span style="color: white">Ex-Missao American Board</span>
            </div> --}}

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('membros.index') }}">Dashbord</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('membros.create') }}">Gestao Membro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('financial.index') }}">Gestao Financeira</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container mt-4">
        @yield('content')
    </main>
    <div class="jumbotron text-center my-5">
        <h1 class="display-4">Bem-vindo ao Sistema de Gestão de Membros</h1>
        <p class="lead">Gerencie facilmente os membros da sua igreja com nosso sistema intuitivo e eficiente.</p>
        <hr class="my-4">
        <p>Comece agora mesmo a cadastrar novos membros ou visualize os membros existentes.</p>
        <a class="btn btn-primary btn-lg" href="{{ route('membros.create') }}" role="button">Cadastrar Novo Membro</a>
        <a class="btn btn-secondary btn-lg" href="{{ route('membros.index') }}" role="button">Ver Membros</a>
    </div>
    <footer class="mt-5 py-3 text-center">
        <div class="container">
            <span class="text-muted">© 2024 Gestão de Membros da Igreja. Todos os direitos reservados.</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

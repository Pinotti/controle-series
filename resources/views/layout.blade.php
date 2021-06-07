<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/7989db13d4.js" crossorigin="anonymous"></script>
    <title>Controle de Séries</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between">
        <a href="{{ route('listar_series') }}" class="navbar-brand">Home</a>
        @auth
        <a href="/sair" class="text-danger">Sair</a>
        @endauth

        @guest
        <a href="/entrar">Entrar</a>
        @endguest
    </nav>
    <div class="container">
        <div class="jumbotron">
            <h1>@yield('cabecalho')</h1>
        </div>

        @yield('conteudo')
    </div>
</body>
</html>
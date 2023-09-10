<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Power Bank</title>
    <link rel="stylesheet" type="text/css" href="/assets/css/cb.css">
    <script defer src="/assets/js/app.js"></script>
</head>

<body>

    <header class="header">
        <h1 class="h1">
            <a href="/gestion" class="a">Power Bank</a>
        </h1>
        <button class="button">
            <svg class="svg" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </button>

        <nav class="nav">
            <ul class="ul">
                <li class="li"><a href="/gestion" class="a">{{ $titulo }}</a></li>
                @foreach ($navigation as $navelem)
                <li class="li"><a class="nav-link" href="{{ $navelem[0] }}">{{ $navelem[1] }}</a></li>
                @endforeach
            </ul>
        </nav>
    </header>
    <section>
        @yield('contenido')
    </section>
</body>

</html>
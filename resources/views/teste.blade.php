<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Cube Saúde')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body>

    @include('layouts.navbar') {{-- se você tiver um menu --}}
    
    <div class="container">
        @yield('content') {{-- Aqui vai o conteúdo das páginas --}}
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>
</html>

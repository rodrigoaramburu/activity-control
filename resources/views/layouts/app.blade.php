<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Controle de Atividades | @yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
    <livewire:styles />
</head>

<body class="bg-gray-800">

    <div class="mx-auto overflow-hidden mt-10 shadow-lg mb-2 bg-gray-900 border-4 rounded-lg container border-gray-400">
        
        <header>
            <h1 class="p-5 text-yellow-500 text-center text-3xl bg-gray-900 ">Controle de Atividades </h1>
        </header>
        <main class="p-2">
            @yield('content')
        </main>
        
    </div>

    <livewire:scripts />
</body>

</html>
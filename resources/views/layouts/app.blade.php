<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <script src="https://kit.fontawesome.com/44c66588f6.js" crossorigin="anonymous"></script>

    <!-- Scripts -->
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-cover bg-center bg-no-repeat bg-fixed min-h-screen"
      style="background-image: url('{{ Vite::image('bg.jpg') }}');">
<div class="min-h-full">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="dark:bg-gray-800 dark:bg-opacity-60 dark:backdrop-blur-sm dark:shadow">
            <div class="max-w-7xl mx-auto py-4 px-4">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>

</div>
@include('sweetalert::alert')
@livewireScripts
<script>
    var uploadImgUrl = '{{route('store.image')}}';
</script>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full" data-theme="halloween">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>RepRec</title>

    <!-- Fonts, Icons, Styles, etc. -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    @vite(entrypoints: ['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full">
    <div class="flex flex-col justify-center items-center m-10">
        <h1 class="text-xl font-bold m-2">{{ $heading }}</h1>
        <div class="w-full">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
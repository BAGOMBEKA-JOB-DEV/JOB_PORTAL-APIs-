<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{{ asset('fav.jpg') }}" type="image/jpg">
        
        <title>SMS</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="antialiased" data-bs-theme="dark">
        <div id="app"></div>
    </body>
</html>

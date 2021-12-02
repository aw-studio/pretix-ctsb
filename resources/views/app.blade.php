<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ mix('/js/app.js') }}" defer></script>
    </head>
    <body class=" bg-gradient-to-tr from-blue-400 to-blue-300">
        @inertia
        <div class="fixed bottom-0 w-screen h-2 -mb-1 bg-white"></div>
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <script src="{{ mix('/js/app.js') }}" defer></script>
        @if (array_key_exists('style', $page['props']))
        <style>
            :root {
                --primary-100: {{ $page['props']['style']['primary'][100] ?: '#ecf4ff' }};
                --primary-200: {{ $page['props']['style']['primary'][200] ?: '#d2d9f5' }};
                --primary-300: {{ $page['props']['style']['primary'][300] ?: '#6098ff' }};
                --primary-400: {{ $page['props']['style']['primary'][400] ?: '#5732a3' }};
                --primary-500: {{ $page['props']['style']['primary'][500] ?: '#4444af' }};
                --primary-600: {{ $page['props']['style']['primary'][600] ?: '#232378' }};
                --primary-DEFAULT: {{ $page['props']['style']['primary']['DEFAULT'] ?: '#4444af' }};
                
                --secondary-500: {{ $page['props']['style']['secondary'][500] ?: '#fba200' }};
                --secondary-DEFAULT: {{ $page['props']['style']['secondary']['DEFAULT'] ?: '#fba200' }};
                
                --success-500: {{ $page['props']['style']['success'][500] ?: '#03D079' }};
                --success-DEFAULT: {{ $page['props']['style']['success']['DEFAULT'] ?: '#03D079' }};
                
                --danger-500: {{ $page['props']['style']['danger'][500] ?: '#FF3265'}};
                --danger-DEFAULT: {{ $page['props']['style']['danger']['DEFAULT'] ?: '#FF3265'}};
            }
            @if (array_key_exists('font', $page['props']['style']))
            body{
                font-family: '{{ $page['props']['style']['font'] ?: 'Inter' }}' !important;
            }
            @endif
        </style>
        @endif
    </head>
    <body class=" bg-gradient-to-tr from-blue-400 to-blue-300">
        @inertia
        <div class="fixed bottom-0 w-screen h-2 -mb-1 bg-white"></div>
        @translations('localization')
    </body>
</html>
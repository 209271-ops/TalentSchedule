<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Portal RH') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased min-h-screen bg-gradient-to-br from-[#40526b] via-[#334257] to-[#1f2937] relative flex flex-col justify-center items-center">
        
        <div class="w-full sm:max-w-md px-6 z-10">
            {{ $slot }}
        </div>

        <div class="absolute bottom-6 w-full text-center text-xs text-gray-300/60 font-light">
            HR Gestão & ATS | Plataforma de RH Integrada | Copyright &copy; {{ date('Y') }} Sua Empresa
        </div>
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Portal RH') }} - Painel</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-[#0f172a] text-slate-200">
        <div class="min-h-screen flex flex-col">
            
            {{-- Barra de Navegação Superior Integrada ao Tema --}}
            <nav class="bg-[#161f38] border-b border-slate-800 shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-indigo-600 rounded-lg shadow-md shadow-indigo-500/20">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <span class="text-lg font-bold tracking-wider text-white">Portal RH</span>
                        </div>

                        {{-- Lado Direito: Usuário e Sair --}}
                        <div class="flex items-center gap-4">
                            <span class="text-sm font-medium text-slate-400 hidden sm:inline">
                                {{ Auth::user()->name }}
                            </span>
                            
                            <form method="POST" action="{{ route('logout') }}" class="m-0">
                                @csrf
                                <button type="submit" class="text-xs bg-[#201e43] hover:bg-[#2b295c] border border-slate-700 text-slate-300 font-semibold px-3 py-1.5 rounded-lg transition-colors">
                                    Sair
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Cabeçalho da Página (Dinâmico) --}}
            @if (isset($header))
                <header class="bg-[#111930] border-b border-slate-800/60 shadow-sm">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            {{-- Conteúdo Principal --}}
            <main class="flex-1 max-w-7xl w-full mx-auto py-8 px-4 sm:px-6 lg:px-8">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vaga: {{ $vacancy->title }} - Trabalhe Conosco</title>
    
    {{-- Carrega o Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50 selection:bg-indigo-500 selection:text-white">
    
    {{-- Barra de Navegação Pública (Minimalista) --}}
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <svg class="h-8 w-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-bold text-xl text-gray-800 tracking-wide">Meu RH</span>
                </div>
                <div>
                    <span class="text-sm text-gray-500 font-medium px-3 py-1 bg-gray-100 rounded-full border border-gray-200">
                        Portal de Vagas
                    </span>
                </div>
            </div>
        </div>
    </nav>

    {{-- Área Principal --}}
    <div class="min-h-screen flex flex-col items-center pt-10 sm:pt-16 pb-12 px-4 sm:px-0">
        
        {{-- Cabeçalho da Vaga (Hero) --}}
        <div class="w-full max-w-3xl text-center mb-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold text-gray-900 mb-4 tracking-tight">
                Candidate-se para a vaga de <br/>
                <span class="text-indigo-600">{{ $vacancy->title }}</span>
            </h1>
            
            @if($vacancy->salary)
                <div class="mb-6 inline-flex items-center px-4 py-2 rounded-full bg-green-50 text-green-700 font-medium border border-green-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Salário: {{ $vacancy->salary }}
                </div>
            @endif

            @if($vacancy->description)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 text-left mb-8">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3">Sobre a vaga</h3>
                    <div class="text-gray-700 whitespace-pre-line leading-relaxed">
                        {{ $vacancy->description }}
                    </div>
                </div>
            @else
                <p class="text-lg text-gray-600">
                    Preencha o formulário abaixo com seus dados e escolha o melhor horário para conversarmos.
                </p>
            @endif
        </div>

        {{-- Cartão do Formulário --}}
        <div class="w-full max-w-xl">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                
                {{-- Título interno do Card --}}
                <div class="bg-indigo-50 px-8 py-5 border-b border-indigo-100 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <h2 class="text-lg font-bold text-indigo-800">
                        Ficha de Inscrição
                    </h2>
                </div>

                {{-- Mensagem de Sucesso --}}
                @if(session('success'))
                    <div class="mx-8 mt-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-800 text-center font-medium flex flex-col items-center gap-2">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Mensagens de Erro de Validação --}}
                @if ($errors->any())
                    <div class="mx-8 mt-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-800 text-sm font-medium">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Formulário --}}
                <form action="{{ route('interviews.store', $vacancy->id) }}" method="POST" class="px-8 py-8 space-y-6">
                    @csrf

                    <div>
                        <label for="candidate_name" class="block font-medium text-sm text-gray-700">Nome Completo</label>
                        <input type="text" id="candidate_name" name="candidate_name" value="{{ old('candidate_name') }}" required placeholder="Ex: João da Silva"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm py-2.5 px-3 transition">
                    </div>

                    <div>
                        <label for="candidate_email" class="block font-medium text-sm text-gray-700">E-mail Profissional</label>
                        <input type="email" id="candidate_email" name="candidate_email" value="{{ old('candidate_email') }}" required placeholder="Ex: joao@email.com"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm py-2.5 px-3 transition">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label for="phone" class="block font-medium text-sm text-gray-700">Telefone / WhatsApp</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Ex: (11) 99999-9999"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm py-2.5 px-3 transition">
                        </div>

                        <div>
                            <label for="linkedin" class="block font-medium text-sm text-gray-700">LinkedIn ou Portfólio <span class="text-gray-400 font-normal">(Opcional)</span></label>
                            <input type="text" id="linkedin" name="linkedin" value="{{ old('linkedin') }}" placeholder="Ex: linkedin.com/in/seuperfil"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm py-2.5 px-3 transition">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2 border-t border-gray-100 mt-6">
                        <div>
                            <label for="interview_date" class="block font-medium text-sm text-gray-700">Data de Preferência</label>
                            <input type="date" id="interview_date" name="interview_date" value="{{ old('interview_date') }}" required
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm py-2.5 px-3 text-gray-600 transition">
                        </div>

                        <div>
                            <label for="interview_time" class="block font-medium text-sm text-gray-700">Melhor Horário</label>
                            <input type="time" id="interview_time" name="interview_time" value="{{ old('interview_time') }}" required
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm py-2.5 px-3 text-gray-600 transition">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full flex justify-center items-center py-3.5 px-4 border border-transparent rounded-lg shadow-md text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out uppercase tracking-widest">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                            Enviar Candidatura 
                        </button>
                    </div>
                </form>

            </div>
            
            {{-- Rodapé --}}
            <div class="mt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} Meu RH. Todos os direitos reservados.</p>
            </div>
        </div>
    </div>
</body>
</html>
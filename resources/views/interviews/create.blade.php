<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vaga: {{ $vacancy->title }} - Trabalhe Conosco</title>
    
    {{-- Carrega o Tailwind CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-200 antialiased bg-[#0f172a] selection:bg-indigo-500 selection:text-white">
    
    {{-- Barra de Navegação Pública (Minimalista e Dark) --}}
    <nav class="bg-[#161f38] border-b border-slate-800/80 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                    <svg class="h-8 w-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-bold text-xl text-white tracking-wide">Meu RH</span>
                </div>
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-indigo-400 px-3 py-1.5 bg-indigo-500/10 rounded-full border border-indigo-500/20">
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
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-4 tracking-tight">
                Candidate-se para a vaga de <br/>
                <span class="text-indigo-400">{{ $vacancy->title }}</span>
            </h1>
            
            @if($vacancy->salary)
                <div class="mb-6 inline-flex items-center px-4 py-2 rounded-full bg-green-500/10 text-green-400 font-bold text-sm tracking-wider uppercase border border-green-500/20 shadow-inner">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Salário: {{ $vacancy->salary }}
                </div>
            @endif

            @if($vacancy->description)
                <div class="bg-[#161f38] p-6 rounded-2xl shadow-xl border border-slate-800/80 text-left mb-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-500/10 blur-2xl rounded-full pointer-events-none"></div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Sobre a vaga</h3>
                    <div class="text-slate-300 whitespace-pre-line leading-relaxed">
                        {{ $vacancy->description }}
                    </div>
                </div>
            @else
                <p class="text-lg text-slate-400">
                    Preencha o formulário abaixo com seus dados e escolha o melhor horário para conversarmos.
                </p>
            @endif
        </div>

        {{-- Cartão do Formulário --}}
        <div class="w-full max-w-xl">
            <div class="bg-[#161f38] overflow-hidden shadow-2xl sm:rounded-2xl border border-slate-800/80 relative">
                
                {{-- Efeito luminoso no card --}}
                <div class="absolute -top-24 -left-24 w-48 h-48 bg-indigo-500/10 blur-3xl rounded-full pointer-events-none"></div>

                @if($vacancy->status === 'closed')
                    <div class="p-10 text-center flex flex-col items-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-500/10 text-red-500 border border-red-500/20 mb-4 shadow-inner">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-white tracking-tight">Inscrições Encerradas</h2>
                        <p class="text-slate-400 mt-2 text-sm max-w-sm leading-relaxed">
                            Infelizmente, não estamos mais recebendo inscrições para esta oportunidade no momento.
                        </p>
                    </div>
                @else
                    {{-- Título interno do Card --}}
                    <div class="bg-indigo-500/10 px-8 py-5 border-b border-indigo-500/20 flex items-center gap-3">
                        <svg class="w-6 h-6 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <h2 class="text-lg font-bold text-indigo-400 tracking-wide">
                            Ficha de Inscrição
                        </h2>
                    </div>

                    {{-- Mensagem de Sucesso --}}
                    @if(session('success'))
                        <div class="mx-8 mt-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 text-center font-bold flex flex-col items-center gap-2 shadow-inner">
                            <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Mensagens de Erro de Validação --}}
                    @if ($errors->any())
                        <div class="mx-8 mt-6 p-4 rounded-xl bg-red-500/10 border border-red-500/20 text-red-400 text-sm font-medium shadow-inner">
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
                            <label for="candidate_name" class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">Nome Completo</label>
                            <input type="text" id="candidate_name" name="candidate_name" value="{{ old('candidate_name') }}" required placeholder="Ex: João da Silva"
                                class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-200 placeholder-slate-600 transition-all outline-none">
                        </div>

                        <div>
                            <label for="candidate_email" class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">E-mail Profissional</label>
                            <input type="email" id="candidate_email" name="candidate_email" value="{{ old('candidate_email') }}" required placeholder="Ex: joao@email.com"
                                class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-200 placeholder-slate-600 transition-all outline-none">
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="phone" class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">Telefone / WhatsApp</label>
                                <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required placeholder="Ex: (11) 99999-9999"
                                    class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-200 placeholder-slate-600 transition-all outline-none">
                            </div>

                            <div>
                                <label for="linkedin" class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">LinkedIn / Portfólio <span class="text-slate-600 font-normal">(Opcional)</span></label>
                                <input type="text" id="linkedin" name="linkedin" value="{{ old('linkedin') }}" placeholder="Ex: linkedin.com/in/seuperfil"
                                    class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-200 placeholder-slate-600 transition-all outline-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-6 border-t border-slate-800/80 mt-6">
                            <div>
                                <label for="interview_date" class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">Data de Preferência</label>
                                <input type="date" id="interview_date" name="interview_date" value="{{ old('interview_date') }}" required
                                    class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-200 outline-none transition-all [color-scheme:dark]">
                            </div>

                            <div>
                                <label for="interview_time" class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">Melhor Horário</label>
                                <input type="time" id="interview_time" name="interview_time" value="{{ old('interview_time') }}" required
                                    class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-200 outline-none transition-all [color-scheme:dark]">
                            </div>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full flex justify-center items-center py-4 px-4 rounded-xl shadow-lg shadow-indigo-500/20 text-sm font-extrabold text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-[#161f38] uppercase tracking-widest transition-all transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                                Enviar Candidatura 
                            </button>
                        </div>
                    </form>
                @endif
            </div>
            
            {{-- Rodapé --}}
            <div class="mt-8 text-center text-xs font-medium text-slate-600 uppercase tracking-widest">
                <p>&copy; {{ date('Y') }} Meu RH. Todos os direitos reservados.</p>
            </div>
        </div>
    </div>
</body>
</html>
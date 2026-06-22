<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 tracking-tight flex items-center gap-2">
                 Olá, {{ Auth::user()->name }}! 
                <span class="text-sm font-normal text-gray-500 ml-2 hidden sm:inline">Aqui está o resumo do seu RH hoje.</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 1. ALERTAS DE SUCESSO --}}
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- 2. PAINEL DE CONTROLE (DASHBOARD) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total de Vagas</p>
                        <p class="text-3xl font-bold text-gray-900 mt-1">{{ $totalVacancies ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 text-blue-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Vagas Ativas</p>
                        <p class="text-3xl font-bold text-green-600 mt-1">{{ $openVacancies ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-green-50 text-green-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total de Candidatos</p>
                        <p class="text-3xl font-bold text-indigo-600 mt-1">{{ $totalCandidates ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-indigo-50 text-indigo-600 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- 3. FORMULÁRIO DE CRIAR NOVA VAGA --}}
            <div class="bg-gradient-to-r from-indigo-50 to-blue-50 overflow-hidden shadow-sm sm:rounded-xl border border-indigo-100 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-indigo-600 rounded-lg text-white shadow-md">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Abrir Nova Vaga</h3>
                </div>
                
                <form action="{{ route('vacancies.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Título da Vaga</label>
                            <input type="text" name="title" required placeholder="Ex: Desenvolvedor Front-end Pleno..."
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm w-full py-2 px-3 text-gray-700">
                        </div>
                        <div class="w-full">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Salário (Opcional)</label>
                            <input type="text" name="salary" placeholder="Ex: R$ 5.000,00 ou A Combinar"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm w-full py-2 px-3 text-gray-700">
                        </div>
                    </div>

                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descrição da Vaga</label>
                        <textarea name="description" rows="4" placeholder="Descreva os requisitos, responsabilidades e benefícios da vaga..."
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-lg shadow-sm w-full py-2 px-3 text-gray-700"></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 bg-indigo-600 border border-transparent rounded-lg font-bold text-sm text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 shadow-md transition ease-in-out duration-150 whitespace-nowrap">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Publicar Vaga
                        </button>
                    </div>
                </form>
            </div>

            {{-- 4. LISTA DE VAGAS PUBLICADAS --}}
            <div class="mt-8">
                @if(isset($vacancies) && $vacancies->isEmpty())
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center border border-gray-200">
                        <p class="text-gray-500">Nenhuma vaga cadastrada ainda. Crie sua primeira vaga acima!</p>
                    </div>
                @elseif(isset($vacancies))
                    @foreach($vacancies as $vacancy)
                        <div class="mb-6 bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200">
                            
                            {{-- Cabeçalho da Vaga com Link e Ações --}}
                            <div class="bg-gray-50 border-b border-gray-200 px-6 py-4 flex flex-col sm:flex-row sm:items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-extrabold text-indigo-700 flex items-center gap-2">
                                         {{ $vacancy->title }}
                                    </h3>
                                    <div class="mt-2 flex flex-wrap items-center gap-3 text-sm">
                                        <span class="{{ $vacancy->status == 'open' ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }} px-2 py-0.5 rounded font-semibold text-xs border {{ $vacancy->status == 'open' ? 'border-green-200' : 'border-red-200' }}">
                                            {{ $vacancy->status == 'open' ? 'Aberta' : 'Fechada' }}
                                        </span>
                                        
                                        <a href="{{ route('interviews.create', $vacancy->id) }}" target="_blank" class="font-medium text-blue-600 hover:text-blue-800 transition flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                            Ver Página Pública
                                        </a>
                                        
                                        <button type="button" onclick="navigator.clipboard.writeText('{{ route('interviews.create', $vacancy->id) }}'); alert('Link copiado com sucesso! \nAgora é só colar no WhatsApp ou E-mail do candidato.')" class="text-gray-600 hover:text-gray-900 font-medium flex items-center cursor-pointer transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                                            Copiar Link
                                        </button>

                                        <span class="text-gray-300">|</span>

                                        <a href="{{ route('vacancies.edit', $vacancy->id) }}" class="text-amber-600 hover:text-amber-800 font-medium transition">Editar</a>
                                        
                                        <form action="{{ route('vacancies.destroy', $vacancy->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta vaga e todos os candidatos dela?');" class="inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0">
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold bg-indigo-100 text-indigo-800 shadow-sm border border-indigo-200">
                                        Total: {{ $vacancy->interviews->count() }} {{ $vacancy->interviews->count() == 1 ? 'Candidato' : 'Candidatos' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Lista de Candidatos Inscritos --}}
                            <div class="p-6">
                                @if($vacancy->interviews->isEmpty())
                                    <div class="text-center py-6 bg-gray-50 rounded-lg border border-dashed border-gray-300">
                                        <p class="text-gray-500 text-sm">Nenhum candidato inscrito para esta vaga ainda.</p>
                                        <p class="text-xs text-gray-400 mt-1">Copie o link acima e compartilhe para receber currículos!</p>
                                    </div>
                                @else
                                    <ul class="space-y-2">
                                        @foreach($vacancy->interviews as $interview)
                                            <li class="border border-gray-100 py-3 flex flex-col sm:flex-row sm:justify-between sm:items-center hover:bg-gray-50 transition duration-150 ease-in-out px-4 rounded-lg shadow-sm">
                                                
                                                {{-- Lado Esquerdo: Avatar e Dados do Candidato --}}
                                                <div class="flex items-center space-x-4 mb-3 sm:mb-0">
                                                    <div class="h-10 w-10 rounded-full bg-indigo-100 border border-indigo-200 flex items-center justify-center text-indigo-700 font-bold text-lg shadow-sm">
                                                        {{ strtoupper(substr($interview->candidate_name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <p class="font-bold text-gray-800 text-base">{{ $interview->candidate_name }}</p>
                                                        
                                                        <div class="flex flex-wrap items-center text-xs text-gray-500 mt-1 gap-y-2 gap-x-3">
                                                            {{-- E-mail --}}
                                                            <span class="flex items-center">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                                <a href="mailto:{{ $interview->candidate_email }}" class="hover:text-indigo-600 transition">{{ $interview->candidate_email }}</a>
                                                            </span>
                                                            
                                                            <span class="hidden sm:inline text-gray-300">|</span>
                                                            
                                                            {{-- Telefone/WhatsApp --}}
                                                            <span class="flex items-center text-gray-700 font-medium">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                                {{ $interview->phone }}
                                                            </span>
                                                        
                                                            {{-- LinkedIn (Aparece só se o candidato preencheu) --}}
                                                            @if($interview->linkedin)
                                                                <span class="hidden sm:inline text-gray-300">|</span>
                                                                <span class="flex items-center">
                                                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                                                    <a href="{{ $interview->linkedin }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition">Perfil / Portfólio</a>
                                                                </span>
                                                            @endif
                                                        
                                                            <span class="hidden sm:inline text-gray-300">|</span>
                                                            
                                                            {{-- Data e Hora --}}
                                                            <span class="flex items-center text-gray-600 font-medium bg-gray-100 px-2 py-0.5 rounded">
                                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                                {{ \Carbon\Carbon::parse($interview->interview_date)->format('d/m/Y') }} às {{ substr($interview->interview_time, 0, 5) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
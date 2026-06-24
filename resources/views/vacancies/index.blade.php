<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-white tracking-tight flex items-center gap-2">
                 Olá, {{ Auth::user()->name }}! 
                <span class="text-sm font-normal text-slate-400 ml-2 hidden sm:inline">Aqui está o resumo do seu RH hoje.</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- 1. ALERTAS DE SUCESSO --}}
            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-400 rounded-lg bg-green-500/10 border border-green-500/20 shadow-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- 2. PAINEL DE CONTROLE (DASHBOARD) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-[#161f38] p-6 rounded-2xl shadow-xl border border-slate-800/80 flex items-center justify-between hover:border-slate-700/60 transition-colors">
                    <div>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Total de Vagas</p>
                        <p class="text-3xl font-extrabold text-white mt-1">{{ $totalVacancies ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-xl shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-[#161f38] p-6 rounded-2xl shadow-xl border border-slate-800/80 flex items-center justify-between hover:border-slate-700/60 transition-colors">
                    <div>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Vagas Ativas</p>
                        <p class="text-3xl font-extrabold text-green-400 mt-1">{{ $openVacancies ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-green-500/10 text-green-400 border border-green-500/20 rounded-xl shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <div class="bg-[#161f38] p-6 rounded-2xl shadow-xl border border-slate-800/80 flex items-center justify-between hover:border-slate-700/60 transition-colors">
                    <div>
                        <p class="text-sm font-bold text-slate-400 uppercase tracking-wider">Total de Candidatos</p>
                        <p class="text-3xl font-extrabold text-indigo-400 mt-1">{{ $totalCandidates ?? 0 }}</p>
                    </div>
                    <div class="p-3 bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 rounded-xl shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- 3. FORMULÁRIO DE CRIAR NOVA VAGA --}}
            <div class="bg-[#161f38] overflow-hidden shadow-xl rounded-2xl border border-slate-800/80 p-8 relative">
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-indigo-500/10 blur-2xl rounded-full pointer-events-none"></div>

                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-indigo-600 rounded-lg text-white shadow-lg shadow-indigo-500/20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-white tracking-wide">Abrir Nova Vaga</h3>
                </div>
                
                <form action="{{ route('vacancies.store') }}" method="POST" class="space-y-5">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="w-full">
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">Título da Vaga</label>
                            <input type="text" name="title" required placeholder="Ex: Desenvolvedor Front-end Pleno..."
                                class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-200 placeholder-slate-500 transition-all outline-none">
                        </div>
                        <div class="w-full">
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">Salário (Opcional)</label>
                            <input type="text" name="salary" placeholder="Ex: R$ 5.000,00 ou A Combinar"
                                class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-200 placeholder-slate-500 transition-all outline-none">
                        </div>
                    </div>

                    <div class="w-full">
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">Descrição da Vaga</label>
                        <textarea name="description" rows="4" placeholder="Descreva os requisitos, responsabilidades e benefícios da vaga..."
                            class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-slate-200 placeholder-slate-500 transition-all outline-none resize-none"></textarea>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit"
                            class="w-full sm:w-auto inline-flex items-center justify-center px-8 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold text-sm text-white uppercase tracking-widest shadow-lg shadow-indigo-500/20 transition-all transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Publicar Vaga
                        </button>
                    </div>
                </form>
            </div>

            {{-- 4. LISTA DE VAGAS PUBLICADAS E FILTROS --}}
            <div class="mt-10">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
                    <h3 class="text-xl font-bold text-white tracking-wide">Suas Vagas</h3>
                    
                    {{-- Botões de Filtro --}}
                    <div class="flex bg-[#0f172a] rounded-lg p-1 border border-slate-800 w-fit shadow-md">
                        <a href="{{ route('vacancies.index', ['filter' => 'all']) }}" 
                           class="px-4 py-1.5 rounded-md text-sm font-bold transition-all {{ request('filter', 'all') === 'all' ? 'bg-indigo-600 text-white shadow' : 'text-slate-400 hover:text-white' }}">
                            Todas
                        </a>
                        <a href="{{ route('vacancies.index', ['filter' => 'open']) }}" 
                           class="px-4 py-1.5 rounded-md text-sm font-bold transition-all {{ request('filter') === 'open' ? 'bg-green-600/20 text-green-400 shadow' : 'text-slate-400 hover:text-white' }}">
                            Ativas
                        </a>
                        <a href="{{ route('vacancies.index', ['filter' => 'closed']) }}" 
                           class="px-4 py-1.5 rounded-md text-sm font-bold transition-all {{ request('filter') === 'closed' ? 'bg-red-600/20 text-red-400 shadow' : 'text-slate-400 hover:text-white' }}">
                            Fechadas
                        </a>
                    </div>
                </div>

                @if(isset($vacancies) && $vacancies->isEmpty())
                    <div class="bg-[#161f38] shadow-xl rounded-2xl p-10 text-center border border-slate-800/80">
                        <p class="text-slate-400 font-medium">Nenhuma vaga encontrada para este filtro. Crie sua primeira vaga acima!</p>
                    </div>
                @elseif(isset($vacancies))
                    @foreach($vacancies as $vacancy)
                        <div class="mb-8 bg-[#161f38] overflow-hidden shadow-2xl rounded-2xl border border-slate-800/80">
                            
                            {{-- Cabeçalho da Vaga com Link e Ações --}}
                            <div class="bg-[#111930] border-b border-slate-800 px-6 py-5 flex flex-col sm:flex-row sm:items-center justify-between">
                                <div>
                                    <h3 class="text-xl font-extrabold text-white flex items-center gap-2">
                                         {{ $vacancy->title }}
                                    </h3>
                                    <div class="mt-3 flex flex-wrap items-center gap-3 text-sm">
                                        
                                        {{-- Botão de Ligar/Desligar Vaga --}}
                                        <form action="{{ route('vacancies.toggleStatus', $vacancy->id) }}" method="POST" class="m-0">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" title="Clique para alterar o status da vaga"
                                                class="{{ $vacancy->status == 'open' ? 'text-green-400 bg-green-500/10 border-green-500/20 hover:bg-green-500/20' : 'text-red-400 bg-red-500/10 border-red-500/20 hover:bg-red-500/20' }} px-2.5 py-1 rounded-md font-bold uppercase tracking-wider text-[10px] border transition-colors flex items-center gap-1.5 cursor-pointer shadow-sm">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $vacancy->status == 'open' ? 'bg-green-400' : 'bg-red-400 animate-pulse' }}"></span>
                                                {{ $vacancy->status == 'open' ? 'Aberta' : 'Fechada' }}
                                            </button>
                                        </form>
                                        
                                        <a href="{{ route('interviews.create', $vacancy->id) }}" target="_blank" class="font-medium text-indigo-400 hover:text-indigo-300 transition flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                            Ver Página Pública
                                        </a>
                                        
                                        <button type="button" onclick="navigator.clipboard.writeText('{{ route('interviews.create', $vacancy->id) }}'); alert('Link copiado com sucesso! \nAgora é só colar no WhatsApp ou E-mail do candidato.')" class="text-slate-400 hover:text-white font-medium flex items-center cursor-pointer transition">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"></path></svg>
                                            Copiar Link
                                        </button>

                                        <span class="text-slate-700">|</span>

                                        <a href="{{ route('vacancies.edit', $vacancy->id) }}" class="text-amber-500 hover:text-amber-400 font-medium transition">Editar</a>
                                        
                                        <form action="{{ route('vacancies.destroy', $vacancy->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta vaga e todos os candidatos dela?');" class="inline m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400 font-medium transition">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0">
                                    <span class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-bold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20">
                                        Total: {{ $vacancy->interviews->count() }} {{ $vacancy->interviews->count() == 1 ? 'Candidato' : 'Candidatos' }}
                                    </span>
                                </div>
                            </div>

                            {{-- Lista de Candidatos Inscritos --}}
                            <div class="p-6">
                                @if($vacancy->interviews->isEmpty())
                                    <div class="text-center py-8 bg-[#0f172a] rounded-xl border border-dashed border-slate-700">
                                        <p class="text-slate-400 font-medium text-sm">Nenhum candidato inscrito para esta vaga ainda.</p>
                                        <p class="text-xs text-slate-500 mt-1">Copie o link acima e compartilhe para receber currículos!</p>
                                    </div>
                                @else
                                    <ul class="space-y-3">
                                        @foreach($vacancy->interviews as $interview)
                                            <li class="border border-slate-800/80 py-4 flex flex-col sm:flex-row sm:justify-between sm:items-center hover:bg-[#1c2646]/40 transition duration-200 ease-in-out px-5 rounded-xl bg-[#0f172a]/50">
    
                                                {{-- Lado Esquerdo: Avatar e Dados do Candidato --}}
                                                <div class="flex items-center space-x-4 mb-4 sm:mb-0">
                                                    <div class="h-11 w-11 rounded-full bg-indigo-500/20 border border-indigo-500/30 flex items-center justify-center text-indigo-400 font-bold text-lg shadow-inner">
                                                        {{ strtoupper(substr($interview->candidate_name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <p class="font-bold text-white text-base">{{ $interview->candidate_name }}</p>
                                                        
                                                        <div class="flex flex-wrap items-center text-xs text-slate-400 mt-1.5 gap-y-2 gap-x-3">
                                                            {{-- E-mail --}}
                                                            <span class="flex items-center">
                                                                <svg class="w-3.5 h-3.5 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                                                <a href="mailto:{{ $interview->candidate_email }}" class="hover:text-indigo-400 transition">{{ $interview->candidate_email }}</a>
                                                            </span>
                                                            
                                                            <span class="hidden sm:inline text-slate-700">|</span>
                                                            
                                                            {{-- Telefone/WhatsApp --}}
                                                            <span class="flex items-center font-medium">
                                                                <svg class="w-3.5 h-3.5 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                                                {{ $interview->phone }}
                                                            </span>
                                                            
                                                            {{-- LinkedIn --}}
                                                            @if($interview->linkedin)
                                                                <span class="hidden sm:inline text-slate-700">|</span>
                                                                <span class="flex items-center">
                                                                    <svg class="w-3.5 h-3.5 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                                                                    <a href="{{ $interview->linkedin }}" target="_blank" class="text-indigo-400 hover:text-indigo-300 transition">Perfil / Portfólio</a>
                                                                </span>
                                                            @endif
                                                            
                                                            <span class="hidden sm:inline text-slate-700">|</span>
                                                            
                                                            {{-- Data e Hora --}}
                                                            <span class="flex items-center font-medium bg-slate-800/50 text-slate-300 px-2.5 py-1 rounded-md border border-slate-700/50">
                                                                <svg class="w-3.5 h-3.5 mr-1 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                                {{ \Carbon\Carbon::parse($interview->interview_date)->format('d/m/Y') }} às {{ substr($interview->interview_time, 0, 5) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Lado Direito: Status e Ações --}}
                                                <div class="flex items-center gap-3">
                                                    
                                                    {{-- Dropdown Flexível de Status --}}
                                                    <form action="{{ route('interviews.updateStatus', $interview->id) }}" method="POST" class="m-0 relative">
                                                        @csrf
                                                        @method('PUT')
                                                        
                                                        <select name="status" onchange="this.form.submit()" class="appearance-none pr-8 pl-4 py-2 rounded-xl text-[10px] font-bold uppercase tracking-widest border transition-all cursor-pointer outline-none focus:ring-2 focus:ring-indigo-500/50 shadow-sm
                                                            {{ $interview->status === 'approved' ? 'bg-[#062817] text-[#4ade80] border-[#166534] hover:bg-[#0a3620]' : '' }}
                                                            {{ $interview->status === 'rejected' ? 'bg-[#3f1414] text-[#f87171] border-[#991b1b] hover:bg-[#4d1919]' : '' }}
                                                            {{ $interview->status === 'pending' || empty($interview->status) ? 'bg-slate-800 text-slate-300 border-slate-600 hover:bg-slate-700' : '' }}">
                                                            
                                                            <option value="pending" class="bg-[#0f172a] text-slate-300" {{ $interview->status === 'pending' || empty($interview->status) ? 'selected' : '' }}>Pendente</option>
                                                            <option value="approved" class="bg-[#0f172a] text-green-400" {{ $interview->status === 'approved' ? 'selected' : '' }}>Aprovado</option>
                                                            <option value="rejected" class="bg-[#0f172a] text-red-400" {{ $interview->status === 'rejected' ? 'selected' : '' }}>Reprovado</option>
                                                        </select>
                                                        
                                                        {{-- Ícone da setinha customizado --}}
                                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2">
                                                            <svg class="w-3.5 h-3.5 
                                                                {{ $interview->status === 'approved' ? 'text-[#4ade80]' : '' }}
                                                                {{ $interview->status === 'rejected' ? 'text-[#f87171]' : '' }}
                                                                {{ $interview->status === 'pending' || empty($interview->status) ? 'text-slate-400' : '' }}" 
                                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                            </svg>
                                                        </div>
                                                    </form>
                                                    
                                                    {{-- Botão de Excluir --}}
                                                    <form action="{{ route('interviews.destroy', $interview->id) }}" method="POST" class="m-0" onsubmit="return confirm('Excluir este candidato?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-2 rounded-xl bg-slate-800/40 border border-slate-700/50 text-slate-400 hover:text-red-400 hover:bg-red-500/10 hover:border-red-500/30 transition-all shadow-sm" title="Excluir Candidato">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
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
<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('dashboard') }}" class="text-slate-400 hover:text-white transition-colors p-2 bg-[#161f38] border border-slate-800/80 hover:border-slate-700 rounded-xl shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7 7-7"></path></svg>
            </a>
            <h2 class="font-bold text-2xl text-white tracking-tight">
                Editar Vaga
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#161f38] overflow-hidden shadow-2xl rounded-2xl border border-slate-800/80 p-8 relative">
                
                {{-- Efeito de brilho de fundo --}}
                <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 bg-amber-500/10 blur-3xl rounded-full pointer-events-none"></div>

                <div class="flex items-center gap-3 mb-8 border-b border-slate-800/80 pb-6">
                    <div class="p-2.5 bg-amber-500/10 border border-amber-500/20 rounded-xl text-amber-500 shadow-inner">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-white tracking-wide">Atualizar Informações</h3>
                        <p class="text-sm text-slate-400 mt-1">Modifique os detalhes ou encerre esta vaga.</p>
                    </div>
                </div>
                
                <form action="{{ route('vacancies.update', $vacancy->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="w-full">
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">Título da Vaga</label>
                            <input type="text" name="title" value="{{ $vacancy->title }}" required
                                class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-slate-200 placeholder-slate-600 transition-all outline-none">
                        </div>
                        <div class="w-full">
                            <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">Salário (Opcional)</label>
                            <input type="text" name="salary" value="{{ $vacancy->salary ?? '' }}" placeholder="Ex: R$ 5.000,00 ou A Combinar"
                                class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-slate-200 placeholder-slate-600 transition-all outline-none">
                        </div>
                    </div>

                    <div class="w-full">
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">Descrição da Vaga</label>
                        <textarea name="description" rows="5" required
                            class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-slate-200 placeholder-slate-600 transition-all outline-none resize-none">{{ $vacancy->description }}</textarea>
                    </div>

                    <div class="w-full md:w-1/2">
                        <label class="block text-xs font-bold text-slate-300 uppercase tracking-widest mb-2 ml-1">Status da Vaga</label>
                        <select name="status" class="w-full px-4 py-3 bg-[#0f172a] border border-slate-700 rounded-xl focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-slate-200 transition-all outline-none appearance-none">
                            <option value="open" {{ $vacancy->status == 'open' ? 'selected' : '' }}>Aberta (Recebendo currículos)</option>
                            <option value="closed" {{ $vacancy->status == 'closed' ? 'selected' : '' }}>Fechada (Encerrada)</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-3 pt-6 border-t border-slate-800/80 mt-8">
                        <a href="{{ route('dashboard') }}" class="py-3 px-6 rounded-xl text-sm font-bold text-slate-400 hover:text-white bg-slate-800/40 hover:bg-slate-700/60 transition-colors border border-transparent hover:border-slate-600">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-flex items-center justify-center px-8 py-3 bg-amber-600 hover:bg-amber-500 rounded-xl font-bold text-sm text-white uppercase tracking-widest shadow-lg shadow-amber-500/20 transition-all transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Salvar Alterações
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
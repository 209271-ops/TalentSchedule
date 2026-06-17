<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestão de Vagas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Criar Nova Vaga</h3>

                <form action="{{ route('vacancies.store') }}" method="POST" class="flex gap-4 items-center">
                    @csrf
                    <div class="flex-1">
                        <input type="text" name="title" required placeholder="Ex: Desenvolvedor Laravel Júnior"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                    </div>
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Salvar Vaga
                    </button>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Vagas Publicadas</h3>

                @if ($vacancies->isEmpty())
                    <p class="text-gray-500 text-sm">Nenhuma vaga cadastrada ainda. Crie sua primeira vaga acima!</p>
                @else
                    <ul class="divide-y divide-gray-200">
                        @foreach ($vacancies as $vacancy)
                            <li class="py-6">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-lg font-bold text-gray-900">{{ $vacancy->title }}</p>
                                        <p class="text-sm text-gray-500">Status:
                                            {{ $vacancy->status == 'open' ? 'Aberta' : 'Fechada' }}</p>
                                    </div>
                                    <a href="{{ route('interviews.create', $vacancy->id) }}" target="_blank"
                                        class="text-xs text-blue-600 bg-blue-50 px-3 py-1 rounded border border-blue-200">
                                        Link Candidato
                                    </a>
                                </div>

                                <div class="mt-4 bg-gray-50 p-4 rounded-md">
                                    <h4 class="text-sm font-semibold text-gray-700 mb-2">Candidatos Inscritos:</h4>
                                    @if ($vacancy->interviews->isEmpty())
                                        <p class="text-xs text-gray-400 italic">Nenhum candidato ainda.</p>
                                    @else
                                        <ul class="space-y-2">
                                            @foreach ($vacancy->interviews as $interview)
                                                <li class="text-sm text-gray-600 border-b border-gray-200 pb-1">
                                                    <span class="font-medi m">{{ $interview->candidate_name }}</span>
                                                    - {{ $interview->interview_date }} às
                                                    {{ substr($interview->interview_time, 0, 5) }}
                                                    <span
                                                        class="ml-2 text-xs bg-yellow-100 text-yellow-800 px-2 py-0.5 rounded">{{ $interview->status }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Entrevista - {{ $vacancy->title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            
            <div class="mb-6 text-center">
                <span class="px-3 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded-full uppercase">Candidatura</span>
                <h1 class="text-2xl font-bold text-gray-900 mt-2">{{ $vacancy->title }}</h1>
                <p class="text-sm text-gray-500 mt-1">Escolha a melhor data e horário para a sua entrevista</p>
            </div>

            @if(session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('interviews.store', $vacancy->id) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="candidate_name" class="block text-sm font-medium text-gray-700">Seu Nome Completo</label>
                    <input type="text" name="candidate_name" id="candidate_name" required value="{{ old('candidate_name') }}"
                           class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="candidate_email" class="block text-sm font-medium text-gray-700">Seu E-mail de Contato</label>
                    <input type="email" name="candidate_email" id="candidate_email" required value="{{ old('candidate_email') }}"
                           class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="interview_date" class="block text-sm font-medium text-gray-700">Data</label>
                        <input type="date" name="interview_date" id="interview_date" required min="{{ date('Y-m-y') }}"
                               class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    </div>

                    <div>
                        <label for="interview_time" class="block text-sm font-medium text-gray-700">Horário</label>
                        <input type="time" name="interview_time" id="interview_time" required
                               class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                        Confirmar Agendamento
                    </button>
                </div>
            </form>

        </div>
    </div>

</body>
</html>
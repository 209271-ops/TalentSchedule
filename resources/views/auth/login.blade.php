<x-guest-layout>
    <div class="flex flex-col items-center justify-center mb-12 text-center">
        <svg class="w-14 h-14 text-white/90 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
        </svg>
        <h1 class="text-2xl font-light text-white tracking-widest uppercase">Portal RH</h1>
        <p class="text-[10px] text-white/70 tracking-widest uppercase mt-1">Plataforma Integrada</p>
    </div>

    <div class="bg-white rounded-xl shadow-2xl relative pt-14 pb-10 px-8">
        
        <div class="absolute -top-8 left-1/2 transform -translate-x-1/2">
            <div class="bg-[#28264d] border-4 border-white rounded-2xl p-4 shadow-sm rotate-45">
                <svg class="w-7 h-7 text-white -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>

        <div class="text-center mb-8">
            <h2 class="text-[26px] font-semibold text-gray-800">Acesse sua conta</h2>
            <p class="text-sm text-gray-600 mt-1">Painel de Gestão de Vagas e Candidatos</p>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-5">
                <label for="email" class="block text-[13px] text-gray-700 mb-1.5">E-mail corporativo</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-3 py-2.5 bg-white border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#28264d] focus:border-[#28264d] shadow-sm text-sm transition-colors text-gray-800">
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
            </div>

            <div class="mb-6">
                <label for="password" class="block text-[13px] text-gray-700 mb-1.5">Senha</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-3 py-2.5 bg-white border border-gray-300 rounded-lg focus:ring-1 focus:ring-[#28264d] focus:border-[#28264d] shadow-sm text-sm transition-colors text-gray-800">
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
            </div>

            <div class="flex items-center justify-between mb-8">
                <label class="flex items-center cursor-pointer group">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded border-gray-300 text-[#28264d] shadow-sm focus:ring-[#28264d] cursor-pointer">
                    <span class="ml-2 text-sm text-gray-700 group-hover:text-gray-900 transition-colors">Lembrar de mim</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-sm text-gray-700 hover:text-[#28264d] hover:underline transition-colors" href="{{ route('password.request') }}">
                        Esqueceu a senha?
                    </a>
                @endif
            </div>

            <div>
                <button type="submit" class="w-full bg-[#201e43] hover:bg-[#161530] text-white font-medium py-3 rounded-lg text-sm transition-colors duration-200">
                    Entrar no Painel
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
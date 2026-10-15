@extends('layouts.admin')
{{-- View carregada pelo controller como: return view('Adm.dashboard', [...]); --}}

@section('title', 'Dashboard')
@section('page-title', 'Dashboard ADMIN')

@section('content')

    <section class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-amber-300 p-5 rounded-2xl border border-white/10 text-amber-950 shadow-sm">
            <h3 class="text-sm font-semibold opacity-90">Projetos em andamento</h3>
            <p class="text-3xl font-bold mt-1">{{ $projetosAndamento ?? 12 }}</p>
        </div>
        <div class="bg-amber-500/40 p-5 rounded-2xl border border-white/10 text-amber-950 shadow-sm">
            <h3 class="text-sm font-semibold opacity-90">Projetos concluídos</h3>
            <p class="text-3xl font-bold mt-1">{{ $projetosConcluidos ?? 45 }}</p>
        </div>
        <div class="bg-orange-500/40 p-5 rounded-2xl border border-white/10 text-amber-950 shadow-sm">
            <h3 class="text-sm font-semibold opacity-90">Unidades cadastradas</h3>
            <p class="text-3xl font-bold mt-1">{{ $unidadesCadastradas ?? 8 }}</p>
        </div>
        <div class="bg-orange-600/30 p-5 rounded-2xl border border-white/10 text-amber-950 shadow-sm">
            <h3 class="text-sm font-semibold opacity-90">Clientes cadastrados</h3>
            <p class="text-3xl font-bold mt-1">-</p>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6 flex-1">

        <div class="bg-stone-50 p-6 rounded-3xl shadow-lg lg:col-span-2 flex flex-col justify-between">
            <h3 class="text-lg font-bold text-amber-950 mb-4">Progresso Mensal</h3>

            <div class="relative flex items-end justify-between h-64 border-b border-gray-200 pb-2 pt-6 px-4">
                <div class="absolute inset-0 flex flex-col justify-between pointer-events-none opacity-10">
                    <div class="border-t border-black w-full"></div>
                    <div class="border-t border-black w-full"></div>
                    <div class="border-t border-black w-full"></div>
                    <div class="border-t border-black w-full"></div>
                </div>

                @php
                    // Dados mockados baseados na imagem caso a variável não venha do controller
                    $valoresMock = ['Janeiro' => 8, 'Fevereiro' => 2, 'Março' => 5, 'Abril' => 10, 'Maio' => 8, 'Junho' => 1, 'Julho' => 5];
                    $dadosGrafico = $progressoMensal ?? $valoresMock;
                @endphp

                @foreach($dadosGrafico as $mes => $valor)
                    <div class="flex flex-col items-center flex-1 group z-10">
                        <div class="w-10 bg-amber-500 rounded-t-lg transition-all duration-300 group-hover:bg-orange-600"
                             style="height: {{ ($valor / 10) * 180 }}px;">
                            <span class="absolute -top-6 text-xs font-bold text-amber-900 hidden group-hover:block w-full text-center">{{ $valor }}</span>
                        </div>
                        <span class="text-xs text-gray-500 font-medium mt-3">{{ $mes }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-stone-50 p-6 rounded-3xl shadow-lg flex flex-col items-center justify-between">
            <h3 class="text-lg font-bold text-amber-950 self-start mb-4">Distribuição por Status</h3>

            <div class="w-full flex items-center justify-center p-4">
                <svg class="w-56 h-56 transform -rotate-90" viewBox="0 0 32 32">
                    <circle r="16" cx="16" cy="16" fill="transparent" stroke="#f97316" stroke-width="32" stroke-dasharray="60 100" />
                    <circle r="16" cx="16" cy="16" fill="transparent" stroke="#facc15" stroke-width="32" stroke-dasharray="25 100" stroke-dashoffset="-60" />
                    <circle r="16" cx="16" cy="16" fill="transparent" stroke="#fb923c" stroke-width="32" stroke-dasharray="15 100" stroke-dashoffset="-85" />
                </svg>
            </div>

            <div class="flex justify-center space-x-4 text-xs font-semibold text-gray-600 mt-2">
                <span class="flex items-center"><span class="w-3 h-3 bg-orange-500 rounded-full mr-1"></span> Concluídos</span>
                <span class="flex items-center"><span class="w-3 h-3 bg-yellow-400 rounded-full mr-1"></span> Andamento</span>
            </div>
        </div>

    </section>

@endsection
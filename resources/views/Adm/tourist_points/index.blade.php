@extends('layouts.admin')

@section('title', 'Pontos Turísticos')
@section('page-title', 'Gerenciar Atrações e Pontos Turísticos')

@section('content')
<div class="bg-stone-50 p-6 rounded-3xl shadow-lg flex-1 flex flex-col">
    
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-4">
            ✅ {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-bold text-amber-950 flex items-center gap-2">
            <span>📸</span> Atrações Cadastradas
        </h3>
        <a href="{{ route('Adm.tourist_points.create') }}" class="bg-amber-600 hover:bg-amber-700 text-white font-semibold px-4 py-2 rounded-xl flex items-center gap-2 transition text-sm shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Novo Ponto Turístico
        </a>
    </div>

    @if($points->isEmpty())
        <div class="text-center py-12 text-gray-500">
            <p>Nenhum ponto turístico cadastrado ainda.</p>
        </div>
    @else
        <div class="overflow-hidden rounded-2xl border border-amber-100 bg-white">
            <table class="w-full border-collapse text-left text-sm text-gray-500">
                <thead class="bg-amber-950 text-white text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 font-semibold w-24">Imagem</th>
                        <th class="px-6 py-4 font-semibold">Nome</th>
                        <th class="px-6 py-4 font-semibold">Valor por Pessoa</th>
                        <th class="px-6 py-4 font-semibold text-right">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-amber-50">
                    @foreach($points as $point)
                        <tr class="hover:bg-amber-50/30 transition-colors">
                            <td class="px-6 py-3">
                                @if($point->image)
                                    <img src="{{ asset('storage/' . $point->image) }}" alt="{{ $point->name }}" class="w-12 h-12 object-cover rounded-xl border border-amber-100 shadow-xs">
                                @else
                                    <div class="w-12 h-12 bg-stone-100 rounded-xl border border-amber-50 flex items-center justify-center text-gray-400 text-xs" title="Sem imagem">
                                        🖼️
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-bold text-gray-900">
                                {{ $point->name }}
                            </td>
                            <td class="px-6 py-4 text-amber-900 font-semibold">
                                R$ {{ number_format($point->price_per_person, 2, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <a href="{{ route('Adm.tourist_points.edit', $point) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-100 text-amber-800 hover:bg-amber-600 hover:text-white transition-all shadow-sm" title="Editar">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>

                                    <form action="{{ route('Adm.tourist_points.destroy', $point) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta atração?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-100 text-red-700 hover:bg-red-600 hover:text-white transition-all shadow-sm" title="Excluir">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 6.75h18M5.25 6.75V19.5a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25V6.75M9 10.5v6m6-6v6" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Escolas Parceiras')
@section('page-title', 'Escolas Parceiras')

@section('content')
    <div class="bg-stone-50 p-6 rounded-3xl shadow-lg flex-1 flex flex-col">

        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-4 flex items-center gap-2">
                <span>✅</span> {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-amber-950 flex items-center gap-2">
                <i class="fas fa-school text-amber-700"></i> Instituições Cadastradas
            </h3>
            <a href="{{ route('adm.schools.create') }}"
                class="bg-amber-600 hover:bg-amber-700 text-white font-semibold px-4 py-2 rounded-xl flex items-center gap-2 transition text-sm shadow-sm">
                <i class="fas fa-plus"></i> Nova Escola
            </a>
        </div>

        @if($schools->isEmpty())
            <div class="text-center py-12 text-gray-500">
                <p>Nenhuma escola cadastrada até o momento.</p>
            </div>
        @else
            <div class="overflow-hidden rounded-2xl border border-amber-100 bg-white">
                <table class="w-full border-collapse text-left text-sm text-gray-500">
                    <thead class="bg-amber-950 text-white text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-4 font-semibold">ID</th>
                            <th class="px-6 py-4 font-semibold">Nome da Instituição</th>
                            <th class="px-6 py-4 font-semibold text-center">Projetos</th>
                            <th class="px-6 py-4 font-semibold text-right">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-amber-50">
                        @foreach($schools as $school)
                            <tr class="hover:bg-amber-50/50 cursor-pointer transition-colors target-row"
                                onclick="toggleDetails({{ $school->id }})">
                                <td class="px-6 py-4 font-bold text-amber-900">#{{ $school->id }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-chevron-right text-xs text-amber-600 transition-transform duration-200"
                                            id="icon-{{ $school->id }}"></i>
                                        {{ $school->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span
                                        class="bg-amber-100 text-amber-900 text-xs font-bold px-2.5 py-1 rounded-full">{{ $school->projects_count ?? 0 }}</span>
                                </td>
                                <td class="px-6 py-4 text-right" onclick="event.stopPropagation();">
                                    <a href="{{ route('adm.schools.edit', $school) }}"
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-100 text-amber-800 hover:bg-amber-600 hover:text-white transition-all shadow-sm"
                                        title="Editar Escola">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>

                            <tr id="details-{{ $school->id }}" class="hidden bg-stone-50/70">
                                <td colspan="4" class="px-8 py-6 border-t border-amber-100">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-amber-950">

                                        <div class="space-y-2">
                                            <h4 class="font-bold text-sm text-amber-800 flex items-center gap-2">
                                                <i class="fas fa-map-marker-alt"></i> Endereço Cadastrado
                                            </h4>
                                            <p class="text-sm text-gray-700">
                                                <span class="font-semibold">Rua/Av:</span>
                                                {{ $school->logradouro ?? 'Não informado' }}, {{ $school->numero ?? 'S/N' }}<br>
                                                @if($school->complemento) <span class="font-semibold">Compl:</span>
                                                {{ $school->complemento }}<br> @endif
                                                <span class="font-semibold">Bairro:</span>
                                                {{ $school->bairro ?? 'Não informado' }}<br>
                                                <span class="font-semibold">Cidade/UF:</span> {{ $school->cidade ?? '-' }} /
                                                {{ $school->estado ?? '-' }}<br>
                                                <span class="font-semibold">CEP:</span> {{ $school->cep ?? '-' }}
                                            </p>
                                        </div>

                                        @foreach($school->managers as $manager)
                                            <div class="p-2.5 bg-white rounded-xl border border-amber-100 text-xs shadow-xs flex items-center justify-between gap-2">
                                                <div>
                                                    <p class="font-bold text-gray-900 text-sm">{{ $manager->nome }}</p>
                                                    <p class="text-gray-600 mt-0.5"><i class="fas fa-phone text-amber-600 scale-75"></i>
                                                        {{ $manager->telefone ?? 'Sem telefone' }}</p>
                                                    <p class="text-gray-600"><i class="fas fa-envelope text-amber-600 scale-75"></i>
                                                        {{ $manager->email ?? 'Sem e-mail' }}</p>
                                                </div>

                                                @if($manager->whatsapp_link)
                                                    <a href="{{ $manager->whatsapp_link }}" target="_blank"
                                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-green-100 text-green-700 hover:bg-green-600 hover:text-white transition-all shadow-sm shrink-0"
                                                        title="Conversar no WhatsApp">
                                                        <i class="fab fa-whatsapp text-base"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        @endforeach

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        function toggleDetails(id) {
            const detailRow = document.getElementById(`details-${id}`);
            const icon = document.getElementById(`icon-${id}`);

            if (detailRow.classList.contains('hidden')) {
                detailRow.classList.remove('hidden');
                icon.classList.add('rotate-90');
            } else {
                detailRow.classList.add('hidden');
                icon.classList.remove('rotate-90');
            }
        }
    </script>
@endsection
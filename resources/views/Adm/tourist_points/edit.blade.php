@extends('layouts.admin')

@section('title', 'Editar Ponto Turístico')
@section('page-title', 'Editar Atração')

@section('content')
    <div class="bg-stone-50 p-6 rounded-3xl shadow-lg flex-1 flex flex-col">
        <h3 class="text-lg font-bold text-amber-950 mb-6 flex items-center gap-2">
            <span>✏️</span> Alterar Informações do Ponto Turístico
        </h3>

        @if($errors->any())
            <div class="bg-red-100 text-red-800 px-5 py-4 rounded-2xl mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('Adm.tourist_points.update', $point) }}" method="POST" enctype="multipart/form-data"
            class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-semibold text-amber-950 mb-2">Nome do Ponto Turístico</label>
                <input type="text" name="name" value="{{ old('name', $point->name) }}"
                    class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-amber-950 mb-2">Valor por Pessoa (R$)</label>
                <input type="number" name="price_per_person" value="{{ old('price_per_person', $point->price_per_person) }}"
                    step="0.01"
                    class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-semibold text-amber-950 mb-2">CEP</label>
                    <input type="text" name="cep" id="cep" value="{{ old('cep', $point->cep) }}" placeholder="00000-000"
                        class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500"
                        onblur="pesquisacep(this.value);">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-amber-950 mb-2">Logradouro (Rua/Avenida)</label>
                    <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro', $point->logradouro) }}"
                        class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-amber-950 mb-2">Número</label>
                    <input type="text" name="numero" value="{{ old('numero', $point->numero) }}"
                        class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-semibold text-amber-950 mb-2">Complemento</label>
                    <input type="text" name="complemento" value="{{ old('complemento', $point->complemento) }}"
                        class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-amber-950 mb-2">Bairro</label>
                    <input type="text" name="bairro" id="bairro" value="{{ old('bairro', $point->bairro) }}"
                        class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-amber-950 mb-2">Cidade</label>
                    <input type="text" name="cidade" id="cidade" value="{{ old('cidade', $point->cidade) }}"
                        class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-amber-950 mb-2">Estado (UF)</label>
                    <input type="text" name="estado" id="uf" value="{{ old('estado', $point->estado) }}"
                        placeholder="EX: SP" maxlength="2"
                        class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-amber-950 mb-2">Foto Atual</label>
                @if($point->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $point->image) }}" alt="Imagem atual"
                            class="w-32 h-32 object-cover rounded-2xl border border-amber-200 shadow-sm">
                    </div>
                @endif

                <label class="block text-sm font-semibold text-amber-950 mb-2">Substituir Foto (Opcional)</label>
                <input type="file" name="image"
                    class="w-full border border-amber-200 bg-white rounded-xl px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-amber-100 file:text-amber-900 hover:file:bg-amber-200 cursor-pointer focus:outline-none">
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('Adm.tourist_points.index') }}"
                    class="px-5 py-2.5 rounded-xl border border-amber-200 text-amber-900 font-medium hover:bg-amber-50 transition">Cancelar</a>
                <button type="submit"
                    class="bg-amber-600 hover:bg-amber-700 text-white font-semibold px-6 py-2.5 rounded-xl transition">Salvar
                    Alterações</button>
            </div>
        </form>
    </div>
@endsection
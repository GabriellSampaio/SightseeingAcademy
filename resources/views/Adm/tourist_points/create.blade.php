@extends('layouts.admin')

@section('title', 'Novo Ponto Turístico')
@section('page-title', 'Cadastrar Atração')

@section('content')
    <div class="bg-stone-50 p-6 rounded-3xl shadow-lg flex-1 flex flex-col">
        <h3 class="text-lg font-bold text-amber-950 mb-6 flex items-center gap-2">
            <span>📸</span> Cadastrar Novo Ponto Turístico
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

        <form action="{{ route('Adm.tourist_points.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-amber-950 mb-2">Nome do Ponto Turístico</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Ex: Cristo Redentor, Beto Carrero..."
                    class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required>
            </div>

            <div>
                <label class="block text-sm font-semibold text-amber-950 mb-2">Valor por Pessoa (R$)</label>
                <input type="number" name="price_per_person" value="{{ old('price_per_person') }}" step="0.01"
                    placeholder="0.00"
                    class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500"
                    required>
            </div>

            <div class="border-t border-amber-100 pt-4 mt-6">
                <h4 class="text-md font-bold text-amber-950 mb-4 flex items-center gap-2">
                    <span>📍</span> Localização e Acesso
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-amber-950 mb-2">CEP</label>
                        <input type="text" name="cep" id="cep" value="{{ old('cep') }}" placeholder="00000-000"
                            class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500"
                            onblur="pesquisacep(this.value);">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-amber-950 mb-2">Logradouro (Rua/Avenida)</label>
                        <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro') }}"
                            class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-amber-950 mb-2">Número</label>
                        <input type="text" name="numero" value="{{ old('numero') }}"
                            class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-semibold text-amber-950 mb-2">Complemento</label>
                        <input type="text" name="complemento" value="{{ old('complemento') }}"
                            class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-amber-950 mb-2">Bairro</label>
                        <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}"
                            class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-amber-950 mb-2">Cidade</label>
                        <input type="text" name="cidade" id="cidade" value="{{ old('cidade') }}"
                            class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-amber-950 mb-2">Estado (UF)</label>
                        <input type="text" name="estado" id="uf" value="{{ old('estado') }}" placeholder="EX: SP"
                            max-length="2"
                            class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

            </div>

            <script>
                function meu_callback(conteudo) {
                    if (!("erro" in conteudo)) {
                        document.getElementById('logradouro').value = (conteudo.logradouro);
                        document.getElementById('bairro').value = (conteudo.bairro);
                        document.getElementById('cidade').value = (conteudo.localidade);
                        document.getElementById('uf').value = (conteudo.uf);
                    } else {
                        alert("CEP não encontrado.");
                    }
                }
                function pesquisacep(valor) {
                    var cep = valor.replace(/\D/g, '');
                    if (cep != "") {
                        var validacep = /^[0-9]{8}$/;
                        if (validacep.test(cep)) {
                            document.getElementById('logradouro').value = "...";
                            document.getElementById('bairro').value = "...";
                            document.getElementById('cidade').value = "...";
                            document.getElementById('uf').value = "...";
                            var script = document.createElement('script');
                            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';
                            document.body.appendChild(script);
                        } else {
                            alert("Formato de CEP inválido.");
                        }
                    }
                }
            </script>

            <div>
                <label class="block text-sm font-semibold text-amber-950 mb-2">Foto / Imagem do Local</label>
                <input type="file" name="image"
                    class="w-full border border-amber-200 bg-white rounded-xl px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-amber-100 file:text-amber-900 hover:file:bg-amber-200 cursor-pointer focus:outline-none">
                <p class="text-xs text-gray-400 mt-1">Formatos aceitos: JPG, PNG, WEBP. Tamanho máximo: 2MB.</p>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('Adm.tourist_points.index') }}"
                    class="px-5 py-2.5 rounded-xl border border-amber-200 text-amber-900 font-medium hover:bg-amber-50 transition">Cancelar</a>
                <button type="submit"
                    class="bg-amber-600 hover:bg-amber-700 text-white font-semibold px-6 py-2.5 rounded-xl transition">Salvar
                    Ponto Turístico</button>
            </div>
        </form>
    </div>
@endsection
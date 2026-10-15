@extends('layouts.admin')

@section('title', 'Nova Escola')
@section('page-title', 'Nova Escola')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endpush

@section('content')

    <section class="bg-stone-50 p-6 rounded-3xl shadow-lg flex-1 flex flex-col">

        <h3 class="text-lg font-bold text-amber-950 flex items-center gap-2 mb-6">
            <i class="fas fa-school text-amber-700"></i> Nova Escola
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

        <form action="{{ route('adm.schools.store') }}" method="POST" id="school-form">
            @csrf

            {{-- Nome da instituição --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-amber-950 mb-2">Nome da Instituição</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500"
                       required>
            </div>

            {{-- Endereço --}}
            <div class="border border-amber-100 rounded-2xl p-5 mb-6">
                <h4 class="font-semibold text-amber-950 mb-4 flex items-center gap-2">
                    <i class="fas fa-map-marker-alt text-amber-700"></i> Endereço
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">CEP</label>
                        <input type="text" name="cep" id="cep" value="{{ old('cep') }}"
                               maxlength="9" placeholder="00000-000"
                               class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-amber-900 mb-1">Logradouro (Rua/Avenida)</label>
                        <input type="text" name="logradouro" id="logradouro" value="{{ old('logradouro') }}"
                               class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Número</label>
                        <input type="text" name="numero" value="{{ old('numero') }}"
                               class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-amber-900 mb-1">Complemento</label>
                        <input type="text" name="complemento" value="{{ old('complemento') }}"
                               class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-amber-900 mb-1">Bairro</label>
                        <input type="text" name="bairro" id="bairro" value="{{ old('bairro') }}"
                               class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Cidade</label>
                        <input type="text" name="cidade" id="cidade" value="{{ old('cidade') }}"
                               class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-amber-900 mb-1">Estado</label>
                        <input type="text" name="estado" id="estado" value="{{ old('estado') }}"
                               maxlength="2" placeholder="UF"
                               class="w-full border border-amber-200 rounded-xl px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    </div>
                </div>
            </div>

            {{-- Responsáveis (dinâmico) --}}
            <div class="border border-amber-100 rounded-2xl p-5 mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="font-semibold text-amber-950 flex items-center gap-2">
                        <i class="fas fa-user-tie text-amber-700"></i> Responsáveis
                    </h4>
                    <button type="button" id="add-manager"
                            class="bg-amber-100 hover:bg-amber-200 text-amber-900 font-medium px-4 py-2 rounded-xl flex items-center gap-2 transition text-sm">
                        <i class="fas fa-plus"></i> Adicionar Responsável
                    </button>
                </div>

                <div id="managers-container" class="flex flex-col gap-4">
                    {{-- blocos de responsável entram aqui via JS --}}
                </div>

                <p id="no-managers-msg" class="text-gray-400 text-sm text-center py-4">
                    Nenhum responsável adicionado ainda.
                </p>
            </div>

            <div class="flex justify-end gap-3">
                <a href="{{ route('adm.schools.index') }}"
                   class="px-5 py-2.5 rounded-xl border border-amber-200 text-amber-900 font-medium hover:bg-amber-50 transition">
                    Cancelar
                </a>
                <button type="submit"
                        class="bg-amber-600 hover:bg-amber-700 text-white font-semibold px-6 py-2.5 rounded-xl transition">
                    Salvar Escola
                </button>
            </div>
        </form>

    </section>

@endsection

@push('scripts')
<script>
let managerIndex = 0;

function managerBlockHtml(index, data = {}) {
    return `
        <div class="manager-block bg-amber-50/50 border border-amber-100 rounded-xl p-4 relative" data-index="${index}">
            <button type="button" class="remove-manager absolute top-3 right-3 text-red-500 hover:text-red-700">
                <i class="fas fa-trash"></i>
            </button>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-amber-900 mb-1">Nome</label>
                    <input type="text" name="managers[${index}][nome]" value="${data.nome ?? ''}"
                           class="w-full border border-amber-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500"
                           required>
                </div>
                <div>
                    <label class="block text-sm font-medium text-amber-900 mb-1">Telefone</label>
                    <input type="text" name="managers[${index}][telefone]" value="${data.telefone ?? ''}"
                           placeholder="(00) 00000-0000"
                           class="w-full border border-amber-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-amber-900 mb-1">E-mail</label>
                    <input type="email" name="managers[${index}][email]" value="${data.email ?? ''}"
                           class="w-full border border-amber-200 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500">
                </div>
            </div>
        </div>
    `;
}

function toggleEmptyMessage() {
    const hasBlocks = document.querySelectorAll('.manager-block').length > 0;
    document.getElementById('no-managers-msg').style.display = hasBlocks ? 'none' : 'block';
}

document.getElementById('add-manager').addEventListener('click', () => {
    const container = document.getElementById('managers-container');
    container.insertAdjacentHTML('beforeend', managerBlockHtml(managerIndex));
    managerIndex++;
    toggleEmptyMessage();
});

document.getElementById('managers-container').addEventListener('click', (e) => {
    if (e.target.closest('.remove-manager')) {
        e.target.closest('.manager-block').remove();
        toggleEmptyMessage();
    }
});

// Autopreenchimento via ViaCEP
document.getElementById('cep').addEventListener('blur', async function () {
    const cep = this.value.replace(/\D/g, '');
    if (cep.length !== 8) return;

    try {
        const res = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
        const data = await res.json();
        if (data.erro) return;

        document.getElementById('logradouro').value = data.logradouro || '';
        document.getElementById('bairro').value = data.bairro || '';
        document.getElementById('cidade').value = data.localidade || '';
        document.getElementById('estado').value = data.uf || '';
    } catch (err) {
        console.error('Erro ao buscar CEP', err);
    }
});

// Inicializa exibindo a mensagem de "nenhum responsável"
toggleEmptyMessage();
</script>
@endpush
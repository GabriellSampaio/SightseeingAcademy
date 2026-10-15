<form action="{{ route('adm.projects.store') }}" method="POST">
    @csrf
    <label>Nome do Projeto:</label>
    <input type="text" name="name" required>

    <label>Selecione a Escola:</label>
    <select name="school_id" required>
        <option value="">-- Escolha uma Escola --</option>
        @foreach($schools as $school)
            <option value="{{ $school->id }}">{{ $school->name }}</option>
        @endforeach
    </select>

    <label>Destino:</label>
    <select name="destination" required>
        <option value="PETAR">PETAR</option>
        <option value="City Tour em Santos">City Tour em Santos</option>
        <option value="Paranapiacaba">Paranapiacaba</option>
    </select>

    <label>Data do Evento:</label>
    <input type="date" name="event_date">

    <button type="submit">Iniciar Projeto</button>
</form>
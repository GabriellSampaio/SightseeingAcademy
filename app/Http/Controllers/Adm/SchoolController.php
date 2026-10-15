<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    // Listagem das Escolas Contratantes
    public function index()
    {
        $schools = School::withCount('projects')->orderBy('name', 'asc')->get();
        return view('Adm.schools.index', compact('schools'));
    }

    // Formulário de Cadastro
    public function create()
    {
        return view('Adm.schools.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'cep' => 'nullable|string|max:9',
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
            'managers' => 'nullable|array',
            'managers.*.nome' => 'required_with:managers|string|max:255',
            'managers.*.telefone' => 'nullable|string|max:20',
            'managers.*.email' => 'nullable|email|max:255',
        ]);

        DB::transaction(function () use ($validated) {
            $school = School::create([
                'name' => $validated['name'],
                'cep' => $validated['cep'] ?? null,
                'logradouro' => $validated['logradouro'] ?? null,
                'numero' => $validated['numero'] ?? null,
                'complemento' => $validated['complemento'] ?? null,
                'bairro' => $validated['bairro'] ?? null,
                'cidade' => $validated['cidade'] ?? null,
                'estado' => $validated['estado'] ?? null,
            ]);

            foreach ($validated['managers'] ?? [] as $manager) {
                $school->managers()->create($manager);
            }
        });

        return redirect()->route('adm.schools.index')->with('success', 'Escola cadastrada com sucesso!');
    }

    // ... outros métodos anteriores (index, create, store...)

    /**
     * Mostra o formulário de edição para uma escola específica.
     */
    public function edit($id)
    {
        // Busca a escola pelo ID ou retorna erro 404 caso ela não exista
        // Se você usa o Model Binding do Laravel, pode usar: public function edit(School $school)
        $school = \App\Models\School::with('managers')->findOrFail($id);

        return view('Adm.schools.edit', compact('school'));
    }

    /**
     * Processa a atualização dos dados no banco.
     */
    public function update(Request $request, $id)
    {
        $school = \App\Models\School::findOrFail($id);

        $request->validate([
            'name' => "required|string|max:255|unique:schools,name,{$school->id}",
            'cep' => 'nullable|string',
            'logradouro' => 'nullable|string',
            'numero' => 'nullable|string',
            'bairro' => 'nullable|string',
            'cidade' => 'nullable|string',
            'estado' => 'nullable|string|max:2',
        ]);

        // Atualiza os dados básicos da escola
        $school->update($request->only(['name', 'cep', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado']));

        // Sincroniza os responsáveis (limpa os antigos e cria com base no formulário)
        if ($request->has('managers')) {
            $school->managers()->delete();
            foreach ($request->managers as $managerData) {
                if (!empty($managerData['nome'])) {
                    $school->managers()->create($managerData);
                }
            }
        }

        return redirect()->route('adm.schools.index')->with('success', 'Escola atualizada com sucesso!');
    }


}
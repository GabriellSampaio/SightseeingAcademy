<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\School;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Exibe o formulário de criação do projeto
    public function create()
    {
        $schools = School::all(); // Busca todas as escolas para o <select>
        return view('Adm.projects.create', compact('schools'));
    }

    // Salva o projeto no banco
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'school_id' => 'required|exists:schools,id',
            'destination' => 'required|in:PETAR,City Tour em Santos,Paranapiacaba',
            'event_date' => 'nullable|date',
        ]);

        Project::create([
            'name' => $request->name,
            'school_id' => $request->school_id,
            'destination' => $request->destination,
            'status' => 'em_andamento', // Todo projeto começa em andamento
            'event_date' => $request->event_date,
        ]);

        return redirect()->route('adm.dashboard')->with('success', 'Projeto iniciado com sucesso!');
    }
}
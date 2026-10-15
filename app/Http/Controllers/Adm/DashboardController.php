<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\School;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Estatísticas dos cards superiores
        $projetosAndamento = Project::where('status', 'em_andamento')->count();
        $projetosConcluidos = Project::where('status', 'concluido')->count();
        $unidadesCadastradas = School::count();

        // Dados para o Gráfico de Progresso Mensal (Projetos criados em 2026)
        $mensalData = Project::select(DB::raw("COUNT(*) as count"), DB::raw("MONTH(event_date) as month"))
            ->whereYear('event_date', 2026)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month')
            ->toArray();

        // Inicializa os 7 meses visíveis no seu mockup (Janeiro a Julho)
        $progressoMensal = [];
        $mesesNomes = [1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril', 5 => 'Maio', 6 => 'Junho', 7 => 'Julho'];
        foreach ($mesesNomes as $num => $nome) {
            $progressoMensal[$nome] = $mensalData[$num] ?? 0;
        }

        return view('Adm.dashboard', compact(
            'projetosAndamento',
            'projetosConcluidos',
            'unidadesCadastradas',
            'progressoMensal'
        ));
    }
}
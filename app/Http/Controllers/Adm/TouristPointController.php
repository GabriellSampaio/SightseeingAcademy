<?php
namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\TouristPoint; // Certifique-se de criar este Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TouristPointController extends Controller
{
    public function index()
    {
        $points = TouristPoint::orderBy('name', 'asc')->get();
        return view('Adm.tourist_points.index', compact('points'));
    }

    public function create()
    {
        return view('Adm.tourist_points.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_person' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Max 2MB
        ]);

        $data = $request->all();

        // Tratamento do Upload da Imagem
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('tourist_points', 'public');
        }

        TouristPoint::create($data);

        return redirect()->route('Adm.tourist_points.index')->with('success', 'Ponto turístico cadastrado com sucesso!');
    }

    public function edit(TouristPoint $point)
    {
        return view('Adm.tourist_points.edit', compact('point'));
    }

    public function update(Request $request, TouristPoint $point)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price_per_person' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'cep' => 'nullable|string|max:9',
            'logradouro' => 'nullable|string|max:255',
            'numero' => 'nullable|string|max:20',
            'complemento' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'cidade' => 'nullable|string|max:255',
            'estado' => 'nullable|string|max:2',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            // Deleta a imagem antiga do disco se ela existir
            if ($point->image) {
                Storage::disk('public')->delete($point->image);
            }
            $data['image'] = $request->file('image')->store('tourist_points', 'public');
        }

        $point->update($data);

        return redirect()->route('Adm.tourist_points.index')->with('success', 'Ponto turístico atualizado!');
    }

    public function destroy(TouristPoint $point)
    {
        // Deleta a imagem do armazenamento ao excluir o registro
        if ($point->image) {
            Storage::disk('public')->delete($point->image);
        }

        $point->delete();
        return redirect()->route('Adm.tourist_points.index')->with('success', 'Ponto turístico removido!');
    }
}
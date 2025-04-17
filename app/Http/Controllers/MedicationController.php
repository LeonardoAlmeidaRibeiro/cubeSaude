<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    // Listar todos os medicamentos
    public function index()
    {
        $medications = auth()->user()->medicamentos()->orderBy('horario')->get();
        return view('painel.medicamento.index', compact('medications'));
    }

    // Mostrar formulário de criação
    public function create()
    {
        return view('painel.medicamento.create');
    }

    // Armazenar novo medicamento
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'dosagem' => 'required|string|max:100',
            'horario' => 'required|date_format:H:i'
        ]);
    
        auth()->user()->medicamentos()->create($validated);
    
        return redirect()->route('medicamentos.index')
            ->with('success', 'Medicamento adicionado com sucesso!');
    }

    // Marcar como tomado/não tomado
    public function toggleTaken(Medication $medication)
    {
            $medication->update([
            'taken' => !$medication->taken,
            'updated_at' => now()
        ]);

        return back()->with('success', 'Status atualizado!');
    }

    // Mostrar formulário de edição
    public function edit(Medicamento $medicamento)
    {

        return view('painel.medicamento.edit', compact('medicamento'));
    }

    // Atualizar medicamento
    public function update(Request $request, Medicamento $medicamento)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'dosage' => 'required|string|max:100',
            'time' => 'required|date_format:H:i',
            'taken' => 'sometimes|boolean'
        ]);

        $medication->update($validated);

        return redirect()->route('medicamentos.index')
            ->with('success', 'Medicamento atualizado com sucesso!');
    }

    // Remover medicamento
    public function destroy(Medication $medication)
    {
        try {
            $medication->delete();
            
            return redirect()->route('medicamentos.index')
                            ->with('success', 'Medicamento deletado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Erro ao deletar medicamento: ' . $e->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\Medication;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
// Listar todos os medicamentos
public function index()
{
    $medications = auth()->user()->medications()->orderBy('time')->get();
    return view('medications.index', compact('medications'));
}
    
// Mostrar formulário de criação
public function create()
{
    return view('medications.create');
}

// Armazenar novo medicamento
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'dosage' => 'required|string|max:100',
        'time' => 'required|date_format:H:i',
    ]);

    auth()->user()->medications()->create($validated);

    return redirect()->route('medications.index')
                     ->with('success', 'Medicamento adicionado com sucesso!');
}

// Marcar como tomado/não tomado
public function toggleTaken(Medication $medication)
{
    $this->authorize('update', $medication);
    
    $medication->update([
        'taken' => !$medication->taken,
        'updated_at' => now()
    ]);

    return back()->with('success', 'Status atualizado!');
}

// Mostrar formulário de edição
public function edit(Medication $medication)
{
    $this->authorize('update', $medication);
    
    return view('medications.edit', compact('medication'));
}

// Atualizar medicamento
public function update(Request $request, Medication $medication)
{
    $this->authorize('update', $medication);
    
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'dosage' => 'required|string|max:100',
        'time' => 'required|date_format:H:i',
    ]);

    $medication->update($validated);

    return redirect()->route('medications.index')
                     ->with('success', 'Medicamento atualizado com sucesso!');
}

// Remover medicamento
public function destroy(Medication $medication)
{
    $this->authorize('delete', $medication);
    
    $medication->delete();

    return back()->with('success', 'Medicamento removido!');
}
}

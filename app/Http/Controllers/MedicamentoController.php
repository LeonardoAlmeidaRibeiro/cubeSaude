<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Medicamento;
use App\Models\Medicamento as ModelsMedicamento;

class MedicamentoController extends Controller
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
    /**
     * Alterna o status de tomado/não tomado do medicamento
     *
     * @param \App\Models\Medicamento $medicamento
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleTaken(ModelsMedicamento $medicamento)
    {
        try {
            $novoStatus = !$medicamento->tomado;
            $mensagem = $novoStatus ? 'Medicamento marcado como tomado' : 'Medicamento marcado como pendente';

            $medicamento->update([
                'tomado' => $novoStatus,
                'updated_at' => now()
            ]);

            return back()->with([
                'success' => $mensagem,
                'medicamento_id' => $medicamento->id
            ]);
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar status: ' . $e->getMessage());
        }
    }

    // Mostrar formulário de edição
    public function edit($id)
    {
        $medicamento = ModelsMedicamento::find($id);
        return view('painel.medicamento.edit', compact('medicamento'));
    }

    // Atualizar medicamento
    public function update(Request $request, ModelsMedicamento $medicamento)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'dosagem' => 'required|string|max:100',
            'horario' => 'required|date_format:H:i',
            'tomado' => 'sometimes|boolean'
        ]);

        $medicamento->update($validated);

        return redirect()->route('medicamentos.index')
            ->with('success', 'Medicamento atualizado com sucesso!');
    }

    // Remover medicamento
    public function destroy(ModelsMedicamento $medicamento)
    {
        try {
            $medicamento->delete();

            return redirect()->route('medicamentos.index')
                ->with('success', 'Medicamento removido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao remover medicamento: ' . $e->getMessage());
        }
    }
}

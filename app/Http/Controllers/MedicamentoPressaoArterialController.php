<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicamentoPressao;
use Illuminate\Support\Facades\Auth;

class MedicamentoPressaoArterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medications = MedicamentoPressao::where('user_id', Auth::id())->latest()->get();
        return view('painel.medicamentoPressao.index', compact('medications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('painel.medicamentoPressao.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required|string|max:255',
            'dosagem' => 'required|string|max:100',
            'horario' => 'required|date_format:H:i'
        ]);

        MedicamentoPressao::create([
            'user_id' => auth()->id(),
            'nome' => $request->nome,
            'dosagem' => $request->dosagem,
            'horario' => $request->horario,
        ]);

        return redirect()->route('medicamento-pressao.index')
            ->with('success', 'Medicamento adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $medicamento = MedicamentoPressao::find($id);
        return view('painel.medicamentoPressao.edit', compact('medicamento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicamentoPressao $medicamento)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'dosagem' => 'required|string|max:100',
            'horario' => 'required|date_format:H:i',
            'tomado' => 'sometimes|boolean'
        ]);

        $medicamento->update($validated);

        return redirect()->route('medicamento-pressao.index')
            ->with('success', 'Medicamento atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MedicamentoPressao $medicamento)
    {
        try {
            $medicamento->delete();

            return redirect()->route('medicamento-pressao.index')
                ->with('success', 'Medicamento removido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao remover medicamento: ' . $e->getMessage());
        }
    }


    public function toggleTaken(MedicamentoPressao $medicamento)
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
}

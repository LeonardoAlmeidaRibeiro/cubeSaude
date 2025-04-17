<?php

namespace App\Http\Controllers;

use App\Models\MedicaoGlicose;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GlucoseMeasurementController extends Controller
{
    public function index()
    {
        $measurements = MedicaoGlicose::where('user_id', Auth::id())->latest()->get();
        return view('painel.glicose.index', compact('measurements'));
    }

    public function create()
    {
        return view('painel.glicose.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'valor' => 'required|numeric|min:0',
            'tipo_medicao' => 'required|in:jejum,pre-refeicao,pos-refeicao',
            'medido_em' => 'required|date',
        ]);
    
        MedicaoGlicose::create([
            'user_id' => Auth::id(),  
            'valor' => $request->valor,
            'tipo_medicao' => $request->tipo_medicao,
            'medido_em' => $request->medido_em, 
        ]);
    
        return redirect()->route('glucose.index')->with('success', 'Medição registrada com sucesso!');
    }

    public function edit(MedicaoGlicose $glucose)
    {
        return view('painel.glicose.edit', compact('glucose'));
    }

    public function update(Request $request, MedicaoGlicose $glucose)
    {
        $request->validate([
            'valor' => 'required|numeric|min:0',
            'tipo_medicao' => 'required|in:jejum,pre-refeicao,pos-refeicao',
            'medido_em' => 'required|date',
        ]);
    
        $glucose->update([
            'valor' => $request->valor,
            'tipo_medicao' => $request->tipo_medicao,
            'medido_em' => $request->medido_em
        ]);
    
        return redirect()->route('glucose.index')->with('success', 'Medição atualizada com sucesso!');
    }

    public function destroy(MedicaoGlicose $glucose)
    {
        try {
            $glucose->delete();

            return redirect()->route('glucose.index')
                ->with('success',  'Medição removida!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao deletar medição: ' . $e->getMessage());
        }
    }
}

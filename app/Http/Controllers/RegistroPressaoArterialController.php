<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroPressaoArterial;
use Illuminate\Support\Facades\Auth;

class RegistroPressaoArterialController extends Controller
{
    public function index()
    {
        $registros = RegistroPressaoArterial::where('user_id', Auth::id())->orderByDesc('data')->get();
        return view('painel.pressao.index', compact('registros'));
    }

    public function create()
    {
        return view('painel.pressao.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
            'sistolica' => 'required|integer',
            'diastolica' => 'required|integer',
            'pulso' => 'nullable|integer',
            'observacoes' => 'nullable|string',
        ]);

        RegistroPressaoArterial::create([
            'user_id' => Auth::id(),
            'data' => $request->data,
            'pressao_sistolica' => $request->sistolica,
            'pressao_diastolica' => $request->diastolica,
            'pulso' => $request->pulso,
            'observacoes' => $request->observacoes,
        ]);

        return redirect()->route('registros-pressao.index')->with('success', 'Registro criado com sucesso!');
    }


    public function show(RegistroPressaoArterial $registro)
    {
        $this->authorize('view', $registro);
        return view('registros.show', compact('registro'));
    }

    public function edit(RegistroPressaoArterial $registro)
    {
        return view('painel.pressao.edit', compact('registro'));
    }

    public function update(Request $request, RegistroPressaoArterial $registro)
    {

        $request->validate([
            'data' => 'required|date',
            'pressao_sistolica' => 'required|integer',
            'pressao_diastolica' => 'required|integer',
            'pulso' => 'nullable|integer',
            'observacoes' => 'nullable|string',
        ]);

        $registro->update($request->only([
            'data',
            'pressao_sistolica',
            'pressao_diastolica',
            'pulso',
            'observacoes',
        ]));

        return redirect()->route('registros-pressao.index')->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy(RegistroPressaoArterial $registro)
    {
        $registro->delete();
        return redirect()->route('registros-pressao.index')->with('success', 'Registro excluído com sucesso!');
    }
}

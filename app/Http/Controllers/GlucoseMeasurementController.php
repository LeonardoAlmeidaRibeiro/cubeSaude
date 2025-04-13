<?php

namespace App\Http\Controllers;

use App\Models\GlucoseMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GlucoseMeasurementController extends Controller
{
    public function index()
    {
        $measurements = GlucoseMeasurement::where('user_id', Auth::id())->latest()->get();
        return view('painel.glucose.index', compact('measurements'));
    }

    public function create()
    {
        return view('painel.glucose.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|numeric|min:0',
            'measurement_type' => 'required|in:jejum,pre-refeicao,pos-refeicao',
            'measured_at' => 'required|date',
        ]);

        GlucoseMeasurement::create([
            'user_id' => Auth::id(),
            'value' => $request->value,
            'measurement_type' => $request->measurement_type,
            'measured_at' => $request->measured_at,
        ]);

        return redirect()->route('glucose.index')->with('success', 'Medição registrada!');
    }

    public function edit(GlucoseMeasurement $glucose)
    {
        return view('painel.glucose.edit', compact('glucose'));
    }

    public function update(Request $request, GlucoseMeasurement $glucose)
    {
        $request->validate([
            'value' => 'required|numeric|min:0',
            'measurement_type' => 'required|in:jejum,pre-refeicao,pos-refeicao',
            'measured_at' => 'required|date',
        ]);

        $glucose->update($request->only(['value', 'measurement_type', 'measured_at']));

        return redirect()->route('glucose.index')->with('success', 'Medição atualizada!');
    }

    public function destroy(GlucoseMeasurement $glucose)
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

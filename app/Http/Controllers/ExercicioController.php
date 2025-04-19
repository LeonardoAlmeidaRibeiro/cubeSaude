<?php

namespace App\Http\Controllers;

use App\Models\Exercicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExercicioController extends Controller
{
    /**
     * Lista todos os exercícios do usuário
     */
    public function index()
    {
        $exercicios = Exercicio::where('user_id', Auth::id())->latest()->get();
        return view('painel.exercicios.index', compact('exercicios'));
    }

    /**
     * Mostra o formulário de cadastro
     */
    public function create()
    {
        return view('painel.exercicios.create');
    }

    /**
     * Armazena um novo exercício
     */
    public function store(Request $request)
    {
        $request->validate([
            'atividade' => 'required|string|max:255',
            'duracao' => 'required|integer|min:1',
            'realizado_em' => 'required|date',
        ]);

        Exercicio::create([
            'user_id' => Auth::id(),
            'atividade' => $request->atividade,
            'duracao' => $request->duracao,
            'realizado_em' => $request->realizado_em,
        ]);

        return redirect()->route('exercises.index')->with('success', 'Exercício registrado com sucesso!');
    }

    /**
     * Mostra o formulário de edição
     */
    public function edit(Exercicio $exercicio)
    {
       
        return view('painel.exercicios.edit', compact('exercicio'));
    }

    /**
     * Atualiza um exercício existente
     */
    public function update(Request $request, Exercicio $exercicio)
    {
        $request->validate([
            'atividade' => 'required|string|max:255',
            'duracao' => 'required|integer|min:1',
            'realizado_em' => 'required|date',
        ]);
    
        $exercicio->update($request->only(['atividade', 'duracao', 'realizado_em']));
    
        return redirect()->route('exercises.index')->with('success', 'Exercício atualizado!');
    }
    

    /**
     * Remove um exercício
     */
    public function destroy(Exercicio $exercicio)
    {
        try {
            $exercicio->delete();

            return redirect()->route('exercises.index')
                ->with('success', 'Exercício removido com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao remover exercício: ' . $e->getMessage());
        }
    }
}
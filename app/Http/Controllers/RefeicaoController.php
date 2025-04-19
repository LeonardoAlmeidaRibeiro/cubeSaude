<?php

namespace App\Http\Controllers;

use App\Models\Refeicao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefeicaoController extends Controller
{
    public function index()
    {
        $refeicoes = Refeicao::where('user_id', Auth::id())->latest()->get();
        return view('painel.refeicao.index', compact('refeicoes'));
    }

    public function create()
    {
        return view('painel.refeicao.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo_refeicao' => 'required|in:cafe,almoco,jantar,lanche',
            'carboidratos' => 'nullable|numeric|min:0',
            'consumido_em' => 'nullable',
        ]);

        Refeicao::create([
            'user_id' => auth()->id(),
            'nome' => $request->nome,
            'tipo_refeicao' => $request->tipo_refeicao,
            'carboidratos' => $request->carboidratos,
            'consumido_em' => $request->consumido_em ?? null,
        ]);

        return redirect()->route('refeicoes.index')->with('success', 'Refeição cadastrada com sucesso!');
    }

    public function edit(Refeicao $refeicao)
    {
        return view('painel.refeicao.edit', compact('refeicao'));
    }
    public function destroy(Refeicao $refeicao)
    {
        try {
            $refeicao->delete();

            return redirect()->route('refeicoes.index')
                ->with('success', 'Refeição removida com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao remover refeição: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Refeicao $refeicao)
    {
        // Validação dos dados
        $request->validate([
            'nome' => 'required|string|max:255',
            'tipo_refeicao' => 'required|in:cafe,almoco,jantar,lanche',
            'carboidratos' => 'nullable|numeric|min:0',
            'consumido_em' => 'nullable|date',
        ]);

        try {
            // Atualiza os dados da refeição
            $refeicao->update([
                'nome' => $request->nome,
                'tipo_refeicao' => $request->tipo_refeicao,
                'carboidratos' => $request->carboidratos ?? 0,
                'consumido_em' => $request->consumido_em ?? now(),
            ]);

            return redirect()
                ->route('refeicoes.index')
                ->with('success', 'Refeição atualizada com sucesso!');
        } catch (\Exception $e) {
            // Em caso de erro, redireciona de volta com mensagem de erro
            return redirect()
                ->back()
                ->with('error', 'Erro ao atualizar refeição: ' . $e->getMessage())
                ->withInput();
        }
    }
}

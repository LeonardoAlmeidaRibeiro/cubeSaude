<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meals = Meal::where('user_id', Auth::id())->latest()->get();
        return view('painel.meals.index', compact('meals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('painel.meals.create');
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
            'name' => 'required|string|max:255',
            'meal_type' => 'required|in:cafe,almoco,jantar,lanches',
            'carbs' => 'nullable|numeric|min:0',
            'consumed_at' => 'nullable',
        ]);
    
        Meal::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'meal_type' => $request->meal_type,
            'carbs' => $request->carbs,
            'consumed_at' => $request->consumed_at ?? null,
        ]);
    
        return redirect()->route('meals.index')->with('success', 'Refeição cadastrada com sucesso!');
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
    public function edit(Meal $meal)
    {
        return view('painel.meals.edit', compact('meal'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meal $meal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meal $meal)
    {
        try {
            $meal->delete();
            
            return redirect()->route('meals.index')
                            ->with('success', 'Refeição deletada com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()
                            ->with('error', 'Erro ao deletar refeição: ' . $e->getMessage());
        }
    }
}

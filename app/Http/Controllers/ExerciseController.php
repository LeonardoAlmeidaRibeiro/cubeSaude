<?php

namespace App\Http\Controllers;

use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the exercises.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exercises = Exercise::where('user_id', Auth::id())->latest()->get();
        return view('painel.exercises.index', compact('exercises'));
    }

    /**
     * Show the form for creating a new exercise.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('painel.exercises.create');
    }

    /**
     * Store a newly created exercise in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'done_at' => 'required|date',
        ]);

        Exercise::create([
            'user_id' => Auth::id(),
            'activity' => $request->activity,
            'duration' => $request->duration,
            'done_at' => $request->done_at,
        ]);

        return redirect()->route('exercises.index')->with('success', 'Exercício registrado!');
    }

    /**
     * Show the form for editing the specified exercise.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercise $exercise)
    {
        return view('painel.exercises.edit', compact('exercise'));
    }

    /**
     * Update the specified exercise in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercise $exercise)
    {
        $request->validate([
            'activity' => 'required|string|max:255',
            'duration' => 'required|integer|min:1',
            'done_at' => 'required|date',
        ]);

        $exercise->update($request->only(['activity', 'duration', 'done_at']));

        return redirect()->route('exercises.index')->with('success', 'Exercício atualizado!');
    }

    /**
     * Remove the specified exercise from storage.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercise $exercise)
    {
        try {
            $exercise->delete();

            return redirect()->route('exercises.index')
                ->with('success', 'Exercício removido!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Erro ao deletar exercício: ' . $e->getMessage());
        }
    }
}
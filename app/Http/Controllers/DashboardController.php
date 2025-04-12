<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     $glucoseMeasurements = auth()->user()->glucoseMeasurements()
    //         ->orderBy('measured_at', 'desc')
    //         ->limit(5)
    //         ->get();

    //     $medications = auth()->user()->medications()
    //         ->whereDate('taken_at', today())
    //         ->get();

    //     $stats = [
    //         'avg_glucose' => auth()->user()->glucoseMeasurements()
    //             ->whereDate('measured_at', today())
    //             ->avg('value'),
    //         // outras estatísticas
    //     ];

    //     $user = auth()->user();
    //     return view('painel.index', compact('user','glucoseMeasurements', 'medications', 'stats'));
    // }

    // DashboardController.php
    public function index()
    {
        $notifications = [
            [
                'title' => 'Medição de Glicose Pendente',
                'message' => 'Faltam 2 medições hoje',
                'time' => 'Há 30 minutos',
                'urgent' => true
            ],
            [
                'title' => 'Medicação Próxima',
                'message' => 'Insulina em 15 minutos',
                'time' => 'Em 15 minutos',
                'urgent' => false
            ]
        ];
        $today = now()->format('Y-m-d');
        $user = auth()->user();
        return view('dashboard', [
            'todayGlucose' => auth()->user()->glucoseMeasurements()
                ->whereDate('measured_at', $today)
                ->orderBy('measured_at')
                ->get(),

            'todayMedications' => auth()->user()->medications()
                ->whereDate('created_at', $today)
                ->get(),

            'todayMeals' => auth()->user()->meals()
                ->whereDate('consumed_at', $today)
                ->orderBy('consumed_at')
                ->get(),

            'todayExercises' => auth()->user()->exercises()
                ->whereDate('done_at', $today)
                ->get(), 'user' => $user,'notifications'=>$notifications
        ]);
    }
    public function profile()
    {
        return view('profile');
    }
}

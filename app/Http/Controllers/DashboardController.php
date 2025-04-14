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
        $today = now()->format('Y-m-d');
        $user = auth()->user();

        $pendingGlucose = 3 - $user->glucoseMeasurements()
            ->whereDate('measured_at', $today)
            ->count();

        $nextMed = $user->medications()
            ->where('taken', false)
            ->whereTime('time', '>=', now()->format('H:i:s'))
            ->orderBy('time')
            ->first();

        $notifications = [];

        if ($pendingGlucose > 0) {
            $message = "Faltam $pendingGlucose medições hoje";
            $existing = \App\Models\Notification::where('user_id', $user->id)
                ->where('title', 'Medições Pendentes')
                ->whereDate('created_at', $today)
                ->first();

            if (!$existing) {
                \App\Models\Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Medições Pendentes',
                    'message' => $message,
                    'is_urgent' => true,
                    'scheduled_at' => now(),
                ]);
            }

            $notifications[] = [
                'title' => 'Medições Pendentes',
                'message' => $message,
                'time' => 'Agora',
                'urgent' => true
            ];
        }

        if ($nextMed) {
            $message = "{$nextMed->name} às {$nextMed->time->format('H:i')}";
            $existing = \App\Models\Notification::where('user_id', $user->id)
                ->where('title', 'Próxima Medicação')
                ->whereDate('created_at', $today)
                ->where('message', $message)
                ->first();

            if (!$existing) {
                \App\Models\Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Próxima Medicação',
                    'message' => $message,
                    'is_urgent' => false,
                    'scheduled_at' => $nextMed->time,
                ]);
            }

            $notifications[] = [
                'title' => 'Próxima Medicação',
                'message' => $message,
                'time' => 'Em breve',
                'urgent' => false
            ];
        }

        return view('dashboard', [
            'todayGlucose' => $user->glucoseMeasurements()
                ->whereDate('measured_at', $today)
                ->orderBy('measured_at')
                ->get(),

            'todayMedications' => $user->medications()
                ->whereDate('created_at', $today)
                ->get(),

            'todayMeals' => $user->meals()
                ->whereDate('consumed_at', $today)
                ->orderBy('consumed_at')
                ->get(),

            'todayExercises' => $user->exercises()
                ->whereDate('done_at', $today)
                ->get(),

            'user' => $user,
            'notifications' => $notifications,
        ]);
    }

    public function profile()
    {
        return view('profile');
    }
}

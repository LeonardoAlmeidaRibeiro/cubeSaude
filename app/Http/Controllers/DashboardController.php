<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->format('Y-m-d');
        $user = auth()->user();

        // Ajuste para usar medicoesGlicose() em vez de glucoseMeasurements()
        $pendingGlucose = 3 - $user->medicoesGlicose()
            ->whereDate('medido_em', $today)  // Ajustado para 'medido_em' em vez de 'measured_at'
            ->count();

        $proximoMedicamento = $user->medicamentos()
            ->where('tomado', false)
            ->whereTime('horario', '>=', now()->format('H:i:s'))
            ->orderBy('horario')
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

        // Restante do código permanece igual...

        return view('dashboard', [
            'medicoesHoje' => $user->medicoesGlicose()
                ->whereDate('medido_em', $today)  // Ajustado para 'medido_em'
                ->orderBy('medido_em')  // Ajustado para 'medido_em'
                ->get(),

            // Restante do array de retorno permanece igual...
            'proximoMedicamento' => $user->medicamentos()
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

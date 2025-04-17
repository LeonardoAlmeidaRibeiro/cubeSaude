<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    GlucoseMeasurementController,
    MedicamentoController,
    MealController,
    ExerciseController
};



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/teste', function () {
    return view('teste');
});
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::any('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/password/change', [AuthController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('/password/change', [AuthController::class, 'changePassword']);
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');

// Rotas protegidas (somente usuários autenticados)
Route::middleware('auth')->group(function () {
    Route::get('/painel/index', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');
    Route::resource('glucose', GlucoseMeasurementController::class);

    // Rotas para medicamentos
    Route::resource('medicamentos', MedicamentoController::class);
    Route::patch('/medicamentos/{medicamento}/toggle-taken', [MedicamentoController::class, 'toggleTaken'])
        ->name('medicamentos.toggleTaken');

    Route::resource('meals', MealController::class);
    Route::resource('exercises', ExerciseController::class);
});

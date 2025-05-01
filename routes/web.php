<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    GlucoseMeasurementController,
    MedicamentoController,
    RefeicaoController,
    ExercicioController,
    RegistroPressaoArterialController,
    MedicamentoPressaoArterialController
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
    return view('index');
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
    Route::resource('refeicoes', RefeicaoController::class)->parameters(['refeicoes' => 'refeicao']);
    Route::resource('exercises', ExercicioController::class)->parameters(['exercises' => 'exercicio']);
    Route::resource('registros-pressao', RegistroPressaoArterialController::class)->parameters(['registros-pressao' => 'registro']);
    Route::get('medicamento-pressao', [MedicamentoPressaoArterialController::class,'index'])->name('medicamento-pressao.index');
    Route::get('medicamento-pressao/create', [MedicamentoPressaoArterialController::class,'create'])->name('medicamento-pressao.create');
    Route::post('medicamento-pressao/store', [MedicamentoPressaoArterialController::class,'store'])->name('medicamento-pressao.store');
    Route::get('medicamento-pressao/edit/{id}', [MedicamentoPressaoArterialController::class,'edit'])->name('medicamento-pressao.edit');
    Route::put('medicamento-pressao/update/{medicamento}', [MedicamentoPressaoArterialController::class, 'update'])->name('medicamento-pressao.update');
    Route::delete('medicamento-pressao/destroy/{medicamento}', [MedicamentoPressaoArterialController::class,'destroy'])->name('medicamento-pressao.destroy');
    Route::any('/medicamento-pressao/{medicamento}/toggle-taken', [MedicamentoPressaoArterialController::class, 'toggleTaken'])
    ->name('medicamento-pressao.toggleTaken');

});

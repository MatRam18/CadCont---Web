<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    if (Session::has('firebase_user')) {
        return redirect('/homepage');
    }
    return view('index');
});

// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/cadastro', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/cadastro', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas para recuperação de senha
Route::get('/forgotpassword', [AuthController::class, 'showForgotPasswordForm'])->name('forgotpassword');
Route::post('/forgotpassword', [AuthController::class, 'sendResetEmail']);

Route::get('/contactedit', function () {
    return view('contactedit.index');
});

Route::get('/homepage', [ContatoController::class, 'index'])->name('contato.index');

Route::post('/contactupdate/{id}', [ContatoController::class, 'update']);

Route::get('/deletecontact/{id}', [ContatoController::class, 'destroy']);

Route::get('/newcontact', function () {
    return view('newcontact.index');
});

Route::post('/newcontact', [ContatoController::class, 'store'])->name('contato.store');

// Exemplo de rota protegida pelo middleware firebase
Route::middleware(['firebase'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Adicione outras rotas protegidas aqui
});

Route::get('/profiledit', function () {
    return view('profiledit.index');
});

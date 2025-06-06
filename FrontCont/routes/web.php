<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContatoController;

Route::get('/', function () {
    return view('index');
});

Route::get('/login', function () {
    return view('login.index');
});

Route::get('/cadastro', function () {
    return view('cadastro.index');
});

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

Route::get('/profile', function () {
    return view('profile.index');
});

Route::get('/profiledit', function () {
    return view('profiledit.index');
});

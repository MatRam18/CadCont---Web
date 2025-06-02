<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/homepage', function () {
    return view('homepage.index');
});

Route::get('/newcontact', function () {
    return view('newcontact.index');
});

Route::get('/profile', function () {
    return view('profile.index');
});

Route::get('/profiledit', function () {
    return view('profiledit.index');
});

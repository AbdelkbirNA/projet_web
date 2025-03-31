<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


use App\Http\Controllers\ProfessorController;



Route::get('/', function () {
    return view('Ensiasd.Main'); // Assure-toi que la structure respecte bien `resources/views/Ensiasd/Main.blade.php`
})->name('home');

Route::get('/professors', [ProfessorController::class, 'index'])->name('professors');

Route::get('/prof', function () {
    return view('prof');
});
Route::get('/abdo', function () {
    return view('Professors.Abdo');
});


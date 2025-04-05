<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


use App\Http\Controllers\ProfessorController;



Route::get('/', function () {
    return view('Ensiasd.Main'); // Assure-toi que la structure respecte bien `resources/views/Ensiasd/Main.blade.php`
})->name('home');

Route::get('/professors', function () {
    return view('Ensiasd.professors');
});

Route::get('/abdo', function () {
    return view('Professors.Abdo');
});



//Publicatio test

Route::get('/publications', ["App\Http\Controllers\pubController","all_pub"])->name("all_pub");
Route::get('/pub', ["App\Http\Controllers\pubController","index"])->name("pub");
Route::get('/pub/create', ["App\Http\Controllers\pubController","create"])->name("create");
Route::post('/pub/store', ["App\Http\Controllers\pubController","store"])->name("store");
Route::get('/pub/{publication}', ["App\Http\Controllers\pubController","show"])
->where('id','\d+')
->name("show");
//Edit
Route::get('/pub/{publication}/edit', ["App\Http\Controllers\pubController","edit"])
->name("edit");


Route::put('/pub/{publication}', ["App\Http\Controllers\pubController","update"])
->name("update");

Route::delete('/pub/{publication}', ["App\Http\Controllers\pubController","Delete"])
->name("del");
Route::get('/acceuil', function (){

    return view("accueil");
})->name("acc");
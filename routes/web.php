<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudentController;

// Routes d'authentification personnalisées
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Groupe de routes protégées
Route::middleware(['auth'])->group(function () {
    // Route pour les professeurs
    Route::get('/professor/publications', [PublicationController::class, 'professorIndex'])
         ->name('professor.publications.index')
         ->middleware('user.type:professor');
    
    // Route pour les étudiants
    Route::get('/student/publications', [PublicationController::class, 'studentIndex'])
         ->name('student.publications.index')
         ->middleware('user.type:student');

    // Route de redirection après login (home)
    Route::get('/home', function () {
        return auth()->user()->isProfessor() 
            ? redirect()->route('professor.publications.index')
            : redirect()->route('student.publications.index');
    })->name('home');
});
// Redirection de la racine
Route::get('/', function () {
    return auth()->check() 
        ? redirect()->route('home')
        : redirect()->route('login');
});


route::get("/home",function(){

    return view("Ensiasd.Main");
})->name("home");

Route::get("/homeProf",function(){

    return view("professor.publications.acceuil");
})->name("prof_main");

Route::get("/homeStudent",function(){

    return view("student.publications.acceuil");
})->name("student_main");


Route::prefix('student')->middleware(['auth', 'user.type:student'])->group(function () {
    Route::get('/main', [StudentController::class, 'main'])->name('student_main');
    Route::get('/professors/{professor}/publications', [StudentController::class, 'showProfessorPublications'])
         ->name('student.professor.publications');
});

// routes/web.php
use App\Http\Controllers\Auth\RegisterController;

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/', function () {
    return view('Ensiasd.Main'); // Assure-toi que la structure respecte bien `resources/views/Ensiasd/Main.blade.php`
})->name('home');

Route::get('/professors', function () {
    return view('Ensiasd.professors');
});

Route::get('/abdo', function () {
    return view('Professors.Abdo');
});


// Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


// Redirection racine
// Route::get('/', function () {
//     return auth()->check() 
//         ? redirect()->route(auth()->user()->isProfessor() 
//             ? 'professor.publications.index' 
//             : 'student.publications.index')
//         : redirect()->route('login');
// });


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;

// Routes d'authentification personnalisées
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Page d'accueil
Route::get('/', function () {
    return view('Ensiasd.Main');
})->name('home');

// Pages publiques accessibles à tous

Route::get('/professors', function () {
    return view('Ensiasd.professors');
})->name('professors');
Route::get('/abdo', function () {
    return view('professor.Abdo');
});
Route::get('/test', function () {
    return view('home');
});

// Groupe de routes protégées
Route::middleware(['auth'])->group(function () {
    // Routes pour les professeurs
    Route::middleware(['user.type:professor'])->group(function () {
        Route::get('/homeProf', function () {
            return view('professor.publications.acceuil');
        })->name('prof_main');
        
        Route::get('/professor/publications', [PublicationController::class, 'professorIndex'])
            ->name('professor.publications.index');
    });
    
    // Routes pour les étudiants
    Route::middleware(['user.type:student'])->group(function () {
        Route::get('/homeStudent', function () {
            return view('student.publications.acceuil');
        })->name('student_main');
        
        Route::get('/student/publications', [PublicationController::class, 'studentIndex'])
            ->name('student.publications.index');
            
        Route::get('/student/professors/{professor}/publications', [StudentController::class, 'showProfessorPublications'])
            ->name('student.professor.publications');
    });
});
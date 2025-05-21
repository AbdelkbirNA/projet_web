<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\AnswerController;
use App\Models\Profile;

// Routes d'authentification personnalisées
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/professor/{id}', [ProfileController::class, 'showProfessor'])->name('professor.show');
// Page d'accueil
Route::get('/', function () {
    $professors = Profile::whereHas('user', function($query) {
        $query->where('user_type', 'professor');
    })->with('user')->latest()->take(3)->get();
    
    return view('Ensiasd.Main', compact('professors'));
})->name('home');

Route::get('/abdo', function () {
    return view('professor.Abdo');
})->name('home2');

// Pages publiques accessibles à tous
Route::get('/professors', [ProfileController::class, 'index'])->name('professors');
Route::get('/professor/{id}', [ProfileController::class, 'showProfessor'])->name('professor.show');

// Route spécifique pour Prof Abdo (tu peux en ajouter d'autres pour chaque prof)
Route::get('/professors/abdo', function () {
    return view('professor.Abdo');
})->name('professor.abdo');

// Exemple de route dynamique si tu veux généraliser (optionnel)
// Route::get('/professors/{slug}', [ProfessorController::class, 'show'])->name('professor.show');

// Route pour afficher un profil depuis la base (si besoin)
Route::get('/professor/{id}', [ProfileController::class, 'showProfessor'])->name('professor.show');

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

Route::get('/about/{id}', [ProfileController::class, 'showAbout'])->name('profile.about');    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Route pour la mise à jour de la photo de profil
    Route::put('/profile/{id}/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    // Route pour la mise à jour des infos de contact
    Route::put('/profile/{id}/contact', [ProfileController::class, 'updateContact'])->name('profile.updateContact');

    // Route pour la mise à jour du profil
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('courses', CourseController::class);

    Route::get('/courses/resources/{filename}', function ($filename) {
        $path = storage_path('app/resources/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return Response::make($file, 200, [
            'Content-Type' => $type,
            'Content-Disposition' => 'inline; filename="' . $filename . '"'
        ]);
    })->name('courses.resources.view');

    Route::get('/courses/resources/download/{filename}', function ($filename) {
        $path = storage_path('app/resources/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $type = File::mimeType($path);

        return Response::download($path, $filename, [
            'Content-Type' => $type,
        ]);
    })->name('courses.resources.download');
    
Route::get('/professor/{id}/courses', [CourseController::class, 'professorCourses'])->name('professor.courses');
Route::get('/professor/{id}/courses', [CourseController::class, 'professorCourses'])->name('professor.courses');
    // Professeur : gestion questions
    Route::get('/courses/{course}/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('/courses/{course}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/courses/{course}/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');

    // Étudiant : accès forum + réponses
    Route::get('/courses/{course}/forum', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');

    Route::get('courses/resources/view/{filename}', [CourseController::class, 'viewResource'])
        ->where('filename', '.*')
        ->name('courses.resources.view');

    Route::get('courses/resources/download/{filename}', [CourseController::class, 'downloadResource'])
        ->where('filename', '.*')
        ->name('courses.resources.download');
});
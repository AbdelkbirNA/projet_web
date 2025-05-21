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
use App\Http\Controllers\ContactController; // Ajouté
use App\Http\Controllers\MessageController;


Route::get('/courses/{course}/questions', [QuestionController::class, 'index'])
    ->name('questions.index')
    ->middleware('auth');



use App\Models\Profile;
Route::get('/professor/{user}/publications', [ProfileController::class, 'publications'])->name('professor.publications');
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
Route::get('/professors/abdo', function () {
    return view('professor.Abdo');
})->name('professor.abdo');

// Route pour afficher un profil depuis la base (si besoin)
Route::get('/professor/{id}', [ProfileController::class, 'showProfessor'])->name('professor.show');

// Groupe de routes protégées
Route::middleware(['auth'])->group(function () {

    // Routes pour la messagerie
    Route::middleware(['user.type:professor'])->group(function () {
        Route::get('/inbox', [MessageController::class, 'index'])->name('inbox');
        Route::get('/message/{id}', [MessageController::class, 'show'])->name('message.show');
        Route::post('/message/{id}/reply', [MessageController::class, 'reply'])->name('message.reply');
        Route::post('/message/{id}/mark', [MessageController::class, 'mark'])->name('message.mark');
        Route::get('/search-messages', [MessageController::class, 'search'])->name('messages.search');
    });

    // Routes pour les professeurs
    Route::middleware(['user.type:professor'])->group(function () {
        Route::get('/homeProf', function () {
            return view('professor.publications.acceuil');
        })->name('prof_main');

        Route::prefix('publications')->group(function () {
            Route::get('/', [PublicationController::class, 'professorIndex'])
                ->name('professor.publications.index');
            Route::get('/create', [PublicationController::class, 'create'])
                ->name('professor.publications.create');
            Route::post('/', [PublicationController::class, 'store'])
                ->name('professor.publications.store');
            Route::get('/{publication}/edit', [PublicationController::class, 'edit'])
                ->name('professor.publications.edit');
            Route::put('/{publication}', [PublicationController::class, 'update'])
                ->name('professor.publications.update');
            Route::delete('/{publication}', [PublicationController::class, 'destroy'])
                ->name('professor.publications.destroy'); // Correction: avec 's'
        });
    });

    // Routes pour les étudiants
    Route::middleware(['user.type:student'])->group(function () {
        Route::get('/homeStudent', function () {
            return view('student.publications.acceuil');
        })->name('student_main');

        Route::get('/student/publications', [PublicationController::class, 'studentIndex'])
            ->name('student.publications.index');

        // Route::get('/student/professors/{professor}/publications', [StudentController::class, 'showProfessorPublications'])
        //     ->name('student.professor.publications');
        Route::get('/student/professors/{professor}/publications', [StudentController::class, 'showProfessorPublications'])
        //     ->name('student.professor.publications'))
        ->name('student.professor.publications');
        // Routes pour le contact (Ajouté)
        Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
        Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    });
Route::middleware(['auth', 'professor'])->group(function () {
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
});
    // Profil
    Route::get('/about/{id}', [ProfileController::class, 'showAbout'])->name('profile.about'); // Correction du nom
    Route::get('/profile/create', [ProfileController::class, 'create'])->name('profile.create');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/{id}/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
    Route::put('/profile/{id}/contact', [ProfileController::class, 'updateContact'])->name('profile.updateContact');

    // Cours
    Route::resource('courses', CourseController::class);

    // Téléchargement & consultation de ressources
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
    })->name('courses.resources.view'); // Ajouté

    Route::get('/courses/resources/download/{filename}', function ($filename) {
        $path = storage_path('app/resources/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $type = File::mimeType($path);

        return Response::download($path, $filename, [
            'Content-Type' => $type,
        ]);
    })->name('courses.resources.download'); // Ajouté

    // Alternative avec contrôleur (ajoutée dans le premier code)
    Route::get('courses/resources/view/{filename}', [CourseController::class, 'viewResource'])
        ->where('filename', '.*')
        ->name('courses.resources.view');

    Route::get('courses/resources/download/{filename}', [CourseController::class, 'downloadResource'])
        ->where('filename', '.*')
        ->name('courses.resources.download');

    // Cours professeur
    Route::get('/professor/{id}/courses', [CourseController::class, 'professorCourses'])->name('professor.courses');

    // Questions & Réponses
    Route::get('/courses/{course}/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::get('/courses/{course}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
    Route::post('/courses/{course}/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::get('/questions/{question}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');

    Route::get('/courses/{course}/forum', [ForumController::class, 'show'])->name('forum.show');
    Route::post('/questions/{question}/answers', [AnswerController::class, 'store'])->name('answers.store');
});

Route::get('/messages/{id}', [App\Http\Controllers\MessageController::class, 'show'])->name('messages.show');
Route::delete('/messages/{id}', [App\Http\Controllers\MessageController::class, 'destroy'])->name('messages.destroy');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route pour vérifier si l'utilisateur est authentifié
Route::get('/check-auth', function (Request $request) {
    // Ajouter des informations de débogage
    Log::info('Check Auth API appelé. Authentifié: ' . (auth()->check() ? 'Oui' : 'Non'));
    
    return response()->json([
        'authenticated' => auth()->check(),
        'user_id' => auth()->id(), // Ajouter l'ID de l'utilisateur pour le débogage
        'session_id' => session()->getId() // Ajouter l'ID de session pour le débogage
    ]);
});

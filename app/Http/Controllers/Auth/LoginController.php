<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override the authenticated method to redirect back to the previous page
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->user_type === 'student') {
        return redirect()->route('professors');
    }
    
    if ($user->user_type === 'professor') {
        return redirect()->route('professor.show', ['id' => $user->id]);
    }
    
    // Si une URL de retour est spécifiée
    if ($request->has('redirect_to')) {
        return redirect($request->input('redirect_to'));
    }
    
    // Par défaut, redirection vers la page d'accueil
    return redirect()->route('home');
    }
    
    /**
     * Override the logout method to redirect back to the previous page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
{
    $this->guard()->logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    // Rediriger vers la page d'accueil après déconnexion
    return redirect()->route('home');
}
}
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
        // Si une URL de retour est spécifiée, rediriger vers cette URL
        if ($request->has('redirect_to')) {
            return redirect($request->input('redirect_to'));
        }
        
        // Sinon, rediriger vers la page précédente si elle existe
        if ($request->session()->has('url.intended')) {
            return redirect($request->session()->pull('url.intended'));
        }
        
        // Rediriger vers la page précédente
        return redirect()->back();
    }
    
    /**
     * Override the logout method to redirect back to the previous page
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // Stocker l'URL actuelle avant la déconnexion
        $previousUrl = url()->previous();
        
        $this->guard()->logout();
        
        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        
        // Rediriger vers la page précédente
        return redirect($previousUrl);
    }
}
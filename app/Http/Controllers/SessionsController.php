<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http; // Make sure this is at the top

class SessionsController 
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
         // First, try to authenticate as Admin
    if (Auth::guard('admin')->attempt($attributes)) {
        $request->session()->regenerate();
        return redirect()->route('dashboard')->with('success', 'Vous êtes connecté en tant qu\'Admin.');
    }

        // First, try to authenticate as a User
        if(Auth::guard('web')->attempt($attributes))
        {
            $request->session()->regenerate();
            return redirect()->route('home.Accueil')->with('success', 'You are logged in as User.');
        }
          // Authentification Agence avec vérification status
    $agency = \App\Models\Agency::where('email', $attributes['email'])
        ->where('status', 'approved')
        ->first();

        // If not a User, try authenticating as Agency
        if ($agency && Auth::guard('agency')->attempt($attributes)) {
        $request->session()->regenerate();
        return redirect()->route('home.Accueil')->with('success', 'You are logged in as Agency.');
    }
        // Validate reCAPTCHA
$response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
    'secret' => config('services.recaptcha.secret_key'),
    'response' => $request->input('g-recaptcha-response'),
    'remoteip' => $request->ip(),
]);

if (!($response->json()['success'] ?? false)) {
    return back()->withErrors(['captcha' => 'Captcha non validé.'])->withInput();
}

        // If neither works:
        return back()->withErrors(['email' => 'Email or password invalid.']);
    }
    
    public function destroy(Request $request)
    {
        // Logout from both guards
        Auth::guard('web')->logout();
        Auth::guard('agency')->logout();
    
        // Completely wipe the session
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/')->with('success', 'Vous êtes déconnecté.');
    }
    

}

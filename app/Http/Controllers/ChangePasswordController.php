<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
class ChangePasswordController 
{
    public function changePassword(Request $request)
    {
        
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect('/login')->with('success', __($status))
                    : back()->withErrors(['email' => [__($status)]]);
    }
    public function sendResetCode(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    // Generate a 6-digit numeric token
    $token = rand(100000, 999999);

    // Store token in the password_resets table
    DB::table('password_resets')->updateOrInsert(
        ['email' => $request->email],
        [
            'token' => $token,
            'created_at' => Carbon::now()
        ]
    );

    // Send token to user via email
    Mail::raw("Votre code de réinitialisation est : $token", function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Code de réinitialisation du mot de passe');
    });
    session()->put('reset_email', $request->email);

    return redirect()->route('user.confirmation')->with('email', $request->email);


}
public function verifyResetCode(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'code' => 'required|numeric'
    ]);

    // Vérifier le code dans la table password_resets
    $record = DB::table('password_resets')
        ->where('email', $request->email)
        ->where('token', $request->code)
        ->first();

    if (!$record) {
        return back()->withErrors(['code' => 'Le code est incorrect ou expiré.']);
    }

    // Stocker le token pour la page de changement de mot de passe
     // Redirige vers la vue du nouveau mot de passe avec email + token en session
     return redirect()->route('user.newpass')->with([
        'reset_email' => $request->email,
        'token' => $request->code
    ]);
}
public function submitNewPassword(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
        'token' => 'required|numeric',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $record = DB::table('password_resets')
        ->where('email', $request->email)
        ->where('token', $request->token)
        ->first();

    if (!$record) {
        return back()->withErrors(['token' => 'Code invalide ou expiré.']);
    }

    $user = User::where('email', $request->email)->first();
    $user->password = Hash::make($request->password);
    $user->save();

    // Clean up token
    DB::table('password_resets')->where('email', $request->email)->delete();

    return redirect()->route('home.connexion')->with('success', 'Mot de passe réinitialisé avec succès.');
}


}

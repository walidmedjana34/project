<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController 
{
    // ✅ User Registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'required|string|max:20',
            'location' => 'nullable|string|max:100', // ✅ Fixed location validation
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // ✅ Securely hashing password
            'phone' => $request->phone,
            'location' => $request->location, // ✅ Now saving location
            'role' => 'user',
        ]);

        return response()->json([
            'message' => 'User registered successfully!',
            'user' => $user
        ], 201);
    }

    // ✅ User Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Login successful!',
                'user' => Auth::user(),
            ]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // ✅ User Logout
    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Logout successful']);
    }

    // ✅ Update User Information
    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'nullable|string|max:255',
        'email' => 'nullable|email|unique:users,email,' . $user->id,
        'phone' => 'nullable|string|max:20',
        'location' => 'nullable|string|max:100',
    ]);

    $user->update($request->only(['name', 'email', 'phone', 'location']));

    return redirect()->route('user-management')->with('success', 'Utilisateur mis à jour avec succès !');
}


    // ✅ List All Users (for user management view)
    public function index()
    {
        $users = User::all(); // Retrieve all users from the database
        return view('laravel-examples.user-management', ['users' => $users]);
    }
    public function destroy(User $user)
{
    $user->delete();

    return redirect()->route('user-management')->with('success', 'Utilisateur supprimé avec succès !');
}
public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'phone' => 'nullable|string|max:20',
        'location' => 'nullable|string|max:100',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // Hachage du mot de passe
        'phone' => $request->phone,
        'location' => $request->location,
    ]);

    return redirect()->route('user-management')->with('success', 'Utilisateur ajouté avec succès !');
}
public function indexx()
{
    $users = Auth::user(); // Retrieve all users from the database
    return view('client.dashboard', compact('users'));
}

}


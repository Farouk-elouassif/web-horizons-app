<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller{

    function showLoginForm(){
        return view("auth.login");
    }

    function showRegistrationForm(){
        return view("auth.register");
    }

    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Get the authenticated user
            $user = Auth::user();

            // Redirect based on the user's role
            if ($user->role === 'Éditeur') {
                return redirect()->route('editeur.dashboard');
            } elseif ($user->role ===  'Responsable de thème') {
                return redirect()->route('respo.dashboard');
            } elseif ($user->role === 'Abonné' ) {
                return redirect()->route('user.articles');
            }

        }

        // If login fails, redirect back with errors
        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);



    }

    public function register(Request $request){
        // Validate the request
        $request->validate([
            'first_name' => 'required|string|max:255', // Validate first name
            'last_name' => 'required|string|max:255',  // Validate last name
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Combine first name and last name into 'nom'
        $nom = $request->first_name . ' ' . $request->last_name;

        // Create the user
        $user = User::create([
            'nom' => $nom, // Use the combined name
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'statut' => 'Inactif',
            'role' => 'Abonné', // Default role
            'date_inscription' => now(), // Current timestamp
        ]);

        // Log the user in
        auth()->login($user);

        // Redirect to the user dashboard
        return redirect()->route('themes');
    }

    function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route("home"));
    }

    public function store(Request $request){
        // Validate the request
        $request->validate([
            'themes' => 'required|string', // Themes are sent as a comma-separated string
        ]);

        // Get the authenticated user's ID
        $user = Auth::user();

        // Split the comma-separated string into an array of theme IDs
        $themeIds = explode(',', $request->themes);

        // Loop through the selected theme IDs and store them in the database
        foreach ($themeIds as $themeId) {
            Subscription::create([
                'date_abonnement' => now(),
                'user_id' => $user->id,
                'theme_id' => $themeId,
            ]);
        }

        // Redirect or return a response
        return redirect()->route('user.dashboard');
    }
}

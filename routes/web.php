<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserControlle;
use App\Models\Theme;


// login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// register form
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// home route
Route::get('/', function () {
    return view('home');
});

Route::get('/topics', function () {
    $themes = Theme::all();
    return view('topics', compact('themes'));
})->name('topics');

Route::get('/profile', function () {
    $user = Auth::user();

    // Fetch all articles created by the logged-in user with the required columns
    $articles = $user->articles()
        ->select('id', 'titre', 'contenu', 'statut', 'date_proposition', 'date_publication', 'theme_id', 'user_id', 'created_at', 'updated_at')
        ->get();

    // Pass the articles to the view
    return view('user.profile', compact('articles', 'user'));

})->name('user.profile');


// Protect the routes with the 'auth' middleware
Route::middleware('auth')->group(function () {
    // User dashboard route
    Route::get('/user/dashboard', [UserControlle::class, 'getArticles'])->name('user.dashboard');

    // Admin dashboard route
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Admin dashboard view
    })->name('admin.dashboard');

    Route::delete('/article/delete/{id}', [UserControlle::class, 'deleteArticle'])->name('article.delete');

    // Create post routes
    Route::get('/createPoste', [UserControlle::class, 'showCreatePoste'])->name('createPoste.form');
    Route::post('/createPoste', [UserControlle::class, 'createPoste'])->name('createPoste.submit');

    Route::get('/themes', function () {
        return view('auth.themes');
    });
// Route to display the themes page
Route::get('/themes', function () {
    $themes = Theme::all(); // Fetch all themes from the database
    return view('auth.themes', compact('themes'));
})->name('themes');

// Route to handle theme selection submission
Route::post('/subscriptions', [AuthController::class, 'store'])->name('subscriptions.store');
});



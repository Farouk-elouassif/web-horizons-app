<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserControlle;
use App\Http\Controllers\invitedController;
use App\Http\Controllers\ResponsableThemeController;
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
Route::get('/', function () {return view('home');})->name('home');
// about route
Route::get('/about', function () {return view('about');})->name('about');

Route::get('/write', function () {return view('user.write');});

// tpics route
Route::get('/topics', function () {
    $themes = Theme::all();
    return view('topics', compact('themes'));
})->name('topics');




// Protect the routes with the 'auth' middleware
Route::middleware('auth')->group(function () {
    // User dashboard route
    Route::get('/user/dashboard', [UserControlle::class, 'getArticles'])->name('user.dashboard');

    // Admin dashboard route
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Admin dashboard view
    })->name('admin.dashboard');

    // delete post route
    Route::delete('/article/delete/{id}', [UserControlle::class, 'deleteArticle'])->name('article.delete');

    // Create post routes
    Route::get('/user/write', [UserControlle::class, 'showCreatePoste'])->name('write.form');
    Route::post('/user/write', [UserControlle::class, 'createPoste'])->name('write.submit');


    // Route to display the themes page
    Route::get('/themes', function () {
        $themes = Theme::all(); // Fetch all themes from the database
        return view('auth.themes', compact('themes'));
    })->name('themes');

    // Route to handle theme selection submission
    Route::post('/subscriptions', [AuthController::class, 'store'])->name('subscriptions.store');
});

Route::get('/invited', [invitedController::class, 'show'])->name('invited');
Route::get('/article/{id}', [UserControlle::class, 'showArticlePage'])->name('article.show');
Route::get('/user/articles', [UserControlle::class, 'showUserHomePage'])->name('user.articles');

Route::get('user/analytics', [UserControlle::class, 'showAnalytics'])->name('user.analytics');
Route::post('/rate-article', [UserControlle::class, 'rateArticle'])->name('rate.article');

Route::post('/user/add-theme', [UserControlle::class, 'addThemeToFollowing'])->name('user.addTheme');
Route::delete('/topics/{id}', [UserControlle::class, 'deleteTopic'])->name('user.deleteSub');

Route::get('user/history', [UserControlle::class, 'showHistory'])->name('user.history');

Route::get('responsable/dashboard', [ResponsableThemeController::class, 'showDashboard'])->name('respo.dashboard');
Route::delete('/articles/{article}', [ResponsableThemeController::class, 'destroy'])->name('article.destroy');
Route::post('/articles/{article}/publish', [ResponsableThemeController::class, 'publish'])->name('article.publish');
Route::post('/articles/{article}/deny', [ResponsableThemeController::class, 'deny'])->name('article.deny');

Route::get('responsable/articles',[ResponsableThemeController::class, 'manageArticles'])->name('article.manager');
Route::get('responsable/subscribers',[ResponsableThemeController::class, 'managesubscribers'])->name('subscribers.manager');
Route::delete('/subscription/{id}', [ResponsableThemeController::class, 'deleteSubscription'])->name('subscription.delete');


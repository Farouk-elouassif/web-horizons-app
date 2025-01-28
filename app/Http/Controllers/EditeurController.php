<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Subscription;
use App\Models\Theme;
use App\Models\ArticleNote;
use App\Models\NavigationHistory;
use App\Models\User;
use App\Models\Numero;

use Illuminate\Http\Request;

class EditeurController extends Controller
{
    public function showDashboard(){
        $user = Auth::user();
        $users = User::all();
        $articlesCount = Article::count();
        $numerosCount = Numero::count();
        $themesCount = Theme::count();
        $responsables = DB::table('theme_user')->count();
        $totalArticlesRead = NavigationHistory::count();
        $latestUsers = User::orderBy('created_at', 'desc')->take(4)->get();
        $latestArticles = Article::orderBy('created_at', 'desc')->take(3)->get();
        return view('editeur.dashboard', compact(
            'users',
            'articlesCount',
            'numerosCount',
            'themesCount',
            'responsables',
            'totalArticlesRead',
            'latestUsers',
            'latestArticles'
            ));
    }

    public function manageArticles(){
        $articles = Article::orderBy('created_at', 'desc')->get();
        return view('editeur.articles_editeur', compact('articles'));
    }

    public function manageUsers(){
        $users = User::orderBy('created_at', 'desc')->get();
        return view('editeur.users_editeur', compact('users'));
    }

    public function userStatut(User $user){
        if($user->statut == 'Actif'){
            $user->update(['statut' => 'Inactif']);
        } else {
            $user->update(['statut' => 'Actif']);
        }
        return redirect()->back();
    }

    public function deleteUser(User $userToDelete){
        $userToDelete->delete();
        return redirect()->back();
    }

    public function showManagers(){
        $responsables = DB::table('theme_user')->get();
        return view('editeur.respTheme_editeur', compact('responsables'));
    }

}

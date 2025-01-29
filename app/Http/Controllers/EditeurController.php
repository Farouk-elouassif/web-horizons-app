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
        $themes = Theme::all();
        return view('editeur.users_editeur', compact('users', 'themes'));
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

    public function promoteUser(Request $request, User $user) {

            DB::beginTransaction();

            // Get theme ID from request
            $themeId = $request->input('theme');

            // Verify theme exists
            $theme = Theme::findOrFail($themeId);

            // Update user role
            $user->update(['role' => 'Responsable de thème']);

            // Attach user to theme
            $user->themes()->attach($themeId);

            DB::commit();
            return redirect()->back()->with('success', 'User promoted successfully!');

    }


    public function demoteUser(User $user){
        $user->update(['role' => 'Abonné']);
        return redirect()->back();

        DB::table('theme_user')->where('user_id', $user->id)->delete();
        return redirect()->back();
    }

    public function manageThemes(){
        $themes = Theme::all();
        return view('editeur.themes_editeur', compact('themes'));
    }

    public function deleteTheme(Theme $theme){
        $theme->delete();
        return redirect()->back();
    }

    public function addTheme(Request $request){
        Theme::create([
            'nom_theme' => $request->nom_theme,
            'description' =>$request->description,
            'created_at' => now(),
        ]);

        return redirect()->back();
    }

    public function numerosManager(){
        $numeros = Numero::all();
        return view('editeur.numeros_editeur', compact('numeros'));
    }

    public function deleteNumero($id){
        $numero = Numero::where('Id_numero', $id)->firstOrFail();
        $numero->delete();
        return redirect()->back();
    }

    public function desactivateNumero($id){
        $numero = Numero::where('Id_numero', $id)->firstOrFail();
        $numero->update(['statut' => 'Désactivé']);
        return redirect()->back();
    }

    public function publieNumero($id){
        $numero = Numero::where('Id_numero', $id)->firstOrFail();
        $numero->update(['statut' => 'Publié']);
        return redirect()->back();
    }

    public function addNumero(Request $request){
        Numero::create([
            'titre_numero' => $request->titre_numero,
            'statut' => 'Désactivé',
            'date_publication' =>now(),
            'created_at' => now()
        ]);

        return redirect()->back();
    }

}

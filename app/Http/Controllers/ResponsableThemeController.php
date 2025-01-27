<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Subscription;
use App\Models\Numero;
class ResponsableThemeController extends Controller{

    public function showDashboard(){

        // Get the authenticated user
        $user = Auth::user();

        // Fetch the single theme the user is responsible for
        $theme = $user->themes()->first();

        // Count the number of articles for the theme
        $articlePublieCount = $theme->articles()->where('statut', 'Publié')->count();
        $articleEnCourCount = $theme->articles()->where('statut', 'En cours')->count();
        $articleRefuseCount = $theme->articles()->where('statut', 'Refusé')->count();
        $articleCount = $theme->articles()->count();

        // Count the number of subscribers for the theme
        $subscriberCount = $theme->subscribers()->count();

        //Fetch articles with status "En cours" for the theme
        $inProgressArticles = $theme->articles()->where('statut', 'En cours')->orderBy('created_at', 'desc')->get();

        $latestSubscribers = $theme->subscribers()
            ->orderBy('pivot_created_at', 'desc') // Order by subscription date (pivot table)
            ->take(3) // Limit to the last 3 users
            ->get();

        // Pass the theme and subscriber count to the view
        return view('responsable_theme.dashboard', compact(
            'theme',
            'subscriberCount',
            'articleEnCourCount',
            'articlePublieCount',
            'articleRefuseCount',
            'articleCount',
            'inProgressArticles',
            'user',
            'latestSubscribers'
        ));
    }

    // Method to delete an article
    public function destroy(Article $article){
        // Delete the article
        $article->delete();

        // Return a success response
        return redirect()->back();
    }

    // Method to publish an article
    public function publish(Article $article){
        // Check if the article is in "En cours" status
        if ($article->status != 'Publié') {
            // Update the status to "Publié"
            $article->update(['statut' => 'Publié']);

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Article published successfully!');
        }

        // If the article is not in "En cours" status, return an error
        return redirect()->back()->with('error', 'Article cannot be published.');
    }

    // Method to DENY an article
    public function deny(Article $article){
            $article->update(['statut' => 'Refusé']);
            return redirect()->back()->with('success', 'Article published successfully!');
    }

    public function manageArticles(){
        // Get the authenticated user
        $user = Auth::user();
        $numeros = Numero::all();
        // Fetch the single theme the user is responsible for
        $theme = $user->themes()->first();
        $articles = $theme->articles()
            ->orderBy('created_at', 'desc')
            ->get();
        $articlesCount = $theme->articles()->count();

        return view('responsable_theme.articles_section', compact(
            'theme',
            'articles',
            'articlesCount',
            'numeros'
        ));
    }

    public function manageSubscribers(){

        $user = Auth::user();
        ;
        $theme = $user->themes()->first();
        $subscribers = $theme->subscribers()->get();
        return view('responsable_theme.subscribers_section', compact('user', 'theme', 'subscribers'));
    }

    public function deleteSubscription($user_id){
        $user = Auth::user();

        $theme = $user->themes()->first();
        Subscription::where('user_id', $user_id)
                    ->where('theme_id', $theme->id)
                    ->delete();

        return redirect()->back();

    }

    public function suggestArticleForNumero(Request $request, Article $article){
        $request->validate([
            'numero_id' => 'required|exists:numeros,id_numero',
        ]);

        $numero = Numero::find($request->numero_id);

        $article->numeros()->attach($numero->id_numero);

        return redirect()->back();
    }




}

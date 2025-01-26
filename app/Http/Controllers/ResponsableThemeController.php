<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
class ResponsableThemeController extends Controller
{
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
        $inProgressArticles = $theme->articles()->where('statut', 'En cours')->get();

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
    public function destroy(Article $article)
    {
        // Delete the article
        $article->delete();

        // Return a success response
        return redirect()->back();
    }


    // Method to publish an article
    public function publish(Article $article)
    {
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

        // Fetch the single theme the user is responsible for
        $theme = $user->themes()->first();
        $articles = $theme->articles()->get();
        $articlesCount = $theme->articles()->count();

        return view('responsable_theme.articles_section', compact(
            'theme',
            'articles',
            'articlesCount'
        ));
    }

}

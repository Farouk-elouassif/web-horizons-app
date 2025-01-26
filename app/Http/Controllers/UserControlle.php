<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Subscription;
use App\Models\Theme;
use App\Models\ArticleNote;
use App\Models\NavigationHistory;
use Illuminate\Support\Facades\Auth;

class UserControlle extends Controller {
    // Show the form to create a post
    public function showCreatePoste(){
        $user = Auth::user();
        $subscribedThemes = $user->subscribedThemes;
        return view("user.write", compact('subscribedThemes', 'user'));
    }

    public function createPoste(Request $request){
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255', // Validate title
            'article' => 'required|string',       // Validate article content
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        if($user->role === 'Abonné'){
            // Create the article and associate it with the user
            $article = Article::create([
                'titre' => $request->title,
                'contenu' => $request->article,
                'statut' => 'En cours', // Default status
                'theme_id' => $request->theme,  // You can update this to dynamically assign a theme
                'user_id' => $user->id, // Associate the article with the logged-in user
                'date_proposition' => now(),
            ]);
        }else {
            // Create the article and associate it with the user
            $article = Article::create([
                'titre' => $request->title,
                'contenu' => $request->article,
                'statut' => 'Publié', // Default status
                'theme_id' => $request->theme,  // You can update this to dynamically assign a theme
                'user_id' => $user->id, // Associate the article with the logged-in user
                'date_proposition' => now(),
            ]);
        }


        // Redirect back with a success message
        return redirect()->route('user.dashboard');
    }

    public function getArticles(){
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch all articles created by the logged-in user with the required columns
        $articles = $user->articles()
            ->select('id', 'titre', 'contenu', 'statut', 'date_proposition', 'date_publication', 'theme_id', 'user_id', 'created_at', 'updated_at')
            ->get();

        $articles->each(function ($article) {
            $article->averageRating = ArticleNote::where('article_id', $article->id)->avg('note');
        });


        // Pass the articles to the view
        return view('user.profile', compact('articles', 'user'));
    }

    public function deleteArticle($id){
        // Find the article by ID
        $article = Article::find($id);

        // Check if the article exists and belongs to the logged-in user
        if ($article && $article->user_id === Auth::id()) {
            $article->delete(); // Delete the article
            return redirect()->route('user.dashboard')->with('success', 'Article deleted successfully!');
        }

        // If the article doesn't exist or doesn't belong to the user, redirect with an error message
        return redirect()->route('user.dashboard')->with('error', 'Article not found or you do not have permission to delete it.');
    }

    public function showArticlePage($id){
        // Find the article by ID
        $article = Article::findOrFail($id);
        $user = Auth::user();

        $NavigationHistory = NavigationHistory::create([
            'date_consultation' => now(),
            'user_id' => $user->id,
            'article_id' => $id
        ]);

        // Pass the article to the view
        return view('user.article', compact('article', 'user'));
    }

    public function showUserHomePage(){
        // Get the authenticated user
        $user = Auth::user();

        // Fetch the user's subscribed themes using the correct relationship
        $subscribedThemes = $user->subscribedThemes;

        // Check if the user has subscribed themes
        // if ($subscribedThemes->isEmpty()) {
        //     return view('user.articles', ['articles' => []]);
        // }

        // Fetch articles related to the subscribed themes, excluding the authenticated user's posts
        $articles = Article::whereIn('theme_id', $subscribedThemes->pluck('id'))
            ->where('user_id', '!=', $user->id)// Exclude the authenticated user's posts
            ->where('statut', 'Publié')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate the average rating for each article
        $articles->each(function ($article) {
            $article->averageRating = ArticleNote::where('article_id', $article->id)->avg('note');
        });

        // Shuffle the articles collection
        $shuffledArticles = $articles->shuffle();

        return view('user.homePageUser', compact('shuffledArticles', 'user', 'subscribedThemes'));
    }

    public function showAnalytics(){
        // Get the authenticated user
        $user = Auth::user();

        // Fetch the user's subscribed themes
        $subscribedThemes = $user->subscribedThemes;

        // Fetch all themes that the user is NOT subscribed to
        $unsubscribedThemes = Theme::whereNotIn('id', $subscribedThemes->pluck('id'))->get();

        // Fetch all articles written by the user
        $articles = $user->articles()
            ->select('id', 'titre', 'contenu', 'statut', 'date_proposition', 'date_publication', 'theme_id', 'user_id', 'created_at', 'updated_at')
            ->get();

        // Fetch the IDs of the user's articles
        $articleIds = $articles->pluck('id');

        // Calculate the average rating for the user's articles
        $averageRating = ArticleNote::whereIn('article_id', $articleIds)->avg('note');

        $articlesHistory = NavigationHistory::where('user_id', $user->id)
                                            ->with('article')
                                            ->count();

        // Pass the data to the view
        return view('user.analytics', compact('user', 'articles', 'subscribedThemes', 'unsubscribedThemes', 'averageRating', 'articlesHistory'));
    }

    public function rateArticle(Request $request){
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'rating' => 'required|integer|between:1,5'
        ]);

        $userId = auth()->id();

        // Check if the user has already rated the article
        $existingRating = ArticleNote::where('user_id', $userId)
            ->where('article_id', $request->article_id)
            ->first();

        if ($existingRating) {
            $existingRating->update(['note' => $request->rating]);
        } else {
            ArticleNote::create([
                'user_id' => $userId,
                'article_id' => $request->article_id,
                'note' => $request->rating,
                'date_note' => now()
            ]);
        }

        // Redirect back to the same page with a success message
        return redirect()->back();
    }

    public function addThemeToFollowing(Request $request){
        $request->validate([
            'theme_id' => 'required|exists:themes,id',
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Add the selected theme to the user's subscriptions
        Subscription::create([
            'user_id' => $user->id,
            'theme_id' => $request->theme_id,
            'date_abonnement' => now(),
        ]);

        return redirect()->back();
    }

    public function deleteTopic($themeId){

        $user = Auth::user();

        Subscription::where('user_id', $user->id)
                    ->where('theme_id', $themeId)
                    ->delete();

        return redirect()->back();
    }

    public function showHistory(){
        $user = Auth::user();
        $articlesHistory = NavigationHistory::where('user_id', $user->id)
                                            ->with('article')
                                            ->get();
        return view('user.history', compact('user', 'articlesHistory'));
    }
}

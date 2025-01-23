<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Theme;
use App\Models\ArticleNote;
use Illuminate\Support\Facades\Auth;

class UserControlle extends Controller {
    // Show the form to create a post
    public function showCreatePoste(){
        $user = Auth::user();
        $themes = Theme::all();
        return view("user.write", compact('themes', 'user'));
    }

    // Handle the form submission to create a post
    public function createPoste(Request $request){
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255', // Validate title
            'article' => 'required|string',       // Validate article content
        ]);

        // Get the currently authenticated user
        $user = Auth::user();

        // Create the article and associate it with the user
        $article = Article::create([
            'titre' => $request->title,
            'contenu' => $request->article,
            'statut' => 'En cours', // Default status
            'theme_id' => $request->theme,  // You can update this to dynamically assign a theme
            'user_id' => $user->id, // Associate the article with the logged-in user
            'date_proposition' => now(),
        ]);

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

        // Pass the article to the view
        return view('user.article', compact('article', 'user'));
    }

    public function showUserHomePage()
{
    // Get the authenticated user
    $user = Auth::user();

    // Fetch the user's subscribed themes using the correct relationship
    $subscribedThemes = $user->subscribedThemes;

    // Check if the user has subscribed themes
    if ($subscribedThemes->isEmpty()) {
        return view('user.articles', ['articles' => []]);
    }

    // Fetch articles related to the subscribed themes, excluding the authenticated user's posts
    $articles = Article::whereIn('theme_id', $subscribedThemes->pluck('id'))
        ->where('user_id', '!=', $user->id) // Exclude the authenticated user's posts
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
        $user = Auth::user();
        $subscribedThemes = $user->subscribedThemes;
        $articles = $user->articles()
            ->select('id', 'titre', 'contenu', 'statut', 'date_proposition', 'date_publication', 'theme_id', 'user_id', 'created_at', 'updated_at')
            ->get();
        return view('user.analytics', compact('user', 'articles', 'subscribedThemes'));
    }

    public function rateArticle(Request $request)
{
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
    return redirect()->back()->with('success', 'Rating submitted successfully!');
}

}

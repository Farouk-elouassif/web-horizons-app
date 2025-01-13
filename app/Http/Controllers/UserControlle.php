<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Theme;
use Illuminate\Support\Facades\Auth;

class UserControlle extends Controller
{
    // Show the form to create a post
    public function showCreatePoste(){
        $themes = Theme::all();
        return view("user.createPoste", compact('themes'));
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
            'statu' => false, // Default status
            'theme_id' => $request->theme,  // You can update this to dynamically assign a theme
            'user_id' => $user->id, // Associate the article with the logged-in user
            'date_proposition' => now(),
        ]);

        // Redirect back with a success message
        return redirect()->route('createPoste.form')->with('success', 'Article created successfully!');
    }

    public function getArticles(){
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch all articles created by the logged-in user
        $articles = $user->articles;

        // Pass the articles to the view
        return view('user.dashboard', compact('articles'));
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
}

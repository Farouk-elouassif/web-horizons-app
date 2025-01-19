<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Models\Theme;
use Illuminate\Http\Request;

class invitedController extends Controller
{
    function show(){
        $articles = Article::all();
        $themes = Theme::all();
        return view('invited', compact('articles', 'themes'));
    }
}

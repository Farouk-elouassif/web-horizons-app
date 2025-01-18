<?php

namespace App\Http\Controllers;
use App\Models\Article;
use Illuminate\Http\Request;

class invitedController extends Controller
{
    function show(){
        $articles = Article::all();
        return view('invited', compact('articles'));
    }
}

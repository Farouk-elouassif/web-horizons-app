<?php
// app/Http/Controllers/EditorController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Numero;

class EditorController extends Controller
{
    public function dashboard()
    {
        return view('editor.dashboard');
    }
}

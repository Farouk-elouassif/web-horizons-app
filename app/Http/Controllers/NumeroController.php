<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Numero;

class NumeroController extends Controller
{
    /**
     * Affiche le formulaire de publication d'un numéro.
     */
    public function create()
    {
        return view('editor.createNumero');
    }

    /**
     * Traite la soumission du formulaire de publication d'un numéro.
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'published_at' => 'required|date',
        ]);

        // Création du numéro
        Numero::create([
            'title' => $request->title,
            'description' => $request->description,
            'published_at' => $request->published_at,
            'status' => 'published', // Par défaut, le numéro est publié
        ]);

        // Redirection avec un message de succès
        return redirect()->route('numeros.create')->with('success', 'Le numéro a été publié avec succès !');
    }
}
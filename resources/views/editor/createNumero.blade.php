<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier un Numéro</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/createnum.css') }}">
</head>
<body>
    <div class="container">
        <h1>Publier un Nouveau Numéro</h1>

        <!-- Affichage des messages de succès ou d'erreur -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulaire de publication d'un numéro -->
        <form action="{{ route('numeros.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Titre du Numéro</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="published_at">Date de Publication</label>
                <input type="date" name="published_at" id="published_at" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Publier</button>
        </form>
    </div>
</body>
</html>
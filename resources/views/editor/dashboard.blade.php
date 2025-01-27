<!-- resources/views/editor/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord - Éditeur</title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/dash.css') }}">
</head>
<body>
    <div class="container">
        <!-- En-tête -->
        <div class="header">
            <h1>Tableau de Bord - Éditeur</h1>
            <p>Gérez les numéros, les utilisateurs et consultez les statistiques.</p>
        </div>

        <!-- Grille Principale -->
        <div class="dashboard-grid">
            <!-- Section Statistiques -->
            <div class="stats-section">
                <h2>Statistiques</h2>
                <div class="stats-cards">
                    <div class="stat-card">
                        <h3>150</h3>
                        <p>Abonnés Actifs</p>
                    </div>
                    <div class="stat-card">
                        <h3>25</h3>
                        <p>Numéros Publiés</p>
                    </div>
                    <div class="stat-card">
                        <h3>1,200</h3>
                        <p>Articles Publiés</p>
                    </div>
                </div>
            </div>

            <!-- Section Gestion des Numéros -->
            <div class="manage-section">
                <h2>Gestion des Numéros</h2>
                <div class="actions">
                    <button class="btn"><a href="/numeros/create">Publier un Nouveau Numéro</a></button>
                    <button class="btn">Voir les Numéros Publiés</button>
                    <button class="btn">Modifier un Numéro</button>
                    <button class="btn btn-danger">Supprimer un Numéro</button>
                </div>
            </div>

            <!-- Section Gestion des Utilisateurs -->
            <div class="manage-section">
                <h2>Gestion des Utilisateurs</h2>
                <div class="actions">
                    <button class="btn">Ajouter un Utilisateur</button>
                    <button class="btn">Modifier un Utilisateur</button>
                    <button class="btn btn-danger">Supprimer un Utilisateur</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/dash.js') }}"></script>
</body>
</html>
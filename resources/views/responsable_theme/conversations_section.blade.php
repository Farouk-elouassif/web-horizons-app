<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/respo_theme_dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/conversations.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Gestion des Conversations - Tech Horizons</title>
</head>
<body>
    @include('responsable_theme.navbar_respo') <!-- Include the navbar here -->

    <div class="main-content">
        <h1>Gestion des Conversations</h1>
        <div class="filters">
            <select id="statusFilter">
                <option value="all">Tous les statuts</option>
                <option value="open">Ouvertes</option>
                <option value="closed">Fermées</option>
            </select>
            <input type="text" id="searchInput" placeholder="Rechercher des conversations...">
        </div>
        <table>
            <thead>
                <tr>
                    <th>Article</th>
                    <th>Auteur</th>
                    <th>Dernier message</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="conversationsTableBody">
                <!-- Hardcoded example row -->
                <tr>
                    <td>L'Impact de l'IA sur l'Industrie Automobile</td>
                    <td>Jean Dupont</td>
                    <td>Merci pour votre article !</td>
                    <td>15/05/2023</td>
                    <td class="actions">
                        <button class="delete-btn" onclick="deleteConversation()">Supprimer</button>
                    </td>
                </tr>
                <tr>
                    <td>Les Avancées de la Biotechnologie</td>
                    <td>Marie Curie</td>
                    <td>Très instructif !</td>
                    <td>10/04/2023</td>
                    <td class="actions">
                        <button class="delete-btn" onclick="deleteConversation()">Supprimer</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>

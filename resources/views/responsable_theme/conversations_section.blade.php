
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/respo_theme_dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/conversations.css')}}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Gestion des Conversations - Tech Horizons</title>
</head>
<body>
    @include('responsable_theme.navbar_respo') <!-- Include the navbar here -->

    <div class="main-content">
        <h1>{{$theme->nom_theme}} Conversations Manager</h1>
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
                @foreach ($themeArticles as $article)
                    <tr>
                        <td><a href="{{ route('article.show', $article->id) }}" target="_blank">{{ $article->titre }}</a></td>
                        <td>{{ $article->author->nom }}</td>
                        <td>
                            {{-- Get the latest conversation --}}
                            {{ $article->conversations->last()->message ?? 'No conversations' }}
                        </td>
                        <td>{{$article->created_at->format('M d, Y - H:i')}}</td>
                        <td class="actions">
                            <button class="delete-btn" onclick="deleteConversation()">Supprimer</button>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>
</html>

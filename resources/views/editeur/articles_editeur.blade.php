<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/respo_theme_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/articles_respo_section.css') }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Articles Manager - Tech Horizons</title>
</head>
<body>
    @include('editeur.navbar_editeur')

    <div class="main-content">
        <h1>Tech Horizon Articles ({{$articles->count()}})</h1>
        <div class="filters">
            <select id="statusFilter" onchange="filterArticles()">
                <option value="all">Tous les statuts</option>
                <option value="Publié">Publié</option>
                <option value="En cours">En cours</option>
                <option value="Refusé">Refusé</option>
            </select>
            <input type="text" id="searchInput" placeholder="Rechercher des articles..." oninput="filterArticles()">
        </div>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Thème</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="articlesTableBody">
                @foreach ($articles as $article)
                    <tr>
                        <td><a href="{{ route('article.show', $article->id) }}" target="_blank">{{ $article->titre }}</a></td>
                        <td>{{ $article->author->nom }}</td>
                        <td>{{ $article->theme->nom_theme }}</td>
                        <td>
                            @if ($article->statut === 'Publié')
                                <span class="status status-published">Publié</span>
                            @elseif($article->statut === 'En cours')
                                <span class="status status-review">En cours</span>
                            @elseif($article->statut === 'Refusé')
                                <span class="status status-draft">Refusé</span>
                            @endif
                        </td>
                        <td>{{ $article->created_at->format('M d, Y - H:i') }}</td>
                        <td class="actions" style="padding: 2rem;">
                            <form action="{{ route('article.destroy', $article->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p id="noResultsMessage" style="display: none; text-align: center; margin-top: 20px;">Aucun résultat trouvé.</p>
    </div>

    <script>
        function filterArticles() {
            const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#articlesTableBody tr');

            rows.forEach(row => {
                // Correcting the column index for status (4th column)
                const statusCell = row.querySelector('td:nth-child(4) .status').textContent.toLowerCase();
                const titleCell = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const authorCell = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                // Matching filters
                const matchesStatus = statusFilter === 'all' || statusCell === statusFilter;
                const matchesSearch = titleCell.includes(searchInput) || authorCell.includes(searchInput);

                // Display or hide row
                if (matchesStatus && matchesSearch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/respo_theme_dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/articles_respo_section.css')}}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Gestion des Articles - Tech Horizons</title>
    <style>
        /* Modal styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 50%;
            max-width: 500px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }
    </style>
</head>
<body>
    @include('responsable_theme.navbar_respo')

    <div class="main-content">
        <h1>{{$theme->nom_theme}} Articles Manager</h1>
        <div class="filters">
            <select id="statusFilter" onchange="filterArticles()">
                <option value="all">Tous les statuts</option>
                <option value="Publié">Publiés</option>
                <option value="EnCours">En Cours</option>
                <option value="Refusé">Refusés</option>
            </select>
            <input type="text" id="searchInput" placeholder="Rechercher des articles..." oninput="filterArticles()">
        </div>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Statut</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="articlesTableBody">
                @foreach ($articles as $article)
                    <tr>
                        <td><a href="{{ route('article.show', $article->id) }}" target="_blank">{{$article->titre}}</a></td>
                        <td>{{($article->author)->nom}}</td>
                        <td>
                            @if ($article->statut === 'Publié')
                                <span class="status status-published">Publié</span>
                            @elseif($article->statut === 'En cours')
                                <span class="status status-review">EnCours</span>
                            @elseif($article->statut === 'Refusé')
                                <span class="status status-draft">Refusé</span>
                            @endif
                        </td>
                        <td>{{$article->created_at->format('M d, Y')}}</td>
                        <td class="actions">
                            <form action="{{ route('article.destroy', $article->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                            <button class="suggest-btn" onclick="openModal({{ $article->id }})">Suggérer</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="suggestModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Suggérer pour un numéro</h2>
            <form id="suggestForm" action="{{ route('suggest.numero', ['article' => $article->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="article_id" id="articleId">
                <label for="numero_id">Sélectionner un numéro:</label>
                <select name="numero_id" id="numero_id">
                    @foreach ($numeros as $numero)
                        <option value="{{ $numero->id }}">{{ $numero->titre_numero }}</option>
                    @endforeach
                </select>
                <button type="submit">Suggérer</button>
            </form>
        </div>
    </div>

    <script>
        function filterArticles() {
            const statusFilter = document.getElementById('statusFilter').value.toLowerCase();
            const searchInput = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#articlesTableBody tr');

            rows.forEach(row => {
                const statusCell = row.querySelector('td:nth-child(3) .status').textContent.toLowerCase();
                const titleCell = row.querySelector('td:nth-child(1)').textContent.toLowerCase();
                const authorCell = row.querySelector('td:nth-child(2)').textContent.toLowerCase();

                const matchesStatus = statusFilter === 'all' || statusCell.includes(statusFilter);
                const matchesSearch = titleCell.includes(searchInput) || authorCell.includes(searchInput);


                if (matchesStatus && matchesSearch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
        // Function to open the modal
        function openModal(articleId) {
    console.log("Article ID:", articleId); // Debugging line
    document.getElementById('articleId').value = articleId;
    document.getElementById('suggestModal').style.display = 'block';
}

        // Function to close the modal
        function closeModal() {
            document.getElementById('suggestModal').style.display = 'none';
        }

        // Close the modal when clicking outside the modal
        window.onclick = function(event) {
            const modal = document.getElementById('suggestModal');
            if (event.target == modal) {
                closeModal();
            }
        };
    </script>
</body>
</html>

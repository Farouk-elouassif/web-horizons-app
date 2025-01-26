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
        /* Add your custom styles here */
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
                        <td ><a href="{{ route('article.show', $article->id) }}" target="_blank">{{$article->titre}}</a></td>
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
                            <button class="suggest-btn" onclick="openSuggestModal()">Suggérer</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="suggestModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Suggérer pour un numéro</h2>
            <form id="suggestForm">
                <input type="number" id="issueNumber" placeholder="Numéro du magazine" required>
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

        // Modal functionality
        const modal = document.getElementById('suggestModal');
        const closeBtn = document.getElementsByClassName('close')[0];
        const suggestForm = document.getElementById('suggestForm');

        function openSuggestModal() {
            modal.style.display = 'block';
        }

        closeBtn.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        suggestForm.onsubmit = function(e) {
            e.preventDefault();
            const issueNumber = document.getElementById('issueNumber').value;
            alert(`Article suggéré pour le numéro ${issueNumber}`);
            modal.style.display = 'none';
            suggestForm.reset();
        }

        // Sidebar toggle functionality (if needed)
        const toggleSidebarBtn = document.getElementById('toggleSidebar');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');

        if (toggleSidebarBtn) {
            toggleSidebarBtn.onclick = function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
        }
    </script>
</body>
</html>

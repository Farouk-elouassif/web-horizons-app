<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/respo_theme_dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/subscribers_section.css')}}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Users Manager - Tech Horizons</title>
</head>
<body>
    @include('editeur.navbar_editeur')

    <div class="main-content">
        <h1>Tech Horizon Managers Manager ({{$responsables->count()}})</h1>
        <div class="filters">
            <select id="statusFilter">
                <option value="all">Tous les statuts</option>
                <option value="actif">Actifs</option>
                <option value="inactif">Inactifs</option>
            </select>
            <input type="text" id="searchInput" placeholder="Rechercher des abonnements...">
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Role</th>
                    <th>Date d'abonnement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="subscriptionsTableBody">
                @foreach ($responsables as $respo)
                    <tr>
                        <td>{{$respo->nom}}</td>
                        <td>{{$respo->email}}</td>
                        <td>
                            @if($respo->statut == 'Inactif')
                                <span class="status status-inactive">{{$respo->statut}}</span>
                            @else
                                <span class="status status-active">{{$respo->statut}}</span>
                            @endif
                        </td>
                        <td>{{$respo->role}}</td>
                        <td>{{$respo->created_at->format('M d, Y - H:i')}}</td>
                        <td class="actions" style="padding: 1.5rem">
                            <form action="{{ route('editeur.userStatut', $respo->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @if($respo->statut == 'Inactif')
                                    <button type="submit" class="activate-btn" onclick="return confirm('Are you sure you want to activate this user?')">Activate</button>
                                @else
                                    <button type="submit" class="block-btn" onclick="return confirm('Are you sure you want to block this user?')">Block</button>
                                @endif
                            </form>

                            <form action="{{route('editeur.deleteUser', $respo->id)}}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        // Toggle active class for nav items
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(item => {
            item.addEventListener('click', function() {
                navItems.forEach(i => i.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Toggle sidebar
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.main-content');

        toggleSidebar.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // Filter functionality
        const statusFilter = document.getElementById('statusFilter');
        const searchInput = document.getElementById('searchInput');
        const subscriptionsTableBody = document.getElementById('subscriptionsTableBody');


    // Fonction pour filtrer les abonnements
        function filterSubscriptions() {
            const status = statusFilter.value.toLowerCase(); // Filtrer par statut
            const searchTerm = searchInput.value.toLowerCase(); // Terme de recherche

            // Parcourir chaque ligne du tableau
            Array.from(subscriptionsTableBody.getElementsByTagName('tr')).forEach(row => {
                const statusCell = row.getElementsByTagName('td')[2]?.textContent.trim().toLowerCase(); // Colonne Statut
                const nameCell = row.getElementsByTagName('td')[0]?.textContent.trim().toLowerCase(); // Colonne Nom
                const emailCell = row.getElementsByTagName('td')[1]?.textContent.trim().toLowerCase(); // Colonne Email

                // Vérifier les correspondances
                const statusMatch = (status === 'all') || (statusCell === status);
                const searchMatch = nameCell.includes(searchTerm) || emailCell.includes(searchTerm);

                // Afficher ou masquer la ligne selon les correspondances
                row.style.display = (statusMatch && searchMatch) ? '' : 'none';
            });
        }

        // Ajouter les écouteurs d'événements
        document.addEventListener('DOMContentLoaded', () => {
            const statusFilter = document.getElementById('statusFilter');
            const searchInput = document.getElementById('searchInput');
            const subscriptionsTableBody = document.getElementById('subscriptionsTableBody');

            if (statusFilter && searchInput && subscriptionsTableBody) {
                statusFilter.addEventListener('change', filterSubscriptions);
                searchInput.addEventListener('input', filterSubscriptions);

                // Appliquer les filtres initiaux
                filterSubscriptions();
            }
        });


    </script>
</body>
</html>

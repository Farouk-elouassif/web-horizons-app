<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/respo_theme_dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/subscribers_section.css')}}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Gestion des Abonnements - Tech Horizons</title>

</head>
<body>
    @include('responsable_theme.navbar_respo') <!-- Include the navbar here -->

    <div class="main-content">
        <h1>{{$theme->nom_theme}} Subscribers Manager</h1>
        <div class="filters">
            <select id="statusFilter">
                <option value="all">Tous les statuts</option>
                <option value="actif">Actifs</option>
                <option value="inactive">Inactifs</option>
            </select>
            <input type="text" id="searchInput" placeholder="Rechercher des abonnements...">
        </div>
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Date d'abonnement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="subscriptionsTableBody">
                @foreach ($subscribers as $subscriber)
                    <tr>
                        <td>{{$subscriber->nom}}</td>
                        <td>{{$subscriber->email}}</td>
                        <td><span class="status status-active">{{$subscriber->statut}}</span></td>
                        <td>{{$subscriber->created_at->format('M d, Y - H:i')}}</td>
                        <td class="actions">
                            <form action="{{ route('subscription.delete', $subscriber->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="event.stopPropagation(); return confirm('Are you sure you want to delete?')">Delete Subscription</button>
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
        // Filter and search functionality
        const statusFilter = document.getElementById('statusFilter');
        const searchInput = document.getElementById('searchInput');
        const subscriptionsTableBody = document.getElementById('subscriptionsTableBody');

        statusFilter.addEventListener('change', filterSubscriptions);
        searchInput.addEventListener('input', filterSubscriptions);

        function filterSubscriptions() {
            const status = statusFilter.value;
            const searchTerm = searchInput.value.toLowerCase();

            Array.from(subscriptionsTableBody.getElementsByTagName('tr')).forEach(row => {
                const statusCell = row.getElementsByTagName('td')[2];
                const nameCell = row.getElementsByTagName('td')[0];
                const emailCell = row.getElementsByTagName('td')[1];

                const rowStatus = statusCell.textContent.toLowerCase();
                const rowName = nameCell.textContent.toLowerCase();
                const rowEmail = emailCell.textContent.toLowerCase();

                const statusMatch = status === 'all' || rowStatus.includes(status);
                const searchMatch = rowName.includes(searchTerm) || rowEmail.includes(searchTerm);

                if (statusMatch && searchMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>

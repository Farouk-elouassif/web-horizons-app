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
    @include('editeur.navbar_editeur') <!-- Include the navbar here -->

    <div class="main-content">
        <h1>Subscribers Manager</h1>
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
                    <th>Role</th>
                    <th>Date d'abonnement</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="subscriptionsTableBody">
                @foreach ($users as $subscriber)
                    <tr>
                        <td>{{$subscriber->nom}}</td>
                        <td>{{$subscriber->email}}</td>
                        <td>
                            @if($subscriber->statut == 'Inactif')
                                <span class="status status-inactive">{{$subscriber->statut}}</span>
                            @else
                                <span class="status status-active">{{$subscriber->statut}}</span>
                            @endif
                        </td>
                        <td>{{$subscriber->role}}</td>
                        <td>{{$subscriber->created_at->format('M d, Y - H:i')}}</td>
                        <td class="actions" style="padding: 1.5rem">
                            <form action="{{ route('editeur.userStatut', $subscriber->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @if($subscriber->statut == 'Inactif')
                                    <button type="submit" class="activate-btn" onclick="return confirm('Are you sure you want to activate this user?')">Activate</button>
                                @else
                                    <button type="submit" class="block-btn" onclick="return confirm('Are you sure you want to block this user?')">Block</button>
                                @endif
                            </form>

                            <form action="" method="POST" style="display: inline;">
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
        function filterSubscriptions() {
    const status = statusFilter.value.toLowerCase(); // Get selected status filter
    const searchTerm = searchInput.value.toLowerCase(); // Get search input value

    // Loop through each row in the table
    Array.from(subscriptionsTableBody.getElementsByTagName('tr')).forEach(row => {
        const statusCell = row.getElementsByTagName('td')[2].textContent.toLowerCase(); // Status column
        const nameCell = row.getElementsByTagName('td')[0].textContent.toLowerCase(); // Name column
        const emailCell = row.getElementsByTagName('td')[1].textContent.toLowerCase(); // Email column

        // Check if the status matches or if "Tous les statuts" is selected
        const statusMatch = status === 'all' || statusCell === status;

        // Check if the search term matches the name or email
        const searchMatch = nameCell.includes(searchTerm) || emailCell.includes(searchTerm);

        // Show row if both status and search conditions are met
        if (statusMatch && searchMatch) {
            row.style.display = ''; // Show row
        } else {
            row.style.display = 'none'; // Hide row
        }
    });
}

    </script>
</body>
</html>

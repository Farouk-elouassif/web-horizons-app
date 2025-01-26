<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/respo_theme_dashboard.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Gestion des Abonnements - Tech Horizons</title>
    <style>
        /* Global styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
        }

        body {
            background-color: rgb(236, 230, 224);
            display: flex;
        }

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            width: calc(100% - 280px);
            transition: margin-left 0.3s ease, width 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 0;
            width: 100%;
        }

        h1{
            margin-bottom: 15px
        }

        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background-color: #f8f8f8;
            font-weight: 600;
        }

        .status {
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .status-active {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .status-inactive {
            background-color: #ffebee;
            color: #c62828;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        button {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.875rem;
            transition: background-color 0.2s;
        }

        .delete-btn {
            background-color: #ffebee;
            color: #c62828;
        }

        .delete-btn:hover {
            background-color: #ffcdd2;
        }

        .activate-btn {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .activate-btn:hover {
            background-color: #c8e6c9;
        }

        .filters {
            display: flex;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        select, input {
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    @include('responsable_theme.navbar_respo') <!-- Include the navbar here -->

    <div class="main-content">
        <h1>{{$theme->nom_theme}} Subscribers Manager</h1>
        <div class="filters">
            <select id="statusFilter">
                <option value="all">Tous les statuts</option>
                <option value="active">Actifs</option>
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
                <!-- Hardcoded example row -->
                @foreach ($subscribers as $subscriber)
                    <tr>
                        <td>{{$subscriber->nom}}</td>
                        <td>{{$subscriber->email}}</td>
                        <td><span class="status status-active">{{$subscriber->statut}}</span></td>
                        <td>{{$subscriber->created_at->format('M d, Y')}}</td>
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

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Manager - Tech Horizons</title>

    <link rel="stylesheet" href="{{ asset('css/respo_theme_dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/subscribers_section.css') }}">
    <link rel="icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    @include('editeur.navbar_editeur')

    <div class="main-content">
        <h1>Tech Horizon Users Manager ({{$users->count()}})</h1>

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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="subscriptionsTableBody">
                @foreach ($users as $subscriber)
                    <tr>
                        <td>{{ $subscriber->nom }}</td>
                        <td>{{ $subscriber->email }}</td>
                        <td>
                            <span class="status {{ $subscriber->statut == 'Inactif' ? 'status-inactive' : 'status-active' }}">
                                {{ $subscriber->statut }}
                            </span>
                        </td>
                        <td>{{ $subscriber->role }}</td>
                        <td class="actions" style="padding: 1.5rem">
                            <form action="{{ route('editeur.userStatut', $subscriber->id) }}" method="POST" class="inline-form">
                                @csrf
                                <button type="submit" class="{{ $subscriber->statut == 'Inactif' ? 'activate-btn' : 'block-btn' }}"
                                    onclick="return confirm('Are you sure you want to {{ $subscriber->statut == 'Inactif' ? 'activate' : 'block' }} this user?')">
                                    {{ $subscriber->statut == 'Inactif' ? 'Activate' : 'Block' }}
                                </button>
                            </form>

                            <form action="{{ route('editeur.deleteUser', $subscriber->id) }}" method="POST" class="inline-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete?')">
                                    Delete
                                </button>
                            </form>

                            @if($subscriber->role == 'Abonné')
                                <button type="button" class="activate-btn promote-btn" data-user-id="{{ $subscriber->id }}">
                                    Promote
                                </button>
                            @else
                                <form action="{{ route('editeur.demoteUser', $subscriber->id) }}" method="POST" class="inline-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="block-btn"
                                        onclick="return confirm('Are you sure you want to demote this user?')">
                                        Demote
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div id="promotionModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close-btn">&times;</span>
                <h2>Choisir un thème pour le Responsable</h2>
                <form id="promotionForm" action="" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" id="userId">

                    <label for="theme">Sélectionnez un thème :</label>
                    <select name="theme" id="theme" required>
                        <option value="">-- Choisir un thème --</option>
                        @foreach ($themes as $theme)
                            <option value="{{ $theme->id }}">{{ $theme->nom_theme }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="activate-btn">Promote</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const statusFilter = document.getElementById('statusFilter');
            const searchInput = document.getElementById('searchInput');
            const subscriptionsTableBody = document.getElementById('subscriptionsTableBody');

            function filterSubscriptions() {
                const status = statusFilter.value.toLowerCase();
                const searchTerm = searchInput.value.toLowerCase();

                Array.from(subscriptionsTableBody.getElementsByTagName('tr')).forEach(row => {
                    const [nameCell, emailCell, statusCell] = row.getElementsByTagName('td');

                    const statusMatch = status === 'all' || statusCell.textContent.trim().toLowerCase() === status;
                    const searchMatch = nameCell.textContent.toLowerCase().includes(searchTerm) ||
                                        emailCell.textContent.toLowerCase().includes(searchTerm);

                    row.style.display = statusMatch && searchMatch ? '' : 'none';
                });
            }

            statusFilter.addEventListener('change', filterSubscriptions);
            searchInput.addEventListener('input', filterSubscriptions);
        });

        document.addEventListener('DOMContentLoaded', () => {
        const modal = document.getElementById('promotionModal');
        const closeModal = document.querySelector('.close-btn');
        const form = document.getElementById('promotionForm');
        const userIdInput = document.getElementById('userId');

        document.querySelectorAll('.promote-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const userId = this.getAttribute('data-user-id');
                userIdInput.value = userId;
                form.action = `/editeur/promote-user/${userId}`; // Updated path
                modal.style.display = 'flex';
            });
        });

        closeModal.addEventListener('click', () => modal.style.display = 'none');

        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                modal.style.display = 'none';
            }
        });
    });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Articles - Tech Horizons</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Arial, sans-serif;
        }

        body {
            background-color: rgb(236, 230, 224);
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 1rem;
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

        .status-published {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .status-draft {
            background-color: #fff3e0;
            color: #e65100;
        }

        .status-review {
            background-color: #e3f2fd;
            color: #1565c0;
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

        .suggest-btn {
            background-color: #e8f5e9;
            color: #2e7d32;
        }

        .suggest-btn:hover {
            background-color: #c8e6c9;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 300px;
            border-radius: 4px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        #suggestForm {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        #suggestForm input {
            width: 100%;
        }

        #suggestForm button {
            align-self: flex-end;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestion des Articles</h1>
        <div class="filters">
            <select id="statusFilter">
                <option value="all">Tous les statuts</option>
                <option value="published">Publiés</option>
                <option value="draft">Brouillons</option>
                <option value="review">En révision</option>
            </select>
            <input type="text" id="searchInput" placeholder="Rechercher des articles...">
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
                <!-- Hardcoded example row -->
                <tr>
                    <td>L'Impact de l'IA sur l'Industrie Automobile</td>
                    <td>Jean Dupont</td>
                    <td>Intelligence Artificielle</td>
                    <td><span class="status status-published">Publié</span></td>
                    <td>15/05/2023</td>
                    <td class="actions">
                        <button class="delete-btn" onclick="deleteArticle()">Supprimer</button>
                        <button class="suggest-btn" onclick="openSuggestModal()">Suggérer</button>
                    </td>
                </tr>
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
        const modal = document.getElementById('suggestModal');
        const closeBtn = document.getElementsByClassName('close')[0];
        const suggestForm = document.getElementById('suggestForm');

        function deleteArticle() {
            if (confirm("Êtes-vous sûr de vouloir supprimer cet article ?")) {
                alert("Article supprimé !");
                // Here you would typically remove the article from the table or backend
            }
        }

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
    </script>
</body>
</html>

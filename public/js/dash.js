// public/js/editor-dashboard.js

// Exemple : Gestion des boutons
const buttons = document.querySelectorAll('.btn');

buttons.forEach(button => {
    button.addEventListener('click', () => {
        const action = button.textContent.toLowerCase();
        switch (action) {
            case 'publier un nouveau numéro':
                alert('Publier un nouveau numéro');
                break;
            case 'voir les numéros publiés':
                alert('Voir les numéros publiés');
                break;
            case 'modifier un numéro':
                alert('Modifier un numéro');
                break;
            case 'supprimer un numéro':
                if (confirm('Êtes-vous sûr de vouloir supprimer ce numéro ?')) {
                    alert('Numéro supprimé !');
                }
                break;
            case 'ajouter un utilisateur':
                alert('Ajouter un utilisateur');
                break;
            case 'modifier un utilisateur':
                alert('Modifier un utilisateur');
                break;
            case 'supprimer un utilisateur':
                if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) {
                    alert('Utilisateur supprimé !');
                }
                break;
            default:
                alert('Action non reconnue');
        }
    });
});
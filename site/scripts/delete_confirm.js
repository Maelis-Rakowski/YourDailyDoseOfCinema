$(document).ready(function() {
    // Gestionnaire d'événements pour les boutons de suppression
    $('.delete-form').on('submit', function(e) {
        // Afficher la fenêtre de confirmation
        var confirmation = confirm('Are you sure you want to delete this element ?');
        // Si l'utilisateur clique sur "Annuler", empêcher la soumission du formulaire
        if (!confirmation) {
            e.preventDefault();
        }
    });
}); 
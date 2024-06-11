$(function() {
    // Gestionnaire d'événements pour les boutons de suppression
    $('.delete-button').on('click', function(e) {
        // Afficher la fenêtre de confirmation
        var confirmation = confirm('Are you sure you want to delete this element ?');
        // Si l'utilisateur clique sur "Annuler", empêcher la soumission du formulaire
        if (!confirmation) {
            e.preventDefault();
        } else {
            let idToDelete = $(this).data('id');
            let dataType = $('table').data('element-type')
            let idField = dataType + "_id"
            $.post({
                url : "/admin/movie/delete",
                dataType: 'json',
                data: { [idField]: idToDelete }
            });
            // On supprime la ligne
            $('#' + idToDelete).remove()
        }
    });
}); 
<?php
 foreach ($datamovies['results'] as $movie) {
    // Construire l'URL de l'image à partir du chemin fourni
    $imageUrl = 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'];

    echo 'Titre : ' . htmlspecialchars($movie['title']) . '';
    echo 'Date de sortie : ' . htmlspecialchars($movie['release_date']) . '';
    echo 'Overview : ' . htmlspecialchars($movie['overview']) . '';

    // Afficher les genres du film
    foreach ($movie['genre_ids'] as $genre) {
        echo '---GenreId : ' . htmlspecialchars($genre) . '';
    }

    echo 'Note : ' . htmlspecialchars($movie['vote_average']) . '';
    echo 'Nombre de votes : ' . htmlspecialchars($movie['vote_count']) . '';
    echo '<img src="' . htmlspecialchars($imageUrl) . '" alt="' . htmlspecialchars($movie['title']) . '">';

    // Formulaire pour ajouter le film
    echo '<form action="/admin/tmdb/addMovie" method="POST">
            <input type="hidden" name="idmovie" value="' . htmlspecialchars($movie['id']) . '">
            <input type="submit" value="Ajouter ce film">
          </form>';
}
?>
<?php



foreach ($datamovies['results'] as $movie) {
    // Construire l'URL de l'image à partir du chemin fourni
    $imageUrl = 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'];

    echo 'Titre : ' . htmlspecialchars($movie['title']) . '<br>';
    echo 'Date de sortie : ' . htmlspecialchars($movie['release_date']) . '<br>';
    echo 'Overview : ' . htmlspecialchars($movie['overview']) . '<br>';

    // Afficher les genres du film
    foreach ($movie['genre_ids'] as $genre) {
        echo '---GenreId : ' . htmlspecialchars($genre) . '<br>';
    }

    echo 'Note : ' . htmlspecialchars($movie['vote_average']) . '<br>';
    echo 'Nombre de votes : ' . htmlspecialchars($movie['vote_count']) . '<br>';
    echo '<img src="' . htmlspecialchars($imageUrl) . '" alt="' . htmlspecialchars($movie['title']) . '"><br>';

    // Formulaire pour ajouter le film
    echo '<form action="/admin/tmdb/addMovie" method="POST">
            <input type="hidden" name="idmovie" value="' . htmlspecialchars($movie['id']) . '">
            <input type="submit" value="Ajouter ce film">
          </form><br><br>';
}

// Le foreach génère du code HTML qui va être récupéré par la fonction done(function(response_html)) du post AJAX

?>
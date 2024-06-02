<div class="container mt-5">
    <div class="row border shadow-sm p-3 mb-5 bg-white rounded">
        <div class="col-md-4">
            <!-- Affiche du film -->
            <img src="<?= "https://image.tmdb.org/t/p/w500" . $movie->getPosterPath() ?>" alt="Affiche de <?= htmlspecialchars($movie->getTitle()) ?>" class="img-fluid rounded">
        </div>
        <div class="col-md-8">
            <!-- Détails du film -->
            <h2><?= htmlspecialchars($movie->getTitle()) ?></h2>
            <h4>Date de sortie :</h4>
            <p><?= htmlspecialchars($movie->getReleaseDate()) ?></p>
            <h4>Résumé</h4>
            <p><?= htmlspecialchars($movie->getOverview()) ?></p>
            <h4>Durée :</h4>
            <p><?= htmlspecialchars($movie->getRuntime()) ?> minutes</p>
            <h4>Slogan</h4>
            <q><?= htmlspecialchars($movie->getTagline()) ?></q>
            <h4>Genres</h4>
            <p><?php
                $genres_string = "";
                foreach ($movie->getGenres() as $genre) {
                    $genres_string .= ", " . htmlspecialchars($genre);
                }
                echo ltrim($genres_string, ', ');
            ?></p>
            <h4>Réalisateurs</h4>
            <p><?php
                $director_str = "";
                foreach ($movie->getDirectors() as $director) {
                    $director_str .= ", " . htmlspecialchars($director);
                }
                echo ltrim($director_str, ', ');
            ?></p>
            <h4>Pays</h4>
            <p><?php
                $countries_str = "";
                foreach ($movie->getCountries() as $country) {
                    $countries_str .= ", " . htmlspecialchars($country);
                }
                echo ltrim($countries_str, ', ');
            ?></p>
        </div>
    </div>
</div>
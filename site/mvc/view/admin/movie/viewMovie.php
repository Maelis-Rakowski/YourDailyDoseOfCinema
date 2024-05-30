<div>
    <h2><?= $movie->getTitle() ?></h2>
    <h3>Release date :</h3>
    <p> <?= $movie->getReleaseDate() ?></p>
    <h3>Runtime : </h3>
    <p><?= $movie->getRuntime() ?> minutes </p>
    <h3>Tagline</h3>
    <q><?= $movie->getTagline() ?></q>
    <h3>Genres</h3>
    <p><?php 
        $genres_string = "" ;
        foreach ($movie->getGenres() as $genre) {
            $genres_string = $genres_string . ", " . $genre;
        } 
        echo ltrim($genres_string, ', ');
    
    ?>
    </p>
    <h3>Directors</h3>
    <p><?php 
        $director_str = "";
        foreach ($movie->getDirectors() as $director) {
            $director_str = $director_str . ", " . $director;
        } 
        echo ltrim($director_str, ', ');
    
    ?>
    </p>
    <h3>Countries</h3>
    <p><?php 
        $countries_str = "";
        foreach ($movie->getDirectors() as $country) {
            $countries_str = $countries_str . ", " . $country;
        } 
        echo ltrim($countries_str, ', ');
    ?>
    </p>
</div>
<?php foreach ($datamovies['results'] as $movie): ?>
  <div class="">
    <div class="">
      <h2><?= htmlspecialchars($movie['title']) ?></h2>
      <p>Date de sortie : <?= htmlspecialchars($movie['release_date']) ?></p>
      <p>Overview : <?= htmlspecialchars($movie['overview']) ?></p>
      <p>Note : <?= htmlspecialchars($movie['vote_average']) ?></p>
      <p>Nombre de votes : <?= htmlspecialchars($movie['vote_count']) ?></p>
    </div>
    <img class="" src="<?= htmlspecialchars('https://image.tmdb.org/t/p/w500' . $movie['poster_path']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">

    <!-- Formulaire pour ajouter le film -->
    <div id="answer<?= $movie['id'] ?>">
      <button type="button" onclick="addMovie(<?= $movie['id'] ?>)">Ajouter</button>
    </div>
  </div>
<?php endforeach; ?>
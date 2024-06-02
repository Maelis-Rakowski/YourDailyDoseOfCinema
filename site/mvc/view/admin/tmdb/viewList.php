<?php foreach ($datamovies['results'] as $movie): ?>
  <div class="row m-4">
    <div class="col-md-2 d-flex justify-content-center align-items-center">
      <img class="img-fluid rounded w-50" src="<?= htmlspecialchars('https://image.tmdb.org/t/p/w500' . $movie['poster_path']) ?>" alt="<?= htmlspecialchars($movie['title']) ?>">
    </div>
    <div class="col-md-10">
        <h2><?= htmlspecialchars($movie['title']) ?></h2>
        <p>Release Date : <?= htmlspecialchars($movie['release_date']) ?></p>
        <p>Overview : <?= htmlspecialchars($movie['overview']) ?></p>
        <p>Note : <?= htmlspecialchars($movie['vote_average']) ?></p>
        <p>Vote Count : <?= htmlspecialchars($movie['vote_count']) ?></p>
    </div>
    <!-- Formulaire pour ajouter le film -->
    <div id="answer<?= $movie['id'] ?>">
      <button type="button" onclick="addMovie(<?= $movie['id'] ?>)">Add</button>
    </div>
  </div>
<?php endforeach; ?>
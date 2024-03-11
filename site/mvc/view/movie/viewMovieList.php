<main>
    <?php foreach ($movies as $movie): ?>
        <p><?php var_dump($movie)?></p>
        <form method="GET" action="/movie/details">
            <input type="hidden" name="id" value="<?= htmlspecialchars($movie->getId()) ?>">
            <input type="submit" value="Détails">
        </form>
    <?php endforeach;?>
</main>
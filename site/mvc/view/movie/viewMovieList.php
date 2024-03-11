<main>
<table>
    <tr>
        <th>Title</th>
        <th>Release Date</th>
        <th>Runtime</th>
        <th>Overview</th>
    </tr>
    
    <?php foreach ($movies as $movie): ?>
            <td><?= htmlspecialchars($movie->getTitle()) ?></td>
            <td><?= htmlspecialchars($movie->getReleaseDate()) ?></td>
            <td><?= htmlspecialchars($movie->getRuntime()) ?></td>
            <td><?= htmlspecialchars($movie->getOverview()) ?></td>
            <td>
                <form method="GET" action="/movie/details">
                    <input type="hidden" name="id" value="<?= $movie->getId() ?>">
                    <input type="submit" value="Détails">
                </form>
            </td>
    <?php endforeach;?>
</main>
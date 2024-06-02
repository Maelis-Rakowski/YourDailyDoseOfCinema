<div>
    <div class="container p-5">
        <?php $this->_t="Movie List"?>

        <table class="table table-striped" >
        <thead>
            <tr>
                <th>Title</th>
                <th>Release Date</th>
                <th>Runtime</th>
                <th>Overview</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie): ?>
                <tr>
                    <td><?= htmlspecialchars($movie->getTitle()) ?></td>
                    <td><?= htmlspecialchars($movie->getReleaseDate()) ?></td>
                    <td><?= htmlspecialchars($movie->getRuntime()) ?></td>
                    <td><?= htmlspecialchars($movie->getOverview()) ?></td>
                    <td>
                        <form method="GET" action="/admin/movie/details">
                            <input type="hidden" name="id" value="<?= $movie->getId() ?>">
                            <input type="submit" value="Détails">
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
        </table>
    </div>
</div>
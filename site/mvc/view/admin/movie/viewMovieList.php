<div>
    <div class="container p-5">
        <?php $this->_t="Movie List"?>

        <table class="table table-striped" data-element-type="movie">
        <thead>
            <tr>
                <th>Title</th>
                <th>Release Date</th>
                <th>Runtime</th>
                <th>Overview</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($movies as $movie): ?>
                <tr id=<?= htmlspecialchars($movie->getId()) ?>>
                    <td><?= htmlspecialchars($movie->getTitle()) ?></td>
                    <td><?= htmlspecialchars($movie->getReleaseDate()) ?></td>
                    <td><?= htmlspecialchars($movie->getRuntime()) ?></td>
                    <td><?= htmlspecialchars($movie->getOverview()) ?></td>
                    <td>
                        <form method="GET" action="/admin/movie/details">
                            <input type="hidden" name="id" value="<?= $movie->getId() ?>">
                            <input type="submit" value="More">
                        </form>
                    </td>
                    <td>
                    <button class="btn btn-danger delete-button" data-id="<?= htmlspecialchars($movie->getId()) ?>">Delete</button>
                    
                    </td>
                </tr>
            <?php endforeach;?>
        </tbody>
        </table>
    </div>
</div>
<script src="/scripts/data_list.js"></script>
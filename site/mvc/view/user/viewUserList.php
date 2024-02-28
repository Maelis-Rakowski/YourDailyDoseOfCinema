<main>
    <table>
        <tr>
            <th>Login</th>
            <th>Password</th>
            <th>Email</th>
            <th>Pseudo</th>
            <th>Admin</th>
        </tr>
        
        <?php foreach ($users as $obj): ?>
                <td><?= htmlspecialchars($obj->getId()) ?></td>
                <td><?= htmlspecialchars($obj->getPassword()) ?></td>
                <td><?= htmlspecialchars($obj->getEmail()) ?></td>
                <td><?= htmlspecialchars($obj->getPseudo()) ?></td>
                <td><?= htmlspecialchars($obj->getIsAdmin()) ?></td>
            </tr>
        <?php endforeach;?>
    </table>
</main>

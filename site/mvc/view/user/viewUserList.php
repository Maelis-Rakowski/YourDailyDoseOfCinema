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
                <td>
                    <form method="POST" action="/user/openViewToModifyUser">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($obj->getId()) ?>">
                        <input type="hidden" name="user_password" value="<?= htmlspecialchars($obj->getPassword()) ?>">
                        <input type="hidden" name="user_email" value="<?= htmlspecialchars($obj->getEmail()) ?>">
                        <input type="hidden" name="user_pseudo" value="<?= htmlspecialchars($obj->getPseudo()) ?>">
                        <input type="hidden" name="user_isAdmin" value="<?= htmlspecialchars($obj->getIsAdmin()) ?>">
                        <input type="submit" value="Modifier">
                    </form>
                </td>
                <td>
                    <form method="POST" action="/user/deleteUser">
                        <input type="hidden" name="user_id" value="<?= htmlspecialchars($obj->getId()) ?>">
                        <input type="submit" value="Supprimer">
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
</main>

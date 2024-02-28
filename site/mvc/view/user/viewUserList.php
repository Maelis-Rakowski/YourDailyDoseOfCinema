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
                <td><?= $obj->getId() ?></td>
                <td><?= $obj->getPassword() ?></td>
                <td><?= $obj->getEmail() ?></td>
                <td><?= $obj->getPseudo() ?></td>
                <td><?= $obj->getIsAdmin() ?></td>
            </tr>
        <?php endforeach;?>
    </table>
</main>

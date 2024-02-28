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
            <tr>
                <td><?php $obj->getLogin()      ?></td>
                <td><?php $obj->getPassword()   ?></td>
                <td><?php $obj->getEmail()      ?></td>
                <td><?php $obj->getPseudo()     ?></td>
                <td><?php $obj->getIsAdmin()    ?></td>
            </tr>
        <?php endforeach;
        f;ezkpfezkofjzeiojfeziof,eziofjeziofeziofjezoifjeziofjezio?>
    </table>
</main>

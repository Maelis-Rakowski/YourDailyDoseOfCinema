<main>
    <table>
        <tr>
            <th>Login</th>
            <th>Password</th>
            <th>Email</th>
            <th>Pseudo</th>
            <th>Admin</th>
        </tr>
        
        <?php print_r($users); foreach ($users as $obj): ?>
            
            <tr>
                <td><?php $obj->getId()  ;       ?></td>
                <td><?php $obj->getPassword() ;  ?></td>
                <td><?php $obj->getEmail() ;     ?></td>
                <td><?php $obj->getPseudo()  ;   ?></td>
                <td><?php $obj->getIsAdmin();    ?></td>
            </tr>
        <?php endforeach;?>
    </table>
</main>

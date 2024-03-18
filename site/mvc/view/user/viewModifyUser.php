<main>

    <h2>Modification du User id : <?=$user_id?></h2>
    <form action="/user/modifyUser" method="POST">
        <ul>
            <input type="hidden" name="user_id" value=" <?= $user_id ?>">
            <li>
                <label for="new_user_pseudo">New Pseudo : </label><br>
                <input name="new_user_pseudo" type="text" value="<?=$user_pseudo?>"><br><br>
            </li>
            <li>
                <label for="new_user_email">New email : </label><br>
                <input name="new_user_email" type="email" value="<?=$user_email?>"><br><br>
            </li>
            <li>
                <label for="new_user_isAdmin">Admininistrator : </label> 
                
                <input name="new_user_isAdmin" type="checkbox"
                    <?php $checked = ($user_isAdmin == 1) ? "checked" : "" ?>
                    <?=$checked?>         
                ><br><br>
            </li>
            <li>                
                <input type="submit" value="Valider mes modifications"><br><br>
            </li>
        </ul>
    </form>
</main>

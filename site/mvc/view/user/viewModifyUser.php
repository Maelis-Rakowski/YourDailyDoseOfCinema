<main>

    <h2>Modification du User id : <?=$user_id?></h2>
    <form action="?controller=user&action=modifyUser" method="POST">
        <ul>
            <input type="hidden" name="user_id" value=" <?= $user_id ?>">
            <li>
                <label for="new_user_pseudo">New Pseudo : </label><br>
                <input name="new_user_pseudo" type="text" placeholder="last : <?=$user_pseudo?>"><br><br>
            </li>
            <li>
                <label for="new_user_password">New password : </label><br>
                <input name="new_user_password" type="password" placeholder="last : <?=$user_password?>"><br><br>
            </li>
            <li>
                <label for="new_user_email">New email : </label><br>
                <input name="new_user_email" type="text" placeholder="last : <?=$user_email?>"><br><br>
            </li>
            <li>
                <label for="new_user_isAdmin">New status : </label><br>
                <input name="new_user_isAdmin" type="text" placeholder="last : <?=$user_isAdmin?>"><br><br>
            </li>
            <li>
                
                <input type="submit" value="Valider mes modifications"><br><br>
            </li>
        </ul>
    </form>
</main>
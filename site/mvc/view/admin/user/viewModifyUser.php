<?php $this->_t="ModifyUser"?>
<main class="form-container">

    <h2>Modification du User id : <?=$user_id?></h2>
    <form action="/user/modifyUser" method="POST">
        <ul>
            <input type="hidden" name="user_id" value=" <?= $user_id ?>">
            <li>
                <label for="new_user_pseudo">New Pseudo : </label>
                <input name="new_user_pseudo" type="text" value="<?=$user_pseudo?>">
            </li>
            <li>
                <label for="new_user_email">New email : </label>
                <input name="new_user_email" type="email" value="<?=$user_email?>">
            </li>
            <li>
                <label for="new_user_isAdmin">Admininistrator : </label> 
                
                <input name="new_user_isAdmin" type="checkbox"
                    <?php $checked = ($user_isAdmin == 1) ? "checked" : "" ?>
                    <?=$checked?>         
                >
            </li>
            <li>                
                <input type="submit" value="Valider mes modifications">
            </li>
        </ul>
    </form>
</main>

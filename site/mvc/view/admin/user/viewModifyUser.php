<?php $this->_t="ModifyUser"?>
<div class="form-container">

    <h2>Modification du User id : <?=$user_id?></h2>
    <form action="/admin/user/modifyUser" method="POST">
        <ul>
            <input type="hidden" name="user_id" value=" <?= $user_id ?>">
            <li>
                <label for="new_user_pseudo">Pseudo : <?=$user_pseudo?></label>
                <input name="new_user_pseudo" type="hidden" value="<?=$user_pseudo?>">
            </li>
            <li>
                <label for="new_user_email">Email : <?=$user_email?></label>
                <input name="new_user_email" type="hidden" value="<?=$user_email?>">
            </li>
            <li>
                <label for="new_user_isAdmin">Admininistrator : </label> 
                
                <input name="new_user_isAdmin" type="checkbox"
                    <?php $checked = ($user_isAdmin == 1) ? "checked" : "" ?>
                    <?=$checked?>         
                >
            </li>
            <li>                
                <input type="submit" value="Submit Changes">
            </li>
        </ul>
    </form>
</div>

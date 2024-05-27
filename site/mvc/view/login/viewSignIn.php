<?php $this->_t="SignIn"?>
<main class="form-container">
    <h2>Sign In</h2>
    <form method="POST" action="/login/signIn">
        <ul>
            <li>
                <label for="pseudo">Pseudo</label>
                <input name="pseudo" type="text">
            </li>
            <li>
                <label for="password">Password</label>
                <input name="password" type="password">

                <?php 
                    if($error == "errorConnexion") {
                        echo("<div class='error' id='loginTooltip'>Erreur dans la saisie de votre identifiant ou de votre mot de passe</div>");
                    }                   
                ?>
            </li>
            <li>
                <input type="submit" value="Sign In">
            </li>
        </ul>
    </form>
    <h2>Forgot Password ?</h2>
    <form method="POST" action="sendEmail" target="_blank">
        <ul>
            <li>
                <label for="email">Email</label>
                <input name="email" type="text">
            </li>

            <li>
                <input type="submit" value="Send Mail">
            </li>
        </ul>       
    </form>
</main>
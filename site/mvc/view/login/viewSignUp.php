<?php $this->_t="SignUp"?>
<div class="form-container">
<h2>Sign Up</h2>
    <form method="POST" action="/login/signUp">
        <ul>
            <li>
                <label for="pseudo">Pseudo</label>
                <input required id="pseudo" class="pseudo" name="pseudo" type="text">
                <div id="pseudoToolTip">Ce pseudo à déjà été prit.</div>
            </li>
            <li>
                <label for="email">E-mail</label>
                <input id="email" required class="emailInput" name="email" type="email">
                <div id="emailToolTip">Veuillez selectionner une adresse mail valide.</div>
            </li>
            <li>
                <label for="password">Password</label>
                <input id="password" required class="passwordInput" name="password" type="password">
                
                <div id="helpPassword">
                    <p id = "pwd_eightCar"> Le mot de passe doit contenir au moins 8 caractères           </p>
                    <p id = "pwd_special">  Le mot de passe doit contenir au moins un caractère special   </p>
                    <p id = "pwd_maj">      Le mot de passe doit contenir au moins un caractère majuscule </p>
                    <p id = "pwd_min">      Le mot de passe doit contenir au moins un caractère minuscule </p>
                    <p id = "pwd_number">   Le mot de passe doit contenir au moins un chiffre             </p>
                </div>      
            </li>
            <li>
                <label for="password2">Confirm password</label>
                <input id="password2" required class="confirmPassword" name="password2" type="password">    
                <p id="pwdMatchTooltip">Passwords doesnt match</p>  
            </li>
            <li>
                <input disabled id="submitBtn" type="submit" value="Sign Up">
            </li>
        </ul>   
        
    </form>
    <div>
        Already have an acccount ?       
        <a class="link" href="/login/signInView">Sign In</a>
    </div>
</div>
<script src="/scripts/login.js"></script>



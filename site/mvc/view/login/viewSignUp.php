<main>
    <form method="POST" action="/login/signUp">
        <ul>
            <li>
                <label for="pseudo">Pseudo</label>
                <input required name="pseudo" type="text">
            </li>
            <li>
                <label for="email">E-mail</label>
                <input required class="emailInput" name="email" type="email">
                <div id="emailToolTip">Veuillez selectionner une adresse mail valide.</div>
            </li>
            <li>
                <label for="password">Password</label>
                <input required class="passwordInput" name="password" type="password">
                <br>
                <div id="helpPassword">
                    <p id = "pwd_eightCar"> Le mot de passe doit contenir au moins 8 caractères           </p>
                    <p id = "pwd_special">  Le mot de passe doit contenir au moins un caractère special   </p>
                    <p id = "pwd_maj">      Le mot de passe doit contenir au moins un caractère majuscule </p>
                    <p id = "pwd_min">      Le mot de passe doit contenir au moins un caractère minuscule </p>
                    <p id = "pwd_number">   Le mot de passe doit contenir au moins un chiffre             </p>
                </div>      
            </li>
            <li>
                <input disabled id="submitBtn" type="submit" value="Sign Up">
            </li>
        </ul>   
        
    </form>
    <br>
    <br>
    <div>Already have an acccount ?</div>
    <div>
       
    <a href="/login/signInView">Sign In</a>
    </div>
</main>


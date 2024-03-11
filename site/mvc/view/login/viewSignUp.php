<main>
    <form method="POST" action="/login/signUp">
        <ul>
            <li>
                <label for="pseudo">Pseudo</label>
                <input name="pseudo" type="text">
            </li>
            <li>
                <label for="email">E-mail</label>
                <input name="email" type="email">
            </li>
            <li>
                <label for="password">Password</label>
                <input id="inputPassword" name="password" type="password">
                <br>
                <div id="cluesPassword" class="displayNone">
                    <p class = "red" id = "pwd_eightCar">    Le mot de passe doit contenir au moins 8 caractères             </p>
                    <p class = "red" id = "pwd_special">     Le mot de passe doit contenir au moins un caractère special     </p>
                    <p class = "red" id = "pwd_maj">         Le mot de passe doit contenir au moins un caractère majuscule   </p>
                    <p class = "red" id = "pwd_min">         Le mot de passe doit contenir au moins un caractère minuscule   </p>
                    <p class = "red" id = "pwd_number">      Le mot de passe doit contenir au moins un chiffre               </p>
                </div>        
            </li>
            <li>
                <input id="submitBtn" type="submit" value="Sign Up">
            </li>
        </ul>   
        
    </form>
    <br>
    <br>
    <div>Already have an acccount ?</div>
    <div>
       
    <a href="/login/signInView">Sign In</a>
    <script src="/scripts/login.js"></script>
    </div>
</main>


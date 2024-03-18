<main class ="form-container">

<h1>Reset Password</h1>
<form method="POST" action="/login/updatePassword">
        <ul>
            <li>
                <label for="email">Your email :<?= $_GET['email'] ?></label>
                <input required name="email" type="hidden" value=<?= $_GET['email'] ?>>
            </li>
            <li>
                <label for="token">Your Token : <?= $_GET['token'] ?></label>
                <input required name="token" type="hidden" value=<?= $_GET['token'] ?>>
            </li>
            <li>
                <label for="newPassword" >New Password</label>
                <input required name="newPassword" class="passwordInput" type="password">
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
                <label for="confirmPassword">Confirm Password</label>
                <input required name="confirmPassword" class ="confirmPassword" type="password">
                <p id="pwdMatchTooltip">Passwords doesnt match</p>  
            </li>
            <li>
                <input type="submit" value="New Password">
            </li>
        </ul>   
        
    </form>
    </main>
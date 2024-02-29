<main>
    <form method="POST" action="?controller=login&action=signUp">
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
                <input name="password" type="password">
            </li>
            <li>
                <input type="submit" value="Sign Up">
            </li>
        </ul>   
        
    </form>
    <br>
    <br>
    <div>
   Already have an acccount ?
    </div>
    <div>
       
        <a href="?controller=login&action=signInView">Sign In</a>
    </div>
</main>
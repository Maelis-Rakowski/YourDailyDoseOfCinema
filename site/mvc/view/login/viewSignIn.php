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
            </li>
            <li>
                <input type="submit" value="Sign In">
            </li>
        </ul>   
        
    </form>

    <br><br>
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
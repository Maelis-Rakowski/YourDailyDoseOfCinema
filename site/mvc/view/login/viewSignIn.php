<main>
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


    <br>
    <br>
    <div>
   Forgot Password ?
    </div>
    <form method="POST" action="sendEmail">
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
<h1>Reset Password</h1>
<form method="POST" action="/login/updatePassword">
        <ul>
            <li>
                <label for="email">enter your email</label>
                <input name="email" value="">
            </li>
            <li>
                <label for="token">enter the token</label>
                <input name="token" type="text">
            </li>
            <li>
                <label for="newPassword">New Password</label>
                <input name="newPassword" type="password">
            </li>
            <li>
                <label for="confirmPassword">Confirm Password</label>
                <input name="confirmPassword" type="password">
            </li>
            <li>
                <input type="submit" value="New Password">
            </li>
        </ul>   
        
    </form>

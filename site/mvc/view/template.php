<!DOCTYPE html>
<html>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">        
        <meta name="description" content="Your daily dose of cinema is the best website ever">
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css ">
        <title><?= $t ?></title>

    </head>
    <body>

        <header>
            <h1>Your daily dose of cinema</h1>
            <nav >
            <a href="/home">Home</a>
            <a href="/user">User</a>
            <a href="/login/signInView">Sign In</a>
            <a href="/login/signUpView">Sign Up</a>
            </nav>
        </header>

        <main>
            <?= $content ?>
        </main>

        <footer>
            @Copyright 2024 YDDOC
        </footer>

    </body>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script src="/scripts/login.js"></script>
</html>
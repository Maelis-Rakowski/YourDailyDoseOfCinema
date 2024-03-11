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
            <h1>YOUR DAILY DOSE OF CINEMA</h1>
            <nav >
                <a href="/home">Home</a>
                <a href="/user">User</a>
                <a href="/login">Sign In</a>
            </nav>
        </header>

        <main>
            <!-- Content of the view -->
            <?= $content ?>

        </main>

        <footer>
            ©Copyright 2024 Your daily dose of Cinema
        </footer>
    </body>
</html>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Your daily dose of cinema is the best website ever">
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css ">
        <title><?= $t ?></title>
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    </head>
    <body>
        <header>
            <h1>YOUR DAILY DOSE OF CINEMA</h1>
            <nav >
                <a href="/home">Home</a>
                <?php 
                    if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) {
                        echo '<a href="/admin/user">User</a>';
                        echo '<a href="/admin/movie">Movies</a>';
                        echo '<a href="/admin/tmdb">TMDB</a>';
                    }
                ?>
                <a href="/login/signInView">Sign In</a>
                <a href="/login">Sign Up</a>
            </nav>
        </header>

        <main>
            <?= $content ?>
        </main>

        <footer>
            ©Copyright 2024 Your daily dose of Cinema
        </footer>
    </body>
    <script src="/scripts/login.js"></script>

</html>
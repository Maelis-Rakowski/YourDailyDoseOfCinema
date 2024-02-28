<!DOCTYPE html>
<html>

<!-- The template is defining the header, head and the footer for all the views -->
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta name="description" content="Your daily dose of cinema is the best website ever">

        <!-- Inclure votre fichier CSS -->
        <link rel="stylesheet" type="text/css" href="css/style.css ">
        <title><?= $t ?></title>

    </head>
    <body>

        <header>
            <h1>Your daily dose of cinema</h1>
            <nav >
            <a href="?controller=home">Home</a>
            <a href="?controller=user">User</a>
            </nav>
        </header>



        <main>
            <!-- Content of the view -->
            <?= $content ?>

        </main>

        <footer>
            @Copyright 2024 YDDOC
        </footer>

    </body>
</html>
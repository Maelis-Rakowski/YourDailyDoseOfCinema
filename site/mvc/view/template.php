<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Your daily dose of cinema is the best website ever">
        <link media="all" rel="stylesheet" type="text/css" href="/assets/css/style_resp.css ">
        <title><?= $t ?></title>
        <!-- <link href="/docs/5.3/assets/css/docs.css" rel="stylesheet"> -->
        <link media="all" rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link media="all" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        
    </head>
    <body>
        <div class="bg">
            <div class="container">
                <header class="d-flex flex-wrap align-items-center justify-content-center py-3 mb-4 border-bottom">
                    <a href="/" class="text-decoration-none d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-white text-center">
                        <h1 class="custom_font d-block d-md-none">YDDOC</h1>
                        <h1 class="custom_font d-none d-md-block">YOUR DAILY DOSE OF CINEMA</h1>
                    </a>

                    <ul class="nav nav-pills d-flex align-items-center">
                        <li class="nav-item"><a class="nav-link text-white" href="/home">Home</a></li>
                        <?php
                            if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) {
                                echo '<li class="nav-item"> <a class="nav-link text-white" href="/admin/user">Users</a> </li>';
                                echo '<li class="nav-item"> <a class="nav-link text-white" href="/admin/movie">Movies</a></li>';
                                echo '<li class="nav-item"> <a class="nav-link text-white display-2" href="/admin/tmdb">TMDB</a></li>';
                            }
                            if (!isset($_SESSION["pseudo"])) {
                                echo '<li class="nav-item"><a class="nav-link text-white" href="/login/signInView">Sign In</a></li>';
                                echo '<li class="nav-item"><a class="nav-link text-white text-3xl" href="/login">Sign Up</a></li>';
                            } else {
                                echo '<li class="nav-item"><a class="nav-link text-white" href="/user/details">Profile</a></li>';
                                echo '<li class="nav-item"><a class="nav-link text-white" href="/login/disconnect">Disconnect</a></li>';
                            }
                        ?>
                    </ul>
                </header>
            </div>
        </div>

        
        <main>
            <?= $content ?>
        </main>
        
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item"><a class="nav-link text-dark" href="/home">Home</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="/login/signInView">Sign In</a></li>
                <li class="nav-item"><a class="nav-link text-dark text-3xl" href="/login">Sign Up</a></li>
            </ul>
            <p class="text-center text-body-secondary">©Copyright 2024 Your daily dose of Cinema</p>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
    </html>
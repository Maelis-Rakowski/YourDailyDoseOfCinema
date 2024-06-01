<?php $this->_t="YDDOC"?>
<div class="container-xxl bd-gutter mt-3 my-md-4 bd-layout">
    <main class="bd-main order-1">
        <div class="py-5 text-center">
            <h2 class="fw-bold display-5">Guess the movie of the day !</h2>
            <p class="lead d-none d-md-block">Welcome to our movie guessing game! Log in to your account to start guessing the movie of the day with the least number of clues. Let's see how well you know your movies!</p>
        </div>
        <div id="nbTries"></div>
        <div id="tagline"></div>
        <div id="overview"></div>
        <p id="result"></p>
        <div id="guesses" class="guess form-floating mb-5">
            <input name="movieSearch" class="form-control" id="movieSearch" type="text" placeholder="Guess the game of the day...">
            <label for="movieSearch" class="pl-2 seach_bar form-label">Guess the game of the day...</label>
        </div>
        <div id="movieList" class="flex-row">
        <div class="container-fluid d-none d-lg-block">
            <div class="row">
                <div class="col d-flex justify-content-center align-items-center">
                    <div class="mx-2 fw-bold">Poster</div>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <div class="mx-2 fw-bold">Title</div>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <div class="mx-2 fw-bold">Year</div>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <div class="mx-2 fw-bold">Duration</div>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <div class="mx-2 fw-bold">Genres</div>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <div class="mx-2 fw-bold">Countries</div>
                </div>
                <div class="col d-flex justify-content-center align-items-center">
                    <div class="mx-2 fw-bold">Directors</div>
                </div>
            </div>
        </div>
            <div  id="squaresContainer" class="d-none d-lg-block container-fluid"></div>
            <div  id="squaresContainer_sm" class="d-block d-lg-none"></div>
        </div>
    </main>
</div>
<script src="/scripts/home.js"></script>
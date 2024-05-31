<div>
<?php $this->_t="YDDOC"?>
    <div id="home">
        <div class="content">
           
            <h2>Guess the movie of the day !</h2>
            
            <div id="tagline" hidden>
                <h3>Tagline : </h3>
                <?= $tagline ?>
            </div> 
            <div id="overview" hidden>
                <h3>Overview : </h3>
                <?= $overview ?>
            </div> 
            <h5>Nombre d'essais : </h5>
            <h6 id="nbTries">0</h6>
            <div id="guesses" class="guess">
                <input id="movieSearch" type="text" placeholder="Rechercher un film...">
              
                <div id="movieList">   
                </div> 
            </div>
           
            <div id="result" class="result">
            </div>
        </div>
        <script src="/scripts/home.js"></script>
    </div>
</div>
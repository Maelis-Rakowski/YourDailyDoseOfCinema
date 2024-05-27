<div>
    <title>TMDB Request</title>

    <!-- Chargement du script -->
    <script src="../../scripts/tmdb.js"></script>
<?php $this->_t="TMDB"?>

    <div id="tmdb">
        <h2>Guess the movie of the day !</h2>
        <!-- Forumulaire post -->
        <form action="" method="post">
            <input id="movieInput" type="text" name="movie_title">
            <button type="button" id="envoyer">Rechercher</button>
        </form>
        <ul>
            <li class="displayNone" id="noGuess">aucun résultat trouvé</li>
        </ul>
    </div>
</div>

<div id='datas'>
<!-- Ce div est remplit par la requete de l'utilisateur avec ajax 
dans ControllerAdminTmdb->callTMDBJson()
-->
</div>

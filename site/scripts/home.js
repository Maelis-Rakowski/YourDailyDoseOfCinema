const cubeStart = 
`    <div class="col">
        <div class="image-wrapper">
            <div class="image-container">
                <img
`;

const cubeStart_sm = 
`    <div class="col-4">
        <div class="image-wrapper">
            <div class="image-container">
                <img
`;
const cubeMiddle = 
`
class="img-fluid img-thumbnail" alt="...">
<p class="text-center">
`;

const htmlStringMiddlePoster = 
`
" class="img-fluid rounded img-thumbnail" style=" object-fit: cover;" alt="...">
<p class="text-center" style="word-wrap: break-word;">
`;

const cubeEnd = 
`
                </p> 
            </div>
        </div>
    </div>
`;

// initialisationGuessesListe_lg();
  
const getCookieValue = (name) => (
    document.cookie.match('(^|;)\\s*' + name + '\\s*=\\s*([^;]+)')?.pop() || null
)
  
function deleteAllCookies() {
    document.cookie.split(';').forEach(cookie => {
        const eqPos = cookie.indexOf('=');
        const name = eqPos > -1 ? cookie.substring(0, eqPos) : cookie;
        document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:00 GMT; path=/';
    });
}

$(document).ready(function() {
    $.ajax({
        url:'home/pickTodayMovie',
        type: 'POST',
        dataType: 'json',
        success : function(data) {
            // if a new movie was picked, then delete all cookies
            if (getCookieValue("idMovie") != data) {
                deleteAllCookies()
                document.cookie = "idMovie=" + data + "; path=/"
                setNbTriesText(0)
            } else {
                //Affiche le nombre d'essais de la session
                getNbTries(function(nbTries) {
                    setNbTriesText(nbTries);
                    tryShowHints(nbTries);
                });
            }
        }
    });
    $('#movieSearch').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: 'movie/searchMoviesByTitle',
                type: 'GET',
                dataType: 'json',
                data: { query: request.term },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 1,
        select: function(event, ui) {
            var submissionId = ui.item; // get the selected movie name
            $.ajax({
                url: 'home/submitGuess',
                type: 'POST',
                data: { guess: submissionId },
                dataType: 'json',
                success: function(data) {
                    //clear the input
                    document.getElementById("movieSearch").value = ""

                    //          +====+==============================+==============================+
                    //          | #  |      0 -  Comparison         |      1 - Guess Value         |
                    //          +====+==============================+==============================+
                    //          | 0  | isTheMovieOfTheDay           |        $guess.id             |
                    //          | 1  | isSame__title                |        $guess.title          |
                    //          | 2  | isSame__director             |        $guess.director       |
                    //          | 3  | isSame__country              |        $guess.country        |
                    //          | 4  | isSame__genre                |        $guess.value          |
                    //          | 5  | isSame__date                 |        $guess.date           |
                    //          | 6  | isSame__time                 |        $guess.time           |
                    //          | 7  | is_guess_older               |        $guess.date           |
                    //          | 8  | is_guess_longer              |        $guess.time           |
                    //          | 9  | has_a_poster                 |        $guess.poster         |
                    //          +====+==============================+==============================+


                    // Verif : Est-ce que le guess est le film du jour ?
                    var messageDiv = createMessageDiv();
                   
                    if (data[0][0]) {
                        messageDiv.html('<h2 class="text-success">You nailed it !</h2>');

                        var posterUrl = "https://image.tmdb.org/t/p/w500" + data[9][1];
                    
                        var posterDiv = createPoster(posterUrl);
                        // setting cookies for the finished daily movie view 
                        document.cookie = "idMovie=" + data[0][1] + "; path=/"
                        document.cookie = "dailyMoviePosterUrl=" + posterUrl + "; path=/"
                        document.cookie = "dailyMovieTitle=" + data[1][1]+ "; path=/"

                        document.getElementById('movieSearch').disabled = true

                    } else {
                        messageDiv.html('Try again!');
                    }
                    messageDiv.append(posterDiv);

                    // Affichage des résultats
                    let resultat_condition = [ 
                        data[0][0],                       
                        data[1][0],
                        data[2][0],
                        data[3][0],
                        data[4][0],
                        data[5][0],
                        data[6][0],
                        data[7][0],
                        data[8][0]
                    ]

                    insertGuessInGuessesListe(
                        data[9][1],
                        data[1][1],
                        data[5][1],
                        data[6][1],
                        data[4][1],
                        data[3][1],
                        data[2][1],
                        resultat_condition
                    );
                    document.cookie = "success=" + data[0][0] + "; path=/"
                    $.ajax({
                        url: "userHistory/createUserHistory",
                        type: "GET"
                    })
                }
            });
        },
        appendTo: "#movieList",
        position: {
            my: "left top",
            at: "left bottom",
            collision: "none"
        }
    });

    if(getCookieValue("success") != null && getCookieValue("success") != "false") {
        disableGame()
    }

});

function disableGame() {
    // the movie was found
    // disable the search input
    document.getElementById('movieSearch').disabled = true
    // display congratulation message along with the movie name le message bravo + le nom du film
    var messageDiv = createMessageDiv();
    messageDiv.html('<p class="h3 text-success">Bravooo ! The daily movie was : ' + getCookieValue("dailyMovieTitle") + '</p>');

    
    // afficher le poster
    var posterDiv = createPoster(getCookieValue("dailyMoviePosterUrl"));
    messageDiv.append(posterDiv);
}

function createMessageDiv() {
    var messageDiv = $('#result');
    messageDiv.css('display', 'flex');
    messageDiv.css('align-items', 'center');
    messageDiv.css('justify-content', 'center');
    messageDiv.css('flex-direction', 'column');
    return messageDiv;
}

function createPoster(url) {
    var posterDiv = document.createElement("div");                    
    posterDiv.style.width = "250px";
    posterDiv.style.height = "350px";
    posterDiv.style.backgroundImage = "url(" + url + ")";
    posterDiv.style.backgroundRepeat = "no-repeat";
    posterDiv.style.paddingTop = "25px";
    posterDiv.style.backgroundSize ='contain';
    
    return(posterDiv);
}

function initialisationGuessesListe_lg() {
    const parent = $('#movieList');  
    const guessesContainer_lg = $('<div/>', { class: 'col guesses_container row text-center d-none d-lg-block' });
    const thContainer = $('<div/>', { class: 'flex row border-bottom mb-3' });
    const tdContainer = $('<div/>', { class: 'td_container' });
    
    const thColumns = [
        'Poster',
        'Title',
        'Year',
        'Duration',
        'Genres',
        'Countries',
        'Directors'
    ];
  
    thColumns.forEach(column => {
      const thColumn = $('<div/>', { class: 'col fw-bold', text: column });
      thContainer.append(thColumn);
    });
  
    guessesContainer_lg.append(thContainer);
    guessesContainer_lg.append(tdContainer);  
    parent.prepend(guessesContainer_lg);
}

function addSpacesAfterCommas(str) {
    if (typeof str !== 'string') {
      str = String(str);
    }
  
    return str.replace(/,([^ ])/g, ', $1');
  }
  
function insertGuessInGuessesListe(poster, title, date, time, genre, country, director, resultat_condition) {

    genre = addSpacesAfterCommas(genre);
    director = addSpacesAfterCommas(director);
    poster = `https://image.tmdb.org/t/p/w500` + poster;

    //attribution d'un id à la row afin de la retrouver dans d'autres fonctions
    //PC
    parent = $('#squaresContainer');
    id = removeSpecialCharacters(title+date+time);
    const htmlRow = '<div class="d_row flex row pb-3" id ="' + id +'" ></div>' ;
    parent.prepend(htmlRow);    
    row = $("#" + id);
    
    //PC - Poster
    cubePoster = cubeStart + 'id = "' + id + '_' + "poster" + '"' + htmlStringMiddlePoster + cubeEnd;
    row.append(cubePoster);
    posterDiv = $("#" + id+"_poster");
    posterDiv.attr('src', poster);

    //Phone
    id_sm = id + "_sm";    
    parent = $('#squaresContainer_sm');
    const htmlRow_sm = '<div class="card border rounded bg-light m-2" id = "' + id_sm + '"></div>';
    parent.prepend(htmlRow_sm);
    currentCard = $("#" + id_sm);

    id_sm = id_sm + "row";
    currentCard.html('<div class="col m-2 guesses_container row text-center"><div class="container-fluid"><div class="row" id = "' + id_sm + '"></div></div></div>');
    currentMainRow = $("#" + id_sm);

    id_sm = id_sm + "col_8";
    currentMainRow.html('<div style="max-height: 400px;" class="col-4"><img class="img-fluid img-thumbnail" src="' + poster + '"></img></div> <div class="col-8 mt-md-3 mt-sm-1"><div class="row gx-2 gy-2 gx-md-5 gy-md-5" id = "' + id_sm + '"></div></div>');
    cubesContainer_sm = $("#" + id_sm);


    //creation des cubes de couleurs PC
    cubes = "";
    cubes_sm = "";
    const cubes_data = [title, date, time, genre, country, director];
    for(i = 0; i < 6; i++) {
        cubes = cubes + cubeStart + 'id = "' + id + '_' + i + '"' + cubeMiddle + cubes_data[i] + cubeEnd;
        cubes_sm = cubes_sm + cubeStart_sm + 'id = "' + id_sm + '_' + i + '"' + cubeMiddle + cubes_data[i] + cubeEnd;
    }
    row.append(cubes);
    cubesContainer_sm.append(cubes_sm);

    updateTryDataAndText();

    // Title
    defineColor(resultat_condition[1], id + "_0");
    defineColor(resultat_condition[1], id_sm + "_0");

    // Date
    defineColor(resultat_condition[5], id + "_1", resultat_condition[7]);
    defineColor(resultat_condition[5], id_sm + "_1", resultat_condition[7]);

    // Time
    defineColor(resultat_condition[6], id + "_2", resultat_condition[8]);
    defineColor(resultat_condition[6], id_sm + "_2", resultat_condition[8]);

    // Genres
    defineColor(resultat_condition[4], id + "_3");
    defineColor(resultat_condition[4], id_sm + "_3");

    // Countries
    defineColor(resultat_condition[3], id + "_4");
    defineColor(resultat_condition[3], id_sm + "_4");

    // directors
    defineColor(resultat_condition[2], id + "_5");
    defineColor(resultat_condition[2], id_sm + "_5");
}

function defineColor(condition, id, condition_arrow = -1) {
    imageElement = $("#" + id);
    if (condition == 1 || condition == true) {              //GREEN
        imageElement.attr('src', `/assets/images/square-green.png`);
    } 
    else if (condition_arrow !== -1) {  //ARROWS
        if(condition_arrow) {           // BOT
            imageElement.attr('src', `/assets/images/square-bot.png`);
        }
        else {          // TOP
            imageElement.attr('src', `/assets/images/square-top.png`);                
        }
    } 
    else if (condition === 0.5) {       // ORANGE
        imageElement.attr('src', `/assets/images/square-orange.png`);
    } else  {                           // RED     
        imageElement.attr('src', `/assets/images/square-red.png`);
    }
}

function removeSpecialCharacters(inputString) {
    // Définir une expression régulière pour les caractères spéciaux
    const regex = /[^\w\d]/g;
  
    // Remplacer tous les caractères spéciaux dans la chaîne de caractères
    // en utilisant l'expression régulière et la méthode replace()
    const outputString = inputString.replace(regex, '');
  
    // Retourner la chaîne de caractères modifiée
    return outputString;
}

///////////////////////////////////////////////////
///////////////////////////////////////////////////
//Gestion des TryNumber
///////////////////////////////////////////////////
///////////////////////////////////////////////////
// Fonction pour récupérer nbTries depuis le serveur
function getNbTries(callback) {
    $.get('userHistory/getNbTries')
    .done(function(reponse){
        reponse = JSON.parse(reponse);
        if(reponse.nbTries!=null)
            callback(reponse.nbTries);
        else callback(null);
    })
}

// Fonction pour mettre à jour nbTries sur le serveur
function setNbTries(nbTries) {
    $.post('userHistory/setNbTriesAsSessionVariable', // Appelle la fonction callTMDBJson du controller tmdb
        {
            nbTries: nbTries
        });
}

function setNbTriesText(nbTries){
    $("#nbTries").html(nbTries);
}

function updateTryDataAndText() {
    getNbTries(function(nbTries) {
        if (nbTries !== null) {
            nbTries++;
            updateHistory();
            setNbTriesText(nbTries);
            tryShowHints(nbTries);
            setNbTries(nbTries);
        }
    });
}

//ShowHint
function tryShowHints(nbTries){
    if (nbTries >= 5) {
        //document.getElementById("tagline").removeAttribute("hidden");
        showTagline();
    }
    if (nbTries >= 10) {
        showOverview();
    }
}

//Création  ou Maj du userDailyMovie
function updateHistory(){
    $.post('userHistory/updateUserTry')
}

function showTagline(){
    $.post('movie/getDailyMovieJson').
    done(function(reponse){//Quand la requête post est terminée,appel de la fonction done()
        reponse=JSON.parse(reponse);
        $('#tagline').html(reponse.tagline);
    })
}

function showOverview(){
    $.post('movie/getDailyMovieJson')
    .done(function(reponse){//Quand la requête post est terminée,appel de la fonction done()
        reponse=JSON.parse(reponse);
        $('#overview').html(reponse.overview);
    })
}

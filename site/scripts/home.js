initialisationGuessesListe();
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
            if (data) {
                deleteAllCookies()
            }
            //Affiche le nombre d'essais de la session
            getNbTries(function(nbTries) {
                setNbTriesText(nbTries);
                tryShowHints(nbTries);
            });
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
                        messageDiv.html('Félicitation !');
                        messageDiv.css('color', 'green');

                        var posterUrl = "https://image.tmdb.org/t/p/w500" + data[9][1];
                    
                        var posterDiv = createPoster(posterUrl);
                        // setting cookies for the finished daily movie view 
                        document.cookie = "dailyMoviePosterUrl=" + posterUrl + "; path=/"
                        document.cookie = "dailyMovieTitle=" + data[1][1]+ "; path=/"

                        document.getElementById('movieSearch').disabled = true

                    } else {
                        messageDiv.html('Try again!');
                    }
                    messageDiv.append(posterDiv);

                    // Affichage des résultats
                    let colors = [ 
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
                        colors
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
    messageDiv.html('Bravooo ! The daily movie was : ' + getCookieValue("dailyMovieTitle"));
    messageDiv.css('color', 'green');
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
    return(posterDiv);
}

function initialisationGuessesListe() {
    const parent = $('#guesses');
  
    const guessesContainer = $('<div/>', { class: 'guesses_container' });
    const thContainer = $('<div/>', { class: 'th_container' });
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
      const thColumn = $('<div/>', { class: 'th_column', text: column });
      thContainer.append(thColumn);
    });
  
    guessesContainer.append(thContainer);
    guessesContainer.append(tdContainer);
  
    parent.append(guessesContainer);
}



function insertGuessInGuessesListe(col1, col2, col3, col4, col5, col6, col7, colors) {
    const container = $(".td_container");
    const row = $("<div></div>").attr("class", "td_row");
    col1 = "https://image.tmdb.org/t/p/w500"+col1;

    addTry();
    const titleDiv = $("<div></div>").attr("class", "td_column picture");
    titleDiv.css({
        'background-image': `url(${col1})`,
        'background-size': 'cover',
    });
    row.append(titleDiv);
    
    // Title
    if(colors[1])
        row.append("<div class='td_column name green'>" + col2 + "</div>");
    else
        row.append("<div class='td_column name red'>" + col2 + "</div>");

    // Date
    if(colors[5])
        row.append("<div class='td_column date green'>" + col3 + "</div>");
    else if(colors[7])
        row.append("<div class='td_column date bot_arrow'>" + col3 + "</div>");
    else
        row.append("<div class='td_column date top_arrow'>" + col3 + "</div>");


    // Time
    if(colors[6])
        row.append("<div class='td_column time green'>" + col4 + "</div>");
    else if(colors[8])
        row.append("<div class='td_column time bot_arrow'>" + col4 + "</div>");
    else
        row.append("<div class='td_column time top_arrow'>" + col4 + "</div>");
    

   // Genres
    if (colors[4] === 1) {
        row.append("<div class='td_column genre green'>" + col5 + "</div>");
    } else if (colors[4] === 0.5) {
        row.append("<div class='td_column genre orange'>" + col5 + "</div>");
    } else if (colors[4] === 0) {
        row.append("<div class='td_column genre red'>" + col5 + "</div>");
    }
    
    // Counties
    if (colors[3] === 1) {
        row.append("<div class='td_column pays green'>" + col6 + "</div>");
    } else if (colors[3] === 0.5) {
        row.append("<div class='td_column pays orange'>" + col6 + "</div>");
    } else if (colors[3] === 0) {
        row.append("<div class='td_column pays red'>" + col6 + "</div>");
    }
    
    // Directors
    if (colors[2] === 1) {
        row.append("<div class='td_column pays green'>" + col7 + "</div>");
    } else if (colors[2] === 0.5) {
        row.append("<div class='td_column pays orange'>" + col7 + "</div>");
    } else if (colors[2] === 0) {
        row.append("<div class='td_column pays red'>" + col7 + "</div>");
    }
    
    container.prepend(row);
}


///////////////////////////////////////////////////
///////////////////////////////////////////////////
//Gestion des TryNumber
///////////////////////////////////////////////////
///////////////////////////////////////////////////
// Fonction pour récupérer nbTries depuis le serveur
function getNbTries(callback) {
    $.ajax({
        url: 'userHistory/getNbTries',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                var nbTries = response.nbTries;
                callback(nbTries);
            } else {
                console.error('Erreur lors de la récupération de nbTries:', response.message);
                callback(null);
            }
            console.log("GETTING");
        },
        error: function(xhr, status, error) {
            console.error('Erreur lors de la requête AJAX :', xhr.responseText);
            callback(null);
        }
    });
}

// Fonction pour mettre à jour nbTries sur le serveur
function setNbTries(nbTries, callback) {
    $.ajax({
        url: 'userHistory/setNbTries',
        type: 'POST',
        data: { nbTries: nbTries },
        success: function(response) {
            callback(true);
            console.log("SETTING");

        },
        error: function(xhr, status, error) {
            console.error('Erreur lors de la mise à jour de la variable de session:', error);
            callback(false);
        }
    });
}

function setNbTriesText(nbTries){
    document.getElementById("nbTries").textContent = nbTries;
}

// Fonction principale addTry
function addTry() {
    getNbTries(function(nbTries) {
        if (nbTries !== null) {
            nbTries++;
            updateHistory();
            setNbTriesText(nbTries);
            setNbTries(nbTries, function(success) {
                if (success) {
                    tryShowHints(nbTries);
                }
            });
        }
    });
}

//ShowHint
function tryShowHints(nbTries){
    if (nbTries >= 5) {
        document.getElementById("tagline").removeAttribute("hidden");
    }
    if (nbTries >= 10) {
        document.getElementById("overview").removeAttribute("hidden");
    }
}

//Création  ou Maj du userDailyMovie
function updateHistory(){
    $.ajax({
        url: 'userHistory/addUserTry', 
        type: 'POST',
        success: function(response) {
            // Traitez la réponse du serveur ici
            callback(true);
            console.log(response);
        },
        error: function(xhr, status, error) {
            console.error('Erreur lors de la mise à jour de la variable de session:', error);
            callback(false);
        }
    });
}

// Définition de la fonction callback pour démonstration
function callback(success) {
    if (success) {
        console.log('Historique mis à jour avec succès.');
    } else {
        console.log('Échec de la mise à jour de l\'historique.');
    }
}
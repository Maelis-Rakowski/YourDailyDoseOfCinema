function checkInput() {
    var input = document.getElementById('movieInput').value;
    var noGuess = document.getElementById('noGuess');
  
        if (input === '') {
            noGuess.classList.add('displayNone');
            noGuess.classList.remove('displayBlock');
        } else {
            noGuess.classList.remove('displayNone');
            noGuess.classList.add('displayBlock');
        }
}

initialisationGuessesListe();
$(document).ready(function() {
    $.ajax({
        url:'home/pickTodayMovie',
        type: 'POST',
        dataType: 'json',
        success : function(data) {
            console.log(data);
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
                    console.log("tableau converti en json : ", data);
                    var messageDiv = initPosterDiv();

                    if (data[0][0]) {
                        messageDiv.html('Félicitation !');
                        messageDiv.css('color', 'green');

                        var posterUrl = "https://image.tmdb.org/t/p/w500" + data[9][1];
                    
                        var posterDiv = CreatePoster(posterUrl, messageDiv);

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
});


function initPosterDiv() {
    var messageDiv = $('#result');
    messageDiv.css('display', 'flex');
    messageDiv.css('align-items', 'center');
    messageDiv.css('justify-content', 'center');
    messageDiv.css('flex-direction', 'column');
    return messageDiv;
}

function CreatePoster(url) {
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
        'affiche',
        'name',
        'Année',
        'Durée',
        'Genre',
        'Pays',
        'Réalisateur'
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
    

    // Genre
    if(colors[4])
        row.append("<div class='td_column genre green'>" + col5 + "</div>");
    else
        row.append("<div class='td_column genre red'>" + col5 + "</div>");
    

    // Pays
    if(colors[3])
        row.append("<div class='td_column pays green'>" + col6 + "</div>");
    else
        row.append("<div class='td_column pays red'>" + col6 + "</div>");
    

    // Director
    if(colors[2])
        row.append("<div class='td_column real green'>"       + col7 + "</div>");
    else
        row.append("<div class='td_column real red'>"       + col7 + "</div>");
    

    container.prepend(row);
}
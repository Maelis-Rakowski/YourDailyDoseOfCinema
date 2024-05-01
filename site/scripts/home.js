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
        minLength: 2,
        select: function(event, ui) {
            var submissionId = ui.item.id; // get the selected movie name
            $.ajax({
                url: 'home/submitGuess',
                type: 'POST',
                data: { guess: submissionId },
                dataType: 'json',
                success: function(data) {
                    var messageDiv = $('#result'); // get the message div
                    if (data) { // if the response is true
                        messageDiv.html('Bravo mon ptit bozo !');
                        messageDiv.css('color', 'green');
                    } else { // if the response is false
                        messageDiv.html('Essais encore nullos !');
                        messageDiv.css('color', 'red');
                    }
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


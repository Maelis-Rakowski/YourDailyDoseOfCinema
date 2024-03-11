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

document.getElementById('movieInput').addEventListener('input', checkInput);

<?php
require_once FILE::build_path(array('view', 'view.php'));
require_once FILE::build_path(array('model', 'MovieModel.php'));
require_once FILE::build_path(array('model', 'DailyMovieModel.php'));
class ControllerHome {

    //variable of the view to generate
    private $_view;

    public function __construct(){}

    public function readAll() {
        $this->_view = new View(array('view', 'home', 'viewHome.php'));
        //Generate the view without data
        $this->_view->generate(array(null));
    }

    public function submitGuess() {
        // on récupère le guess
        $guess = $_POST["guess"];
        // on récupère le guess du jour
        $movie = MovieModel::getCurrentMovie();
        // retourner la comparaison des ids des films
        echo json_encode($movie->getId() == $guess);
    }

    public function pickTodayMovie() {
        if (count(MovieModel::getCurrentMovie()) == 0) {
            $movie = MovieModel::getRandomMovie();
            DailyMovieModel::createDailyMovie(date('Y-m-d'), $movie->getId());
            echo json_encode("picked");
        }
        else {
            echo json_encode("already picked");
        }
    }

}
?>
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

        $current_date = $movie->getReleaseDate();
        $current_date = intval(substr($current_date, 0, 4));
        
        $guessed_date = $guess["date"];
        $guessed_date = intval(substr($guessed_date, 0, 4));
    
        //retourner la comparaison des films
        $isTheMovieOfTheDay = $movie->getId()           == $guess["id"];
        $isSame__title      = $movie->getTitle()        == $guess["label"];
        $isSame__director   = $movie->getDirectors()    == $guess["director"];
        $isSame__country    = $movie->getCountries()    == $guess["country"];
        $isSame__genre      = $movie->getGenres()       == $guess["genre"];        
        $isSame__time       = $movie->getRuntime()      == $guess["time"];
        $isSame__date       = $current_date             == $guessed_date;
        $has_a_poster       = true;        

        $current_time = intval($movie->getRuntime());        
        $guessed_time = intval($guess["time"]);

        //au cas ou pb avec format des dates
        try {
            $is_guess_older = $current_date <= $guessed_date2;
        } catch (Exception $e) {
            $is_guess_older = false;
        }

        try {
            $is_guess_longer = $current_time <= $guessed_time;
        } catch (Exception $e) {
            $is_guess_older = false;
        }
        

        $guess2String = convertTimeFormatHM($guessed_time)

        $comparisonResults = [
            [ $isTheMovieOfTheDay,  $guess["id"]            ],
            [ $isSame__title,       $guess["label"]         ],
            [ $isSame__director,    $guess["director"]      ],
            [ $isSame__country,     $guess["country"]       ],
            [ $isSame__genre,       $guess["genre"]         ],
            [ $isSame__date,        $guessed_date           ],
            [ $isSame__time,        $guess2String           ],
            [ $is_guess_older,      $guessed_date           ],
            [ $is_guess_longer,     $guess2String           ],
            [ $has_a_poster,        $guess["image"]         ]
        ];

        echo json_encode($comparisonResults);
    }

    public function convertTimeFormatHM($minute) {
        $hours = floor($guessed_time / 60);
        $remainingMinutes = $guessed_time % 60;
        if ($guessed_time < 1) {
            $guess2String = "0min";
        } elseif ($hours >= 1) {
            $guess2String = $hours . "h " . $remainingMinutes . "min";
        } else {
            $guess2String = $remainingMinutes . "min";
        }
        return $guess2String;
    }

    public function pickTodayMovie() {
        if (!MovieModel::getCurrentMovie()) {
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
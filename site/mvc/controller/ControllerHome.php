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

        $date1 = $movie->getReleaseDate();
        $date1 = intval(substr($date1, 0, 4));
        
        $date2 = $guess["date"];
        $date2 = intval(substr($date2, 0, 4));
    
        //retourner la comparaison des films
        $isTheMovieOfTheDay = $movie->getId()           == $guess["id"];
        $isSame__title      = $movie->getTitle()        == $guess["label"];
        $isSame__director   = $movie->getDirectors()    == $guess["director"];
        $isSame__country    = $movie->getCountries()    == $guess["country"];
        $isSame__genre      = $movie->getGenres()       == $guess["genre"];        
        $isSame__time       = $movie->getRuntime()      == $guess["time"];
        $isSame__date       = $date1                    == $date2;
        $has_a_poster       = true;        

        $time1 = intval($movie->getRuntime());        
        $time2 = intval($guess["time"]);

        //au cas ou pb avec format des dates
        try {
            $is_guess_older = $date1 <= $date2;
        } catch (Exception $e) {
            $is_guess_older = false;
        }

        try {
            $is_guess_longer = $time1 <= $time2;
        } catch (Exception $e) {
            $is_guess_older = false;
        }
        
        $hours = floor($time2 / 60);
        $remainingMinutes = $time2 % 60;
        if ($time2 < 1) {
            $time2String = "0min";
        } elseif ($hours >= 1) {
            $time2String = $hours . "h " . $remainingMinutes . "min";
        } else {
            $time2String = $remainingMinutes . "min";
        }

        $comparisonResults = [
            [ $isTheMovieOfTheDay,  $guess["id"]              ],
            [ $isSame__title,       $guess["label"]           ],
            [ $isSame__director,    $guess["director"]        ],
            [ $isSame__country,     $guess["country"]         ],
            [ $isSame__genre,       $guess["genre"]           ],
            [ $isSame__date,        $date2                    ],
            [ $isSame__time,        $time2String                    ],
            [ $is_guess_older,      $date2                    ],
            [ $is_guess_longer,     $time2String                    ],
            [ $has_a_poster,        $guess["image"]           ]
        ];

        echo json_encode($comparisonResults);
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
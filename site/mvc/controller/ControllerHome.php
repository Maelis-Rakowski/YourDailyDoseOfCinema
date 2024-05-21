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
        
        $ed = $guess["date"];
        $ed = intval(substr($ed, 0, 4));
    
        //retourner la comparaison des films
        $isTheMovieOfTheDay = $movie->getId()           == $guess["id"];
        $isSame__title      = $movie->getTitle()        == $guess["label"];
        $isSame__director   = $movie->getDirectors()    == $guess["director"];
        $isSame__country    = $movie->getCountries()    == $guess["country"];
        $isSame__genre      = $movie->getGenres()       == $guess["genre"];        
        $isSame__time       = $movie->getRuntime()      == $guess["time"];
        $isSame__date       = $current_date             == $ed;
        $has_a_poster       = true;        

        $current_time1 = intval($movie->getRuntime());        
        $guessed_time2 = intval($guess["time"]);

        //au cas ou pb avec format des dates
        try {
            $is_guess_older = $current_date <= $guessed_date2;
        } catch (Exception $e) {
            $is_guess_older = false;
        }

        try {
            $is_guess_longer = $current_time1 <= $guessed_time2;
        } catch (Exception $e) {
            $is_guess_older = false;
        }
        

        $guessed_time2String = convertTimeFormatHM($guessed_time2)

        $comparisonResults = [
            [ $isTheMovieOfTheDay,  $guess["id"]            ],
            [ $isSame__title,       $guess["label"]         ],
            [ $isSame__director,    $guess["director"]      ],
            [ $isSame__country,     $guess["country"]       ],
            [ $isSame__genre,       $guess["genre"]         ],
            [ $isSame__date,        $ed                     ],
            [ $isSame__time,        $guessed_time2String    ],
            [ $is_guess_older,      $ed                     ],
            [ $is_guess_longer,     $guessed_time2String    ],
            [ $has_a_poster,        $guess["image"]         ]
        ];

        echo json_encode($comparisonResults);
    }

    public function convertTimeFormatHM($minute) {
        $hours = floor($guessed_time2 / 60);
        $remainingMinutes = $guessed_time2 % 60;
        if ($guessed_time2 < 1) {
            $guessed_time2String = "0min";
        } elseif ($hours >= 1) {
            $guessed_time2String = $hours . "h " . $remainingMinutes . "min";
        } else {
            $guessed_time2String = $remainingMinutes . "min";
        }
        return $guessed_time2String;
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
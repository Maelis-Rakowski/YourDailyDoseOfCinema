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
            $isTheMovieOfTheDay = $movie->getId()          == $guess["id"];
            $isSame_title      = $movie->getTitle()        == $guess["label"];
            $isSame_director   = $movie->getDirectors()    == $guess["director"];
            $isSame_country    = $movie->getCountries()    == $guess["country"];
            $isSame_genre      = $movie->getGenres()       == $guess["genre"];        
            $isSame_time       = $movie->getRuntime()      == $guess["time"];
            $isSame_date       = $current_date             == $guessed_date;
            $has_a_poster      = true;        

            $current_time = intval($movie->getRuntime());        
            $guessed_time = intval($guess["time"]);

            //au cas ou pb avec format des dates
            try {
                $is_guess_older = $current_date <= $guessed_date;
            } catch (Exception $e) {
                $is_guess_older = false;
            }

            try {
                $is_guess_longer = $current_time <= $guessed_time;
            } catch (Exception $e) {
                $is_guess_older = false;
            }

            // Conversion en string format : 8h 30min
            $hours = floor($guessed_time / 60);
            $remainingMinutes = $guessed_time % 60;
            if ($guessed_time < 1) {
                $guessedDateToString = "0min";
            } elseif ($hours >= 1) {
                $guessedDateToString = $hours . "h " . $remainingMinutes . "min";
            } else {
                $guessedDateToString = $remainingMinutes . "min";
            }            

            //Création  trame
            $comparisonResults = [
                [ $isTheMovieOfTheDay,  $guess["id"]            ],
                [ $isSame_title,        $guess["label"]         ],
                [ $isSame_director,     $guess["director"]      ],
                [ $isSame_country,      $guess["country"]       ],
                [ $isSame_genre,        $guess["genre"]         ],
                [ $isSame_date,         $guessed_date           ],
                [ $isSame_time,         $guessedDateToString    ],
                [ $is_guess_older,      $guessed_date           ],
                [ $is_guess_longer,     $guessedDateToString    ],
                [ $has_a_poster,        $guess["image"]         ]
            ];

            echo json_encode($comparisonResults);
        }

        public function convertTimeFormatHM($guessed_time) {
            $hours = floor($guessed_time / 60);
            $remainingMinutes = $guessed_time % 60;
            if ($guessed_time < 1) {
                $guessedDateToString = "0min";
            } elseif ($hours >= 1) {
                $guessedDateToString = $hours . "h " . $remainingMinutes . "min";
            } else {
                $guessedDateToString = $remainingMinutes . "min";
            }
            return $guessedDateToString;
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
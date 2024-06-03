    <?php
    require_once FILE::build_path(array('view', 'view.php'));
    require_once FILE::build_path(array('model', 'MovieModel.php'));
    require_once FILE::build_path(array('model', 'DailyMovieModel.php'));
    require_once FILE::build_path(array('controller', 'ControllerUserHistory.php'));

    class ControllerHome {

        //variable of the view to generate
        private $_view;

        public function __construct(){}

        public function readAll() {
            $this->_view = new View(array('view', 'home', 'viewHome.php'));
            if(!isset($_SESSION['nbTries'])){
                $_SESSION['nbTries'] = 0;
            }

             if (isset($_SESSION["pseudo"])) {
                ControllerUserHistory::createUserHistory($_SESSION["pseudo"]);
            }

            $this->_view->generate(array(null));
        }

        public function submitGuess() {
            // on récupère le guess
            $guessed_movie = $_POST["guess"];
            
            // on récupère le guess du jour
            $movie = MovieModel::getCurrentMovie();

            //complète les chanps de guessed_movie
            $guessed_movie["director"] = MovieModel::getMovieDirectorsByMovieId($guessed_movie["id"]);
            $guessed_movie["genre"] = MovieModel::getMovieGenresByMovieId($guessed_movie["id"]);
            $guessed_movie["country"] = MovieModel::getMovieCountriesByMovieId($guessed_movie["id"]);

            $current_date = $movie->getReleaseDate();
            $current_date = intval(substr($current_date, 0, 4));
            
            $guessed_date = $guessed_movie["date"];
            $guessed_date = intval(substr($guessed_date, 0, 4));
            
            //retourner la comparaison des films
            $isTheMovieOfTheDay = $movie->getId()          == $guessed_movie["id"];
            $isSame_title      = $movie->getTitle()        == $guessed_movie["label"];
            $isSame_director   = MovieModel::compareLists($movie->getDirectors(), $guessed_movie["director"]);
            $isSame_country    = MovieModel::compareLists($movie->getCountries(), $guessed_movie["country"]);
            $isSame_genre      = MovieModel::compareLists($movie->getGenres(), $guessed_movie["genre"]);       
            $isSame_time       = $movie->getRuntime()      == $guessed_movie["time"];
            $isSame_date       = $current_date             == $guessed_date;
            $has_a_poster      = true;        

            $current_time = intval($movie->getRuntime());        
            $guessed_time = intval($guessed_movie["time"]);
          
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
            $guessedDateToString = $this->convertTimeFormatHM($guessed_time);
                       
            //Création  trame
            $comparisonResults = [
                [ $isTheMovieOfTheDay,  $guessed_movie["id"]            ],
                [ $isSame_title,        $guessed_movie["label"]         ],
                [ $isSame_director,     $guessed_movie["director"]      ],
                [ $isSame_country,      $guessed_movie["country"]       ],
                [ $isSame_genre,        $guessed_movie["genre"]         ],
                [ $isSame_date,         $guessed_date           ],
                [ $isSame_time,         $guessedDateToString    ],
                [ $is_guess_older,      $guessed_date           ],
                [ $is_guess_longer,     $guessedDateToString    ],
                [ $has_a_poster,        $guessed_movie["image"]         ]
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
                echo json_encode($movie->getId());
            }
            else {
                echo json_encode(MovieModel::getCurrentMovie()->getId());
            }
        }      
    }
    ?>
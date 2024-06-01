<?php
    require_once FILE::build_path(array('view','view.php'));
    require_once FILE::build_path(array('model','MovieModel.php'));
    require_once FILE::build_path(array('model','DailyMovieModel.php'));
    class ControllerMovie {
        //variable of the view to generate
        private $_view;

        public function __construct() {        
        }

        public function searchMoviesByTitle() {
            $query = $_GET['query'];
            $movies = MovieModel::searchByTitle($query);
    
            $results = [];
            foreach ($movies as $movie) {
                $results[] = [
                    'id'        => $movie->getId(),
                    'image'     => $movie->getPosterPath(),
                    'label'     => $movie->getTitle(),
                    'date'      => $movie->getReleaseDate(),
                    'time'      => $movie->getRuntime(),
                    'director'  => $movie->getDirectors(),
                    'country'   => $movie->getCountries(),
                    'genre'     => $movie->getGenres()                    
                ];
            } 
            echo json_encode($results);
        }


        public function getDailyMovieJson() {
            $dailymovie = MovieModel::getCurrentMovie();
            echo($dailymovie->toJson());
        }
    }
?>
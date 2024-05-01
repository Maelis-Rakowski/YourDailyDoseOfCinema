<?php
    require_once FILE::build_path(array('view','view.php'));
    require_once FILE::build_path(array('model','MovieModel.php'));
    class ControllerMovie {
        //variable of the view to generate
        private $_view;

        public function __construct() {        
        }

        public function readAll() {
            $this->_view = new View(array('view', 'admin', 'movie', 'viewMovieList.php'));
            //Generate the view without data
            $movies = MovieModel::selectAll("movies", "MovieModel");
            $this->_view->generate(array('movies'=>$movies));
        }

        public function details() {
            if (isset($_GET["id"])) {
                $this->_view = new View(array('view', 'admin', 'movie', 'viewMovie.php'));
                $movie = MovieModel::getMovieById($_GET["id"]);
                $this->_view->generate(array('movie'=>$movie));
            } else {
                $this->_view = new View(array('view', '404.php'));
                $this->_view->generate(array());
            }
        }

        public function searchMoviesByTitle() {
            $query = $_GET['query'];
            $movies = MovieModel::searchByTitle($query);
    
            $results = [];
            foreach ($movies as $movie) {
                $results[] = [
                    'id' => $movie->getId(),
                    'label' => $movie->getTitle()
                ];
            } 
            echo json_encode($results);
        }
    }
?>
<?php
    require_once FILE::build_path(array('view','view.php'));
    require_once FILE::build_path(array('model','MovieModel.php'));
    class ControllerAdminMovie {
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

        public function delete() {
            $movieIdToDelete = $_POST["movie_id"];
            MovieModel::deleteMovieById($movieIdToDelete);
        }
    }
?>
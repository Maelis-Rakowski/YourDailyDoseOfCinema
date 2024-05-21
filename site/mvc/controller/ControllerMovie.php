<?php
    require_once FILE::build_path(array('view','view.php'));
    require_once FILE::build_path(array('model','MovieModel.php'));
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
                    'id' => $movie->getId(),
                    'label' => $movie->getTitle()
                ];
            } 
            echo json_encode($results);
        }
    }
?>
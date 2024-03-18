<?php
    require_once FILE::build_path(array('view','view.php'));
    class ControllerTmdb {
        //variable of the view to generate
        private $_view;

        public function __construct() {        
        }

        public function readAll() {
            $datamovies = [];
            // Si le formulaire est envoyé, appeler callTMDB
            // if(isset($_POST['movie_title'])){
            //     $datamovies=$this->callTMDB();
            // }
            $this->_view = new View(array('view', 'tmdb', 'viewTmdb.php'));
            $this->_view->generate(array('datamovies'=>$datamovies));
            
        }

        public function callTMDB(){
           
            //Generate the view without data
            $apiKey = '0168e4ae77bb634f0e51abb40d08f608';
            //$url = 'https://api.themoviedb.org/3/movie/details?api_key='.$apiKey.'&language=en-EN';
            $url = 'https://api.themoviedb.org/3/movie/details?api_key='.$apiKey.'&language=en-EN';

            // Faire la requête à l'API
            $response = file_get_contents($url);

            // Décoder la réponse JSON
            $datamovies = json_decode($response, true);
            return $datamovies;
        }

        public function callTMDBJson(){
           
            //Generate the view without data
            $apiKey = '0168e4ae77bb634f0e51abb40d08f608';
            //$url = 'https://api.themoviedb.org/3/movie/details?api_key='.$apiKey.'&language=en-EN';
            $query = $_POST['movieInput'];
            $url = 'https://api.themoviedb.org/3/search/movie?api_key='.$apiKey.'&query='.$query.'&include_adult=true&language=en-US';


            // Faire la requête à l'API
            $response = file_get_contents($url);

            $datamovies = json_decode($response, true);
            foreach ($datamovies['results'] as $movie) {
                    // Construire l'URL de l'image à partir du chemin fourni
                    $imageUrl = 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'];
        
                    echo 'Titre : ' . $movie['title'] . '<br>';
                    echo 'Date de sortie : ' . $movie['release_date'] . '<br>';
                    foreach($movie['genre_ids'] as $genre){
                        echo 'Genre :'. $genre.'<br>';
                    }
                    echo 'Note : ' . $movie['vote_average'] . '<br>';
                    echo 'Nombre de vote : ' . $movie['vote_count'] . '<br>';
                    echo '<img src="' . $imageUrl . '" alt="' . $movie['title'] . '">';
                    echo '<br><br>';
                }
            // Le foreach génère du code html qui va être récupéré par la fonction done(function(reponse_html)) du post ajax

           
        }

        // public function details() {
        //     if (isset($_GET["id"])) {
        //         $this->_view = new View(array('view', 'movie', 'viewMovie.php'));
        //         $movie = MovieModel::getMovieById($_GET["id"]);
        //         $this->_view->generate(array('movie'=>$movie));
        //     } else {
        //         $this->_view = new View(array('view', '404.php'));
        //         $this->_view->generate(array());
        //     }
        // }

        
    }
?>
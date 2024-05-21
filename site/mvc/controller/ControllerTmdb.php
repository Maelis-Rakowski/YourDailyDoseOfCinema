<?php
    require_once FILE::build_path(array('view','view.php'));
    class ControllerTmdb {
        //variable of the view to generate
        private $_view;
       

        public function __construct() {        
        }

        public function readAll() {
            $datamovies = [];
            $this->_view = new View(array('view', 'admin', 'tmdb', 'viewTmdb.php'));
            $this->_view->generate(array('datamovies'=>$datamovies));
            
        }

        public function callTMDB(){
           
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
            $query = $_POST['movieInput'];
            $url = 'https://api.themoviedb.org/3/search/movie?api_key='.$apiKey.'&query='.$query.'&include_adult=false&language=en-US';


            // Faire la requête à l'API
            $response = file_get_contents($url);
            //!!!!!!!!!!!!!!!!!!!!!!!
            // IL NE FAUT PAS FAIRE LA REQUETE SUR LES DETAILS QUAND ON LISTE MAIS UNIQUEMENT QUAND ON AJOUTE
            // CAR çA PREND TROP DE TEMPS DE FAIRE LA REQUETE DETAILS SUR TOUS LES FILMS
            //!!!!!!!!!!!!!!!!!!!!!!!!!!
            $datamovies = json_decode($response, true);
            foreach ($datamovies['results'] as $movie) {
                    //$movie = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/' . $movie['id'] . '?api_key=' . $apiKey), true);

                    // Construire l'URL de l'image à partir du chemin fourni
                    $imageUrl = 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'];
        
                    echo 'Titre : ' . $movie['title'] . '<br>';
                    echo 'Date de sortie : ' . $movie['release_date'] . '<br>';
                   // echo 'Runtime :'. $movie['runtime']. '<br>';
                    echo 'Overview :'. $movie['overview']. '<br>';
                    //echo 'Tagline :'. $movie['tagline']. '<br>';
                    foreach($movie['genre_ids'] as $genre){
                        echo '---GenreId :'. $genre.'<br>';
                       
                    }
                   
                    echo 'Note : ' . $movie['vote_average'] . '<br>';
                    echo 'Nombre de vote : ' . $movie['vote_count'] . '<br>';
                    echo '<img src="' . $imageUrl . '" alt="' . $movie['title'] . '">';
                    echo '<form action="/tmdb/addMovie" method="POST">
                      
                        <input type="hidden" name="idmovie" type="text" value="'.$movie['id'].'">
                        <input type="submit" value="Ajouter ce film">
                        </form>';
                    echo '<br><br>';
                }
            // Le foreach génère du code html qui va être récupéré par la fonction done(function(reponse_html)) du post ajax          
        }

        public function addMovie(){
            $idmovie=$_POST['idmovie'];
            $apiKey = '0168e4ae77bb634f0e51abb40d08f608';
            $movie = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/' . $idmovie . '?api_key=' . $apiKey), true);
            
            $countries=$movie['production_countries'];

            $credits=json_decode(file_get_contents('https://api.themoviedb.org/3/movie/' . $idmovie . '/credits?api_key=' . $apiKey), true);
            
            

            var_dump($movie['title']);
            var_dump($movie['release_date']);
            var_dump($movie['runtime']);
            var_dump($movie['poster_path']);
            var_dump($movie['overview']);
            var_dump($movie['tagline']);
            
            $sql = "SELECT id FROM movies WHERE idtmdb = :idtmdb";
            $req = Model::getPDO()->prepare($sql);
            $req->bindValue(':idtmdb', $movie['id'], PDO::PARAM_INT);
            $req->execute();
            $movieRow = $req->fetch();
           
            if(!$movieRow){
                MovieModel::createMovie($movie['id'],$movie['title'],$movie['release_date'],$movie['runtime'],
                $movie['poster_path'],$movie['overview'],$movie['tagline']);
            }
            else{
                //SI LE FILM EST DEJA DANS LA DB ALORS INUTILE DE LE RECREER, ABORTAGE
                echo("LE FILM EXISTE DEJA DANS LA BDD ALORS ANNULATION DE L'INSERTION");
                return;
            }

            $movieID = Model::getPDO()->lastInsertId();
           //ADDING INFO TO OTHER TABLES
            foreach($credits['crew'] as $crew){
                if($crew['job']=="Director"){
                    // Vérifier si le réalisateur existe déjà dans la base de données
                    $sql = "SELECT id FROM directors WHERE idtmdb = :idtmdb";
                    $req = Model::getPDO()->prepare($sql);
                    $req->bindValue(':idtmdb', $crew['id'], PDO::PARAM_INT);
                    $req->execute();
                    $director = $req->fetch();

                    // Si le réalisateur n'existe pas encore, l'insérer dans la base de données et récupérer son ID
                    if (!$director) {
                        MovieModel::createDirector($crew['id'],$crew['name']);
                        $directorID = Model::getPDO()->lastInsertId();
                    } else {
                        // Si le réalisateur existe déjà, récupérer son ID à partir de la base de données
                        $directorID = $director['id'];
                    }
                    MovieModel::createMovieDirector($movieID, $directorID);
                }
            }
            foreach($movie['production_countries'] as $country){
               // Vérifier si le pays existe déjà dans la base de données
                $sql = "SELECT id FROM countries WHERE name = :name";
                $req = Model::getPDO()->prepare($sql);
                $req->bindValue(':name', $country['name'], PDO::PARAM_STR);
                $req->execute();
                $countryRow = $req->fetch();

                // Si le pays n'existe pas encore, l'insérer dans la base de données et récupérer son ID
                if (!$countryRow) {
                    MovieModel::createCountry($country['name']);
                    $countryID = Model::getPDO()->lastInsertId();
                } else {
                    // Si le pays existe déjà, récupérer son ID à partir de la base de données
                    $countryID = $countryRow['id'];
                }

                // Ajouter le pays au film
                MovieModel::createMovieCountry($movieID, $countryID);
            }
            foreach($movie['genres'] as $genre){
                 // Vérifier si le genre existe déjà dans la base de données
                $sql = "SELECT id FROM genres WHERE genre = :genre";
                $req = Model::getPDO()->prepare($sql);
                $req->bindValue(':genre', $genre['name'], PDO::PARAM_STR);
                $req->execute();
                $genreRow = $req->fetch();

                // Si le genre n'existe pas encore, l'insérer dans la base de données et récupérer son ID
                if (!$genreRow) {
                    MovieModel::createGenre($genre['name']);
                    $genreID = Model::getPDO()->lastInsertId();
                } else {
                    // Si le genre existe déjà, récupérer son ID à partir de la base de données
                    $genreID = $genreRow['id'];
                }

                // Ajouter le genre au film
                MovieModel::createMovieGenre($movieID, $genreID);
            }

           
          
        }
    }
?>
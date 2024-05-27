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
            $query = str_replace(' ', '%20', $query);
            $url = 'https://api.themoviedb.org/3/search/movie?api_key='.$apiKey.'&query='.$query.'&include_adult=false&language=en-US';


            // Faire la requête à l'API
            $response = file_get_contents($url);
            //!!!!!!!!!!!!!!!!!!!!!!!
            // IL NE FAUT PAS FAIRE LA REQUETE SUR LES DETAILS QUAND ON LISTE MAIS UNIQUEMENT QUAND ON AJOUTE
            // CAR çA PREND TROP DE TEMPS DE FAIRE LA REQUETE DETAILS SUR TOUS LES FILMS
            //!!!!!!!!!!!!!!!!!!!!!!!!!!
            $datamovies = json_decode($response, true);

            foreach ($datamovies['results'] as $movie) {
                // Construire l'URL de l'image à partir du chemin fourni
                $imageUrl = 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'];
            
                echo 'Titre : ' . htmlspecialchars($movie['title']) . '<br>';
                echo 'Date de sortie : ' . htmlspecialchars($movie['release_date']) . '<br>';
                echo 'Overview : ' . htmlspecialchars($movie['overview']) . '<br>';
            
                // Afficher les genres du film
                foreach ($movie['genre_ids'] as $genre) {
                    echo '---GenreId : ' . htmlspecialchars($genre) . '<br>';
                }
            
                echo 'Note : ' . htmlspecialchars($movie['vote_average']) . '<br>';
                echo 'Nombre de votes : ' . htmlspecialchars($movie['vote_count']) . '<br>';
                echo '<img src="' . htmlspecialchars($imageUrl) . '" alt="' . htmlspecialchars($movie['title']) . '"><br>';
            
                // Formulaire pour ajouter le film
                echo '<form action="/tmdb/addMovie" method="POST">
                        <input type="hidden" name="idmovie" value="' . htmlspecialchars($movie['id']) . '">
                        <input type="submit" value="Ajouter ce film">
                      </form><br><br>';
            }
            
            // Le foreach génère du code HTML qui va être récupéré par la fonction done(function(response_html)) du post AJAX
        }

        public function addMovie(){
            $idmovie=$_POST['idmovie'];
            $apiKey = '0168e4ae77bb634f0e51abb40d08f608';
            $movie = json_decode(file_get_contents('https://api.themoviedb.org/3/movie/' . $idmovie . '?api_key=' . $apiKey), true);
            
            $countries=$movie['production_countries'];

            $credits=json_decode(file_get_contents('https://api.themoviedb.org/3/movie/' . $idmovie . '/credits?api_key=' . $apiKey), true);
            
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
                $text = "LE FILM EXISTE DEJA DANS LA BDD ALORS ANNULATION DE L'INSERTION";
                $this->_view = new View(array('view', 'admin', 'tmdb', 'viewResponse.php'));
                $this->_view->generate(array('text'=>$text));
                return;
            }

            $movieID = Model::getPDO()->lastInsertId();
            
            function handleEntity($entities, $entityKey, $tableName, $searchColumn, $createEntityFunction, $createRelationFunction, $movieID) {
                foreach ($entities as $entity) {
                    // Préparer la requête pour vérifier si l'entité existe déjà
                    $sql = "SELECT id FROM $tableName WHERE $searchColumn = :value";
                    $req = Model::getPDO()->prepare($sql);
                    $req->bindValue(':value', $entity[$entityKey], PDO::PARAM_STR);
                    $req->execute();
                    $entityRow = $req->fetch();
            
                    // Si l'entité n'existe pas encore, l'insérer dans la base de données et récupérer son ID
                    if (!$entityRow) {
                        call_user_func($createEntityFunction, $entity);
                        $entityID = Model::getPDO()->lastInsertId();
                    } else {
                        // Si l'entité existe déjà, récupérer son ID à partir de la base de données
                        $entityID = $entityRow['id'];
                    }
            
                    // Ajouter l'entité au film
                    call_user_func($createRelationFunction, $movieID, $entityID);
                }
            }
            
            // Utilisation de la fonction générique pour les réalisateurs
            handleEntity(
                array_filter($credits['crew'], function($crew) {
                    return $crew['job'] === "Director";
                }),
                'id',
                'directors',
                'idtmdb',
                function($crew) {
                    MovieModel::createDirector($crew['id'], $crew['name']);
                },
                function($movieID, $directorID) {
                    MovieModel::createMovieDirector($movieID, $directorID);
                },
                $movieID
            );
            
            // Utilisation de la fonction générique pour les pays
            handleEntity(
                $movie['production_countries'],
                'name',
                'countries',
                'name',
                function($country) {
                    MovieModel::createCountry($country['name']);
                },
                function($movieID, $countryID) {
                    MovieModel::createMovieCountry($movieID, $countryID);
                },
                $movieID
            );
            
            // Utilisation de la fonction générique pour les genres
            handleEntity(
                $movie['genres'],
                'name',
                'genres',
                'genre',
                function($genre) {
                    MovieModel::createGenre($genre['name']);
                },
                function($movieID, $genreID) {
                    MovieModel::createMovieGenre($movieID, $genreID);
                },
                $movieID
            );

            $text = "Le film ". $movie['title'] ." a été ajouté avec succès ^^";
            $this->_view = new View(array('view', 'admin', 'tmdb', 'viewResponse.php'));
            $this->_view->generate(array('text'=>$text));
          

        }
    }
?>
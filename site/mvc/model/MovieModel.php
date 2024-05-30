<?php
require_once FILE::build_path(array('model','Model.php'));
class MovieModel extends Model {
    private $id;
    private $title;
    private $releaseDate;
    private $runtime;
    private $posterPath;
    private $overview;
    private $tagline;

    private $countries;
    private $directors;
    private $genres;

    private $idtmdb;

    public function __construct($id = NULL, $title = NULL, $releaseDate = NULL, $runtime = NULL, $posterPath = NULL, $overview = NULL, $tagline = NULL, $idtmdb = NULL) {
        if (!is_null($id) && !is_null($title) && !is_null($releaseDate) && !is_null($runtime) && !is_null($posterPath) && !is_null($overview) && !is_null($tagline)&& !is_null($idtmdb)) {
            $this->setId($id);
            $this->setTitle($title);
            $this->setReleaseDate($releaseDate);
            $this->setRuntime($runtime);
            $this->setPosterPath($posterPath);
            $this->setOverview($overview);
            $this->setTagline($tagline);
            $this->setIdtmdb($idtmdb);
        }
    }

    public function toJson()
    {
        return json_encode([
            'id' => $this->id,
            'title' => $this->title,
            'releaseDate' => $this->releaseDate,
            'runtime' => $this->runtime,
            'posterPath' => $this->posterPath,
            'overview' => $this->overview,
            'tagline' => $this->tagline
        ]);
    }
    
//GETTER AND SETTER
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getReleaseDate() {
        return $this->releaseDate;
    }

    public function setReleaseDate($releaseDate) {
        $this->releaseDate = $releaseDate;
    }

    public function getRuntime() {
        return $this->runtime;
    }

    public function setRuntime($runtime) {
        $this->runtime = $runtime;
    }

    public function getPosterPath() {
        return $this->posterPath;
    }

    public function setPosterPath($posterPath) {
        $this->posterPath = $posterPath;
    }

    public function getOverview() {
        return $this->overview;
    }

    public function setOverview($overview) {
        $this->overview = $overview;
    }

    public function getTagline() {
        if($this->tagline=="")
            return "No TagLine for this movie -_-";
        return $this->tagline;
    }

    public function setTagline($tagline) {
        $this->tagline = $tagline;
    }

    public function getCountries() {
        return $this->countries;
    }

    public function setCountries($countries) {
        $this->countries = $countries;

        return $this;
    }

    public function getDirectors() {
        return $this->directors;
    }

    public function setDirectors($directors) {
        $this->directors = $directors;
        return $this;
    }

    public function getGenres() {
        return $this->genres;
    }
 
    public function setGenres($genres) {
        $this->genres = $genres;
        return $this;
    }

    public function setIdtmdb($idtmdb){
        $this->idtmdb = $idtmdb;
        return $this;
    }

    public function getIdtmdb($idtmdb){
        return $this->idtmdb;
    }
    
//Model methods
    /**
     * Get joined properties such as : countries, directors and genres
     * @param string $propertyTableName property table name (must be plurial) 
     * @param string $field wanted field
     */
    private static function getMovieJoinedPropertyById($propertyTableName, $field, $joinField, $movieId) {
        $joinTableName = "movie" . $propertyTableName;
        $sql = "SELECT t.$field FROM $propertyTableName t JOIN $joinTableName jt ON jt.$joinField = t.id WHERE jt.idMovie = :movieId";
        $req = Model::getPDO()->prepare($sql);
        $values = array(
            "movieId" => $movieId
        );
        $req->execute($values);
        return $req->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public static function getMovieDirectorsByMovieId($movieId) {
        return MovieModel::getMovieJoinedPropertyById("directors", "name", "idDirector", $movieId);
    }

    public static function getMovieCountriesByMovieId($movieId) {
        return MovieModel::getMovieJoinedPropertyById("countries", "name", "idCountry", $movieId);
    }

    public static function getMovieGenresByMovieId($movieId) {
        return MovieModel::getMovieJoinedPropertyById("genres", "genre", "idGenre", $movieId);
    }

    public static function createMovie($idtmdb,$title, $releaseDate, $runtime, $posterPath, $overview, $tagline) {
        $sql = "INSERT INTO movies (idtmdb,title, releaseDate, runtime, posterPath, overview, tagline) VALUES (:idtmdb,:title, :releaseDate, :runtime, :posterPath, :overview, :tagline)";
        $req = Model::getPDO()->prepare($sql);
        $values = array(
            "idtmdb" => $idtmdb,
            "title" => $title,
            "releaseDate" => $releaseDate,
            "runtime" => $runtime,
            "posterPath" => $posterPath,
            "overview" => $overview,
            "tagline" => $tagline
        );

        $req->execute($values);
    }

    public static function createDirector($idtmdb,$name){
        $sql = "INSERT INTO directors (idtmdb,name) VALUES (:idtmdb,:name)";
        $req = Model::getPDO()->prepare($sql);
        $values = array(
            "idtmdb" => $idtmdb,
            "name" => $name,
        );
        $req->execute($values);
    }
    public static function createMovieDirector($idMovie,$idDirector){
        $sql = "INSERT INTO moviedirectors (idMovie,idDirector) VALUES (:idMovie,:idDirector)";
        $req = Model::getPDO()->prepare($sql);
        $values = array(
            "idMovie" => $idMovie,
            "idDirector" => $idDirector,
        );
        $req->execute($values);
    }

    public static function createGenre($genre){
        $sql = "INSERT INTO genres (genre) VALUES (:genre)";
        $req = Model::getPDO()->prepare($sql);
        $values = array(
            "genre" => $genre,
        );
        $req->execute($values);
    }

    public static function createMovieGenre($idMovie,$idGenre){
        $sql = "INSERT INTO moviegenres (idMovie,idGenre) VALUES (:idMovie,:idGenre)";
        $req = Model::getPDO()->prepare($sql);
        $values = array(
            "idMovie" => $idMovie,
            "idGenre" => $idGenre,
        );
        $req->execute($values);
    }

    public static function createCountry($name){
        $sql = "INSERT INTO countries (name) VALUES (:name)";
        $req = Model::getPDO()->prepare($sql);
        $values = array(
            "name" => $name,
        );
        $req->execute($values);
    }

    public static function createMovieCountry($idMovie,$idCountry){
        $sql = "INSERT INTO moviecountries (idMovie,idCountry) VALUES (:idMovie,:idCountry)";
        $req = Model::getPDO()->prepare($sql);
        $values = array(
            "idMovie" => $idMovie,
            "idCountry" => $idCountry,
        );
        $req->execute($values);
    }

    public static function getMovieById($id) {
        $sql = "SELECT * FROM movies WHERE id=:id";
        $values = array("id" => $id);
        $req_prep = Model::getPDO()->prepare($sql);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, "MovieModel");
        $req_prep->execute($values);
        $movie = $req_prep->fetchAll()[0];
        $movie->completeJoinedValues();
        return $movie;
    }

    private function completeJoinedValues() {
        $id = $this->getId();
        $directors = $this->getMovieDirectorsByMovieId($id);
        $genres = $this->getMovieGenresByMovieId($id);
        $countries = $this->getMovieCountriesByMovieId($id);
        $this->setDirectors($directors);
        $this->setGenres($genres);
        $this->setCountries($countries);
    }
    
    public static function getRandomMovie() {
        $sql = "SELECT * from movies order by rand() limit 1";
        $req_prep = Model::getPDO()->prepare($sql);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, "MovieModel");
        $req_prep->execute();
        $movies = $req_prep->fetchAll();
        return $movies[0];
    }

    public static function searchByTitle($query) {
        $query = "%" . $query . "%";
        $sql = "SELECT * from movies where LOWER(title) like :query";
        $values = array(
            "query" => $query
        );
        $req_prep = Model::getPDO()->prepare($sql);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, "MovieModel");
        $req_prep->execute($values);
        $movies = $req_prep->fetchAll();
        return $movies;
    }

    public static function getCurrentMovie() {
        $sql = "SELECT m.* FROM movies m WHERE id = (select idMovie from dailymovie dm where date = DATE( CURDATE() ))";
        $req_prep = Model::getPDO()->prepare($sql);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, "MovieModel");
        $req_prep->execute();
        if (empty($req_prep)){
            return false;
        } else {            
            $movie = $req_prep->fetchAll()[0];
            //complète les champs
            $movie->setDirectors(MovieModel::getMovieDirectorsByMovieId($movie->getId()));
            $movie->setGenres(MovieModel::getMovieGenresByMovieId($movie->getId()));
            $movie->setCountries(MovieModel::getMovieCountriesByMovieId($movie->getId()));
            return $movie;
        }
    }

    public static function addMovie($movie){
        $sql = "SELECT id FROM movies WHERE idtmdb = :idtmdb";
        $req = Model::getPDO()->prepare($sql);
        $req->bindValue(':idtmdb', $movie['id'], PDO::PARAM_INT);
        $req->execute();
        $movieRow = $req->fetch();
       
        if(!$movieRow){
            MovieModel::createMovie($movie['id'],$movie['title'],$movie['release_date'],$movie['runtime'],
            $movie['poster_path'],$movie['overview'],$movie['tagline']);
            return 1;
        }
        else{
           
            return -1;
        }
    }

    // Cette fonction générique permet les entités (pays,directeurs,genres) entre les tables correspondantes du film ajouté
    // Il suffit de les appeler comme dans ControllerAdminTmdb->addMovie();
    public static function handleEntity($entities, $entityKey, $tableName, $searchColumn, $createEntityFunction, $createRelationFunction, $movieID) {
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

    //Compare 2 listes d'élements, 1 si identique, 0.5 di au moins 1 en commun, 0 si différent exclusif
    public static function compareLists($list1, $list2) {
        // Convertir les listes en tableaux
        $array1 = is_array($list1) ? $list1 : array($list1);
        $array2 = is_array($list2) ? $list2 : array($list2);
    
        // Si les listes sont identiques
        if ($array1 == $array2) {
            return 1;
        }
    
        // Vérifier s'il y a au moins un élément en commun
        foreach ($array1 as $item1) {
            if (in_array($item1, $array2)) {
                return 0.5;
            }
        }
    
        // Aucun élément en commun
        return 0;
    }

}
?>
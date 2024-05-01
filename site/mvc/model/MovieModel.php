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

    public function __construct($id = NULL, $title = NULL, $releaseDate = NULL, $runtime = NULL, $posterPath = NULL, $overview = NULL, $tagline = NULL) {
        if (!is_null($id) && !is_null($title) && !is_null($releaseDate) && !is_null($runtime) && !is_null($posterPath) && !is_null($overview) && !is_null($tagline)) {
            $this->setId($id);
            $this->setTitle($title);
            $this->setReleaseDate($releaseDate);
            $this->setRuntime($runtime);
            $this->setPosterPath($posterPath);
            $this->setOverview($overview);
            $this->setTagline($tagline);
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
    
//Model methods
    /**
     * Get joined properties such as : countries, directors and genres
     * @param string $propertyTableName property table name (must be plurial) 
     * @param string $field wanted field
     */
    private function getMovieJoinedPropertyById($propertyTableName, $field, $joinField, $movieId) {
        $joinTableName = "movie" . ucfirst($propertyTableName);
        $sql = "SELECT t.$field FROM $propertyTableName t JOIN $joinTableName jt ON jt.$joinField = t.id WHERE jt.idMovie = :movieId";
        $req = Model::getPDO()->prepare($sql);
        $values = array(
            "movieId" => $movieId
        );
        $req->execute($values);
        return $req->fetchAll(PDO::FETCH_COLUMN);
    }
    
    public function getMovieDirectorsByMovieId($movieId) {
        return $this->getMovieJoinedPropertyById("directors", "name", "idDirector", $movieId);
    }

    public function getMovieCountriesByMovieId($movieId) {
        return $this->getMovieJoinedPropertyById("countries", "name", "idCountry", $movieId);
    }

    public function getMovieGenresByMovieId($movieId) {
        return $this->getMovieJoinedPropertyById("genres", "genre", "idGenre", $movieId);
    }

    public function createMovie($title, $releaseDate, $runtime, $posterPath, $overview, $tagline, $countries, $directors, $genres) {
        $sql = "INSERT INTO movies (title, realeseDate, runtime, posterPAth, overview, tagline) VALUES (:title, :realeseDate, :runtime, :posterPAth, :overview, :tagline)";
        $req = Model::getPDO()->prepare($sql);
        $values = array(
            "title" => $title,
            "releaseDate" => $releaseDate,
            "runtime" => $runtime,
            "posterPath" => $posterPath,
            "overview" => $overview,
            "tagline" => $overview
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
        $sql = "SELECT m.* FROM movies m WHERE id = (select idMovie from dailyMovie dm where date = DATE( CURDATE() ))";
        $req_prep = Model::getPDO()->prepare($sql);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, "MovieModel");
        $req_prep->execute();
        return $req_prep->fetchAll()[0];
    }

}
?>
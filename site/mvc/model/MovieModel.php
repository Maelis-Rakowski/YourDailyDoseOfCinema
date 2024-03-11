<?php
require_once FILE::build_path(array('model','Model.php'));
class MovieModel extends Model {
    private $id;
    private $title;
    private $realeaseDate;
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
        return $this->realeaseDate;
    }

    public function setReleaseDate($realeaseDate) {
        $this->realeaseDate = $realeaseDate;
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

    /**
     * Get joined properties such as : countries, directors and genres
     * @param string $propertyTableName property table name (must be plurial) 
     * @param string $field wanted field
     */
    private function getMovieJoinedPropertyById($propertyTableName, $field, $joinField, $movieId) {
        $joinTableName = "movie" . ucfirst($propertyTableName);
        $sql = "SELECT $field FROM $propertyTableName t JOIN $joinTableName jt md ON jt.$joinField = t.id WHERE md.idMovie = :movieId";
        $req = Model::getPDO()->prepare($sql);
        $values = array(
            "movieId" => $movieId
        );
        $req->execute($values);
        return $req->fetchAll();
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

    private function joinDirector($movieId, $directorName) {

    }

    private function joinCountry($movieId, $countryName) {

    }

    private function joinGenre($movieId, $genre) {

    }

    public function createMovie($title, $realeaseDate, $runtime, $posterPath, $overview, $tagline, $countries, $directors, $genres) {
        $sql = "INSERT INTO movies (title, realeseDate, runtime, posterPAth, overview, tagline) VALUES (:title, :realeseDate, :runtime, :posterPAth, :overview, :tagline)";
        $req = Model::getPDO()->prepare($sql);
        $values = array(
            "title" => $title,
            "releaseDate" => $realeaseDate,
            "runtime" => $runtime,
            "posterPath" => $posterPath,
            "overview" => $overview,
            "tagline" => $overview
        );


    }
    
}
?>
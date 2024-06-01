<?php
require_once FILE::build_path(array('model','Model.php'));
class DailyMovieModel extends Model {
    private $id;
    private $date;
    private $idMovie;

    private $movie;

// GETTERS & SETTERS
    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
    /**
     * Get the value of idMovie
     */ 
    public function getIdMovie()
    {
        return $this->idMovie;
    }

    /**
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get the value of movie
     */ 
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * Set the value of movie
     *
     * @return  self
     */ 
    public function setMovie($movie)
    {
        $this->movie = $movie;

        return $this;
    }

// DATABASE METHODS
    public static function createDailyMovie($date, $id_movie) {
        $sql = "INSERT into dailymovie (date, idMovie) values (:date, :idMovie)";
        $values = array(
            "date" => $date,
            "idMovie" => $id_movie
        );
        $req_prep = Model::getPDO()->prepare($sql);
        $req_prep->execute($values);
    }

    public static function getTodayDailyMovie($date) {
        $sql = "SELECT * FROM dailymovie WHERE date=:date";
        $values = array(
            "date" => $date
        );
        $req_prep = Model::getPDO()->prepare($sql);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'DailyMovieModel');
        $req_prep->execute($values);
        $daily_movie = $req_prep->fetchAll();
        if (sizeof($daily_movie) == 1) {
            return $daily_movie[0];
        } else {
            return null;
        }
    }

    public static function getDailyMovieById($id) {
        $sql = "SELECT * FROM dailymovie WHERE id=:id";
        $values = array(
            "id" => $id
        );
        $req_prep = Model::getPDO()->prepare($sql);
        $req_prep->setFetchMode(PDO::FETCH_CLASS, 'DailyMovieModel');
        $req_prep->execute($values);
        $daily_movie = $req_prep->fetchAll();
        if (sizeof($daily_movie) == 1) {
            return $daily_movie[0];
        } else {
            return null;
        }
    }

}
?>
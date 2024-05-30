<?php
require_once FILE::build_path(array('model','Model.php'));

class UserHistoryModel extends Model {
    private $idUser;
    private $idDailyMovie;
    private $tryNumber;
    private $success;
    
    public function __construct($idUser = NULL, $idDailyMovie = NULL, $tryNumber = NULL, $success = NULL) {
        if (!is_null($idUser) && !is_null($idDailyMovie) && !is_null($tryNumber) && !is_null($success)) {
            $this->setIdUser($idUser);
            $this->setIdDailyMovie($idDailyMovie);
            $this->setTryNumber($tryNumber);
            $this->setSuccess($success);
        }
    }

//GETTERS AND SETTERS

    /**
     * Get the value of idUser
     */ 
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set the value of idUser
     *
     * @return  self
     */ 
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get the value of idDailyMovie
     */ 
    public function getIdDailyMovie()
    {
        return $this->idDailyMovie;
    }

    /**
     * Set the value of idDailyMovie
     *
     * @return  self
     */ 
    public function setIdDailyMovie($idDailyMovie)
    {
        $this->idDailyMovie = $idDailyMovie;

        return $this;
    }

    /**
     * Get the value of tryNumber
     */ 
    public function getTryNumber()
    {
        return $this->tryNumber;
    }

    /**
     * Set the value of tryNumber
     *
     * @return  self
     */ 
    public function setTryNumber($tryNumber)
    {
        $this->tryNumber = $tryNumber;

        return $this;
    }

    /**
     * Get the value of success
     */ 
    public function getSuccess()
    {
        return $this->success;
    }

    /**
     * Set the value of success
     *
     * @return  self
     */ 
    public function setSuccess($success)
    {
        $this->success = $success;

        return $this;
    }

//DATABASE METHODS

    public static function createUserHistory($id_user, $id_daily_movie, $try_number, $success) {
        $sql = "INSERT INTO playerhistory (idUser, idDailyMovie, tryNumber, success) VALUES (:idUser, :idDailyMovie, :tryNumber, :success)";
        $rep = Model::getPDO() -> prepare($sql);

        $values = array(
            "idUser" => $id_user,
            "idDailyMovie" => $id_daily_movie,
            "tryNumber" => $try_number,
            "success" => $success
        );
        $rep->execute($values);
    } 

    public static function updateTryNumberAndSuccess($id_user, $id_daily_movie, $try_number, $success) {
        if ($success == 'true') {
            $success = true;
        } else {
            $success = false;
        }
        $sql = "UPDATE playerhistory SET tryNumber =:tryNumber, success =:success WHERE idUser =:idUser AND idDailyMovie =:idDailyMovie";
        $values = array(
            "tryNumber"=> $try_number,
            "success"=> $success,
            "idUser"=> $id_user,
            "idDailyMovie"=> $id_daily_movie
        );
        $rep = Model::getPDO()->prepare($sql);
        $rep->execute($values);
    }

    public static function getUserHistoryByUser($idUser) {
        $sql = "SELECT * FROM playerhistory
        WHERE idUser = :idUser";
        $rep = Model::getPDO() -> prepare($sql);
        $rep->setFetchMode(PDO::FETCH_CLASS, 'UserHistoryModel');

        $values = array(
            "idUser" => $idUser
        );
        $rep->execute($values);
        return $rep->fetchAll();
    }

    public static function getUserHistoryByDailyMovieAndUser($daily_movie_id, $idUser) {
        $sql = "SELECT * FROM playerhistory
        WHERE idDailyMovie = :idDailyMovie
        AND idUser = :idUser";
        $rep = Model::getPDO() -> prepare($sql);
        $rep->setFetchMode(PDO::FETCH_CLASS, 'UserHistoryModel');

        $values = array(
            "idDailyMovie" => $daily_movie_id,
            "idUser" => $idUser
        );
        $rep->execute($values);
        $user_history = $rep->fetchAll();
        if (sizeof($user_history) == 1) {
            return $user_history[0];
        }
        return false;
    }

}
?>
<?php
require_once FILE::build_path(array('model','Model.php'));

class UserHistory extends Model {
    private $idUser;
    private $idDailyMovie;
    private $tryNumber;
    private $sucess;
    
    public function __construct($idUser = NULL, $idDailyMovie = NULL, $tryNumber = NULL, $sucess = NULL) {
        if (!is_null($idUser) && !is_null($idDailyMovie) && !is_null($tryNumber) && !is_null($sucess)) {
            $this->setIdUser($idUser);
            $this->setIdDailyMovie($idDailyMovie);
            $this->setTryNumber($tryNumber);
            $this->setSucess($sucess);
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
     * Get the value of sucess
     */ 
    public function getSucess()
    {
        return $this->sucess;
    }

    /**
     * Set the value of sucess
     *
     * @return  self
     */ 
    public function setSucess($sucess)
    {
        $this->sucess = $sucess;

        return $this;
    }

//DATABASE METHODS

    public function getUserHistory($idUser) {
        $sql = "SELECT * FROM userHistory
        WHERE idUser = :idUser";
        $rep = Model::getPDO() -> prepare($sql);
        $rep->setFetchMode(PDO::FETCH_CLASS, 'UserHistory');

        $values = array(
            "idUser" => $idUser
        );
        $rep->execute($values);
        return $rep->fetchAll();
    }

}
?>
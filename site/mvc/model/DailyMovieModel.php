<?php
require_once FILE::build_path(array('model','Model.php'));
class DailyMovieModel extends Model {
    private $date;
    private $movie;

    public static function createDailyMovie($date, $idMovie) {
        $sql = "INSERT into dailyMovie (date, idMovie) values (:date, :idMovie)";
        $values = array(
            "date" => $date,
            "idMovie" => $idMovie
        );
        $req_prep = Model::getPDO()->prepare($sql);
        $req_prep->execute($values);
    }
}
?>
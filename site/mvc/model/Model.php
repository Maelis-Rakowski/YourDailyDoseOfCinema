<?php
require_once File::build_path(array('conf', 'Conf.php'));

class Model {

    private static $pdo = NULL;


    public static function init() {
        $conf = new Conf();
        $hostname = $conf -> getHostname();
        $database_name = $conf -> getDatabase();
        $login = $conf -> getLogin();
        $password = $conf -> getPassword();

        self::$pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $login, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        // On active le mode d'affichage des erreurs, et le lancement d'exception en cas d'erreur
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    //Récupère tous les éléments d'une table
    //param : table de la base , modèle à qui va etre instancier pour chaque element de la table
    //exemple :
    //
    //        require_once FILE::build_path(array(class qui descend de Model utilisée));
    //        $users = UserModel::GetAll("users","UserModel");
    public static function getAll($table, $obj){
        $datas = [];
        $req =Model::getPDO()->prepare('SELECT * FROM '.$table);
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC)){
            $datas[] = new $obj($data);
        }
        return $datas;
        $req->closeCursor();
    }

    public static function getPDO() {
        if (self::$pdo == NULL) {
            self::init();
        }
        return self::$pdo;
    }
}
?>
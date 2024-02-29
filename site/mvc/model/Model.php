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
    public static function selectAll($table_name, $class_name){
        $sql = "SELECT * FROM $table_name";
        $rep = Model::getPDO() -> prepare($sql);
        $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
        $rep->execute();
        return $rep->fetchAll();
    }
    

    public static function getPDO() {
        if (self::$pdo == NULL) {
            self::init();
        }
        return self::$pdo;
    }
}
?>
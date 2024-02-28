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
    public static function getAll($table_name, $class_name){
        $rep = Model::getPDO()->query("SELECT * FROM $table_name");
        $rep->setFetchMode(PDO::FETCH_ASSOC); // On utilise FETCH_ASSOC pour obtenir un tableau associatif
        $objects = [];
        while ($data = $rep->fetch()) {
            $objects[] = new $class_name($data['id'], $data['email'], $data['pseudo'], $data['password'], $data['isAdmin']);
        }
        return $objects;
    }
    

    public static function getPDO() {
        if (self::$pdo == NULL) {
            self::init();
        }
        return self::$pdo;
    }
}
?>
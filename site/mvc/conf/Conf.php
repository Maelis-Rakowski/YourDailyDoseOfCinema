<?php
  class Conf{
    static private $databases;

    static public function init() {
      self::$databases = array(
          'hostname' => $_ENV["db_host"],
          'database' => $_ENV["db_name"],
          'login' => $_ENV["db_user"],
          'password' => $_ENV["db_password"]
      );
  }

  private static $debug = true;
  static public function getDebug(){
    return self::$debug;
  }


  static public function getLogin() {
    return self::$databases['login'];
  }

  static public function getDatabase(){
    return self::$databases['database'];
  }

  static public function getHostname(){
    return self::$databases['hostname'];
  }

  static public function getPassword(){
    return self::$databases['password'];
  }
}
 ?>

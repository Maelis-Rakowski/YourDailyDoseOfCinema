<?php
  class Conf{
    static private $databases= array(
    'hostname' => 'localhost',
    'database' => 'yddoc',
    'login' => 'yddoc',
    'password' => 'QfqWbB25e7K(kS?s'
  );

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

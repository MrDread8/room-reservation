<?php
  class dbh{
    private $db_addr;
    private $db_login;
    private $db_pass;
    private $db_name;
    private $db_charset;

    function dbConnect(){

      $this->db_addr = "localhost";
      $this->db_login = "root";
      $this->db_pass = "";
      $this->db_name = "company";
      $this->db_charset = "utf8";
      try{
        $dns = 'mysql:host='.$this->db_addr.';dbname='.$this->db_name.';';
        $pdo = new PDO($dns, $this->db_login, $this->db_pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_AUTOCOMMIT, FALSE);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $pdo;
      }
      catch(PDOException $e){
        echo "Connection Error: ".$e->getMessage();
      }
   }
}
?>

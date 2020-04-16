<?php
  class dbh{
    private $db_addr;
    private $db_login;
    private $db_pass;
    private $db_name;

    function dbConnect(){
      $this->db_addr = "localhost";
      $this->db_login = "root";
      $this->db_pass = "";
      $this->db_name = "company";

      $connection = new mysqli($this->db_addr,$this->db_login,$this->db_pass,$this->db_name);

      return $connection;
   }
}

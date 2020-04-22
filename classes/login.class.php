<?php
class user extends dbh{
  public $login;
  public $password;
  public $user_id;
  function __construct($login,$password){
    $this->login = $login;
    $this->password = $this->hash($password);
  }

  function selectUser(){
    try{
      $query = $this->dbConnect()->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
      $query->execute([$this->login,$this->password]);
      return $query;
    }
    catch(PDOException $e){
      echo "Connection Error: ".$e->getCode();

      $_SESSION['logginerror'] = true;
      header("Location: ../index.php");
      $result->free();
      exit();
    }
  }

  private function hash($password){
    $password = hash("sha256", $password);
    return $password;
  }
}

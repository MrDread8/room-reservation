<?php
  class reservation extends dbh{
    public $startDate;
    public $endDate;
    private $room_id;
    private $user_id;
    private $query;
    function __construct($startDate,$endDate,$roomId,$user_id){
      $this->startDate = $startDate;
      $this->endDate = $endDate;
      $this->room_id = $roomId;
      $this->user_id = $user_id;
    }
    public function reservate(){
      $query = "INSERT INTO appointments VALUES(0,'$this->room_id','$this->user_id','$this->startDate', '$this->endDate')";
      try{
        $this->dbConnect()->begin_transaction();

        $this->dbConnect()->query($query);

        $this->dbConnect()->commit();
      }
      catch (Exception $e){
        $this->dbConnect()->rollback();
        echo "Error: ".$e->getCode(). " Try again later.";
        return false;
      }
    }
  }

?>

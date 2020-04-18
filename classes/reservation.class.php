<?php
  class reservation extends dbh{
    public $startDate;
    public $endDate;
    private $room_id;
    private $user_id;
    private $query;
    public $formatDate;

    function __construct($startDate,$endDate,$user_id){
      $this->startDate = $startDate;
      $this->endDate = $endDate;
      $this->user_id = $user_id;
    }

    public function reservate($room_id){
      $this->room_id = $room_id;
      $query = "INSERT INTO appointments VALUES(0,'$this->room_id','$this->user_id','$this->startDate', '$this->endDate')";
      try{
        $this->dbConnect()->begin_transaction();
        $temp = $this->checkStatus($this->room_id);
        if($temp->num_roms==0)
          $this->dbConnect()->query($query);

        $this->dbConnect()->commit();
      }
      catch (Exception $e){
        $this->dbConnect()->rollback();
        echo "Error: ".$e->getCode(). " Try again later.";
        return false;
      }
    }

    function loadDate($startDate,$startTime,$endDate,$endTime){
      $this->startDate = $startDate." ".$startTime;
      $this->endDate = $endDate." ".$endTime;

      $this->startDate = strtotime($this->startDate);
      $this->endDate = strtotime($this->endDate);

      if($this->startDate > $this->endDate){
        $temp = $this->endDate;
        $this->endDate = $this->startDate;
        $this->startDate = $temp;
      }
    }

    function converDate(){
      $this->formatDate = (($this->startDate = date("Y-m-d H:i:s", $this->startDate)) != false AND ($this->endDate = date("Y-m-d H:i:s", $this->endDate)) != false) ? true : false;
      return $this->formatDate;
    }

    function checkStatus($room_id){
      $query = $this->dbConnect()->query("SELECT id FROM appointments WHERE (room_id = '$room_id') AND (('$this->startDate' BETWEEN start_time AND end_time) OR ('$this->endDate' BETWEEN start_time AND end_time) OR (start_time BETWEEN '$this->startDate' AND '$this->endDate') OR (end_time BETWEEN '$this->startDate' AND '$this->endDate'))");
      return $query;
    }
  }

?>

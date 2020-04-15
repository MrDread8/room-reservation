<?php
  class LoadDate {
    public $startDate;
    public $endDate;
    public $formatDate;

    function __construct($startDate,$startTime,$endDate,$endTime){
      $this->startDate = $startDate." ".$startTime;
      $this->endDate = $endDate." ".$endTime;

      $this->startDate = strtotime($this->startDate);
      $this->endDate = strtotime($this->endDate);

      if($this->startDate > $this->endDate){
        $z = $this->endDate;
        $this->endDate = $this->startDate;
        $this->startDate = $z;
      }
    }
    function converStringToDate(){
      $this->formatDate = (($this->startDate = date("Y-m-d H:i:s", $this->startDate)) != false AND ($this->endDate = date("Y-m-d H:i:s", $this->endDate)) != false) ? true : false;
      return $this->formatDate;
    }
    function getStartDate(){
      return $this->startDate;
    }
    function getEndDate(){
      return $this->endDate;
    }
    function setStartDate($startDate){
      $this->startDate = $startDate;
    }
    function setEndDate($endDate){
      $this->endDate = $endDate;
    }
  }

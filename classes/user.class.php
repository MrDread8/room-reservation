<?php
class user extends dbh{
    public $login;
    public $password;
    public $user_id;
    private $appointments;

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

    private function hash($text){
        $text = hash("sha256", $text);
        return $text;
    }

    public function getAppointments($userId){
        $date = date('Y-m-d H:i:s');
        $connection = $this->dbConnect();
        try{

$this->appointments = $connection->query("SELECT * FROM appointments LEFT JOIN rooms ON rooms.id = appointments.room_id WHERE appointments.user_id = '$userId' AND appointments.end_time >= '$date' ORDER BY appointments.start_time ASC;");

        return $this->appointments;
        }
        catch(PDOException $e){
            "Error ".$e->getCode()." ".$e->getMessage();
        }
    }
}

<?php
class Connect{
    public $server;
    public $user;
    public $password;
    public $dbname;

    public function __construct(){
        $this->server = "frwahxxknm9kwy6c.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $this->user = "p14x63gdwhpaqpnd";
        $this->password = "vcgtxh1qi9vhm6up";
        $this->dbname = "nimyfso1k4e3n1lz";
    }

    function connectToMySQL():mysqli{
        $conn_my = new mysqli($this->server, $this->user, $this->password, $this->dbname);
        if($conn_my->connect_error){
            die("Fail" . $conn_my->connect_errno);
        }
        else{
        //    echo "Connect!!!!";
        }
        return $conn_my;
    }



    //Connect to PDO
    function connectToPDO():PDO
    {
        try{
            $conn_pdo = new PDO("mysql:host=$this->server;
            dbname=$this->dbname", $this->user, $this->password);
    //        echo "Connect";
        }
        catch(PDOException $e){
            die("Failed $e");
        }
        return $conn_pdo;
    }


}

//$c = new Connect();
// $c->connectToMySQL();
//$c->connectToPDO();
?>








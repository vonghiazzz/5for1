<?php
class Connect{
    public $server;
    public $user;
    public $password;
    public $dbname;

    public function __construct(){
        $this->server = "l6glqt8gsx37y4hs.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $this->user = "chmwlqq0s98wj7ve";
        $this->password = "hw3vo8vl03qnrjw6";
        $this->dbname = "bn12mw0k1xjq2c6s";
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








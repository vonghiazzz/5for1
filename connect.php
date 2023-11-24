<?php
class Connect{
    public $server;
    public $user;
    public $password;
    public $dbname;

    public function __construct(){
        $this->server = "uzb4o9e2oe257glt.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
        $this->user = "qnbw5jjet9shcagy";
        $this->password = "eifkih84bz2zcyvl";
        $this->dbname = "la3t37o6uitnmweb";
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








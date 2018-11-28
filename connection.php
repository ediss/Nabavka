<?php

    class Connection
    {
        /*private $server = "mysql:host=localhost; dbname=nabavka2";
        private $username = "root";
        private $password = "";*/
        private $server = "mysql:host=nabavka.swissmedicacrm.com; dbname=swissme2_nabavka";
        private $username = "swissme2_edis";
        private $password = "edisadmin!";
        private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,);
        protected $conn;

        public function open(){

            try{
                $this->conn = new PDO($this->server, $this->username, $this->password, $this->options);
                return $this->conn;
            }
            catch(PDOException $e){
                echo "Greska sa povezivanjem sa bazom: ". $e->getMessage();
            }
        }

     

        public function close(){
            $this->conn=null;
        }
    }
    

?>
<?php
    include_once 'util.php';
    class databaseConnector{
        protected $pdo;
        function __construct()
        {
            $dsn = "mysql:host=".Util::$ServerName.";dbname=".Util::$databaseName."";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            try {
                $this->pdo = new PDO($dsn,Util::$Username,Util::$Db_Password,$options);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        public function connectToDatabase(){
            return $this->pdo;
        }
        public function closeDatabase(){
            $this->pdo = null;
        }
    
    }
?>
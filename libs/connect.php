<?php
    class Connect {
        
        private $host;
        private $username;
        private $password;
        private $dbName;
        private $charset;

        protected function getConnect() {
            $this->host = 'localhost';
            $this->username = 'root';
            $this->password = '';
            $this->dbName = 'php_summer';
            $this->charset = 'utf8mb4';

            try {
                $dsn = "mysql:host=".$this->host.";dbname=".$this->dbName.";charset=".$this->charset;
                $pdo = new PDO($dsn, $this->username, $this->password,  array(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION));
                return $pdo;
            } catch (PDOException $e) {
                echo 'pdo is failed to connect: '.$e->getMessage();
            }
        }

    }
?>

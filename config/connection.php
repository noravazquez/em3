<?php
    class Connection{
        private $host = 'localhost';
        private $dbname = 'em3_construcciones';
        private $username = 'postgres';
        private $password = '12345';

        public function connect(): PDO {
            try {
                $pdo = new PDO("pgsql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $pdo;
            } catch (PDOException $e) {
                die("Error de conexión: " . $e->getMessage());
            }
        }
    }
?>
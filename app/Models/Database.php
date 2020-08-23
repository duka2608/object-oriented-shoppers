<?php
    namespace app\Models;

    class Database {
        private $conn;

        public function __construct(){
            try{
                $this->conn = new \PDO("mysql:host=".SERVER.";dbname=".DBNAME.";charset=utf8", USER, PASSWORD);
                $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
                $this->conn->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
            }catch(PDOException $ex) {
                echo $ex->getMessage();
            }
        }

        public function executeQuery($query) {
            return $this->conn->query($query)->fetchAll();
        }

        public function executeQueryWOFetch($query) {
            return $this->conn->query($query);
        }

        public function executeSingleQuery($query) {
            return $this->conn->query($query)->fetch();
        }

        public function executeWithParams($query, $params) {
            $prepared = $this->conn->prepare($query);
            $prepared->execute($params);
            $result = $prepared;
            return $result;
        }

        public function executeWithParamsAndFetch($query, $params) {
            $prepared = $this->conn->prepare($query);
            $prepared->execute($params);
            $result = $prepared->fetch();
            return $result;
        }

        public function executeWithParamsAndFetchAll($query, $params) {
            $prepared = $this->conn->prepare($query);
            $prepared->execute($params);
            $result = $prepared->fetchAll();
            return $result;
        }

        public function executeWithParamsAndRowCount($query, $params) {
            $prepared = $this->conn->prepare($query);
            $prepared->execute($params);
            $result = $prepared;
            return $result->rowCount();
        }

        public function getLastId() {
            return $this->conn->lastInsertId();
        }

    }
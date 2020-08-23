<?php
    namespace app\Models\products;

    use app\Models\Database;

    class Size {
        
        private $database;

        public function __construct(Database $database) {
            $this->database = $database;
        }

        public function getAllSizes() {
            return $this->database->executeQuery("SELECT * FROM sizes");
        }
    }
<?php
    namespace app\Models\products;

    use app\Models\Database;

    class Gender {

        private $database;

        public function __construct(Database $database) {
            $this->database = $database;
        }

        public function getAllGenders() {
            return $this->database->executeQuery("SELECT * FROM gender");
        }

        public function getNumberOfProducts($genderId) {
            return $this->database->executeSingleQuery("SELECT COUNT(*) AS gender_count FROM gender_product WHERE id_gender = $genderId");
        }
    }
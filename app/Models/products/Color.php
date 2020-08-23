<?php
    namespace app\Models\products;

    use app\Models\Database;

    class Color {
        
        private $database;

        public function __construct(Database $database) {
            $this->database = $database;
        }

        public function getAllColors() {
            return $this->database->executeQuery("SELECT * FROM color");
        }

        public function getNumberOfProducts($colorId) {
            return $this->database->executeSingleQuery("SELECT COUNT(*) AS color_count FROM products WHERE id_color = $colorId");
        }
    }
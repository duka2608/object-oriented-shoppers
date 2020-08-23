<?php
    namespace app\Models\products;

    use app\Models\Database;

    class Category {

        private $database;

        public function __construct(Database $database) {
            $this->database = $database;
        }

        public function getAllCategories() {
            return $this->database->executeQuery("SELECT * FROM categories");
        }

    }
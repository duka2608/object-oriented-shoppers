<?php
    namespace app\Models\products;

    use app\Models\Database;

    class Cart {

        private $database;

        public function __construct(Database $database)
        {
            $this->database = $database;
        }

        public function getNumberOfProducts() {
            // prebaci u executeWithParams funkciju
            return $this->database->executeQuery("SELECT COUNT(*) AS product_count FROM cart WHERE id_user = 15"); 
        }

        public function insertInCart($productId, $userId) {
            return $this->database->executeWithParams(
                "INSERT INTO cart VALUES (null, ?, ?)",
                [$productId, $userId]
            );
        } 

        public function getCart($userId) {
            return $this->database->executeWithParamsAndFetchAll("SELECT products.id as productId, products.title, products.description, products.price, images.small FROM `cart` INNER JOIN products ON cart.id_product = products.id INNER JOIN images ON products.id_image = images.id WHERE cart.id_user = ?", [$userId]);
        }

        public function deleteFromDb($productId) {
            return $this->database->executeWithParams("DELETE FROM cart WHERE id_product = ?", [$productId]);
        }

        public function deleteAll() {
            return $this->database->executeQueryWOFetch("DELETE FROM cart");
        }
    }
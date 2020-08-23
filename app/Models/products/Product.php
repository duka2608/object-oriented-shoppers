<?php
    namespace app\Models\products;

    use app\Models\Database;

    class Product {
        
        private $database;

        public function __construct(Database $database) {
            $this->database = $database;
        }

        public function getAllProducts() {
            return $this->database->executeQuery("SELECT *, p.id AS product_id FROM products p INNER JOIN images i ON p.id_image = i.id");
        }

        public function getFromQuery($query) {
            return $this->database->executeQuery($query);
        }

        public function getSingleProduct($productId) {
            return $this->database->executeWithParamsAndFetch("SELECT *, p.id AS product_id FROM products p INNER JOIN images i ON p.id_image = i.id WHERE p.id = ?", [$productId]);
        }

        public function insertInDb($data) {
            return $this->database->executeWithParams("INSERT INTO products(id, title, description, price, date, id_category, id_color, id_image) VALUES (null,?,?,?,CURRENT_TIMESTAMP,?,?,?)", $data);
        }

        public function insertImage($pathOriginal, $pathNew) {
            return $this->database->executeWithParams("INSERT INTO images VALUES('null', ?, ?)", [$pathOriginal, $pathNew]);
        }

        public function insertIntoPG($genderId, $prodId) {
            return $this->database->executeWithParams("INSERT INTO gender_product VALUES(null, ?, ?)", [$genderId, $prodId]);
        }

        public function insertIntoPS($sizeId, $prodId) {
            return $this->database->executeWithParams("INSERT INTO sizes_products VALUES(null, ?, ?)", [$sizeId, $prodId]);
        }

        public function deleteFromDb($productId) {
            $query1 = $this->database->executeWithParams("DELETE FROM gender_product WHERE id_product = ?", [$productId]);
            $query2 = $this->database->executeWithParams("DELETE FROM sizes_products WHERE id_product = ?", [$productId]);
            $query3 = $this->database->executeWithParams("DELETE FROM products WHERE id = ?", [$productId]);
    
            if($query1 && $query2 && $query3) {
                return true;
            } else {
                return false;
            }

        }

        public function sortQuery() {
            return "SELECT *, p.id AS product_id FROM products p INNER JOIN images i ON p.id_image = i.id"; 
        }

        public function filterGender($gender_id){
            return $this->database->executeWithParamsAndFetchAll("SELECT *, p.id AS product_id FROM products p INNER JOIN images i ON p.id_image = i.id INNER JOIN gender_product gp ON p.id = gp.id_product WHERE id_gender = ?", [$gender_id]);
        }

        public function filterColor($color_id){
            return $this->database->executeWithParamsAndFetchAll("SELECT *, p.id AS product_id FROM products p INNER JOIN images i ON p.id_image = i.id INNER JOIN color c ON p.id_color = c.id WHERE id_color = ?", [$color_id]);
        }

        public function searchProducts($input){
            return $this->database->executeWithParamsAndFetchAll("SELECT *, p.id AS product_id FROM products p INNER JOIN images i ON p.id_image = i.id WHERE p.title LIKE ?", [$input]);
        }
    }
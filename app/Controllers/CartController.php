<?php
    namespace app\Controllers;

    use app\Models\products\Cart;

    class CartController extends Controller{
        public function index() {
            global $database;
            $cartModel = new Cart($database);
            $products = $cartModel->getCart($_SESSION['user']->user_id);
            $this->view("cart", [
                "products" => $products
            ]);
        }

        public function deleteProduct() {
            if(isset($_POST['id'])){
                global $database;
                $pr_id = $_POST['id'];

                $product = new Cart($database);

                $delete_product = $product->deleteFromDb($pr_id);
                if($delete_product){
                    $this->returnJson(["Message" => "Uspesno ste izbrisali proizvod."], 204);
                }else{
                    http_response_code(400);
                }
                var_dump($delete_product);
            }else {
                $this->returnJson(["Error" => "Internal server error."], 500);
            }
        }

        public function emptyCart() {
            if(isset($_POST['delete'])){
                global $database;
                $product = new Cart($database);

                $deleteAll = $product->deleteAll();
                if($deleteAll){
                    $this->returnJson(["Message" => "Uspesno ste izbrisali proizvod."], 204);
                }else{
                    http_response_code(400);
                }
                var_dump($deleteAll);
            }else {
                $this->returnJson(["Error" => "Internal server error."], 500);
            }
        }
    }


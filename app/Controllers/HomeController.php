<?php
    namespace app\Controllers;

    use app\Models\products\Cart;

    class HomeController extends Controller {
        public function index() {
            $this->view("home");
        }

        public function productsInCart() {
            global $database;
            if(isset($_GET['userId'])) {
                try {
                    $cart = new Cart($database);
                    $count = $cart->getNumberOfProducts();
                    header("Content-type: application/json");
    
                    return json_encode([
                        "num" => $count
                    ]);
                } catch(Exception $e) {
                    http_response_code(500);
                }

            }
        }
    }
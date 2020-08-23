<?php
    namespace app\Controllers;

    use app\Models\products\Product;
    use app\Models\products\Category;
    use app\Models\products\Color;
    use app\Models\products\Gender;
    use app\Models\products\Cart;

    class ShopController extends Controller {
        // Prikazivanje proizvoda, kategorija i liste za sortiranje
        public function index() {
            global $database;
            $productModel = new Product($database);
            $categoryModel = new Category($database);
            $colorModel = new Color($database);
            $genderModel = new Gender($database);

            $products = $productModel->getAllProducts();
            $categories = $categoryModel->getAllCategories();
            $colors = $colorModel->getAllColors();
            $genders = $genderModel->getAllGenders();

            $count = [];
            foreach($colors as $color) {
                array_push($count, $colorModel->getNumberOfProducts($color->id));
            }


            $genderCount = [];
            foreach($genders as $gender) {
                array_push($genderCount, $genderModel->getNumberOfProducts($gender->id));
            }
        
            $this->view("shop", [
                "products" => $products,
                "categories" => $categories,
                "colorsAndCount" => [
                    "colors" => $colors,
                    "count" => $count
                ],
                "gendersAndCount" => [
                    "genders" => $genders,
                    "count" => $genderCount
                ]
            ]);
        }

        // Dodavanje proizvoda u korpu
        public function insertProduct() {
            global $database;
            if(isset($_GET['productId'])) {

                $productId = $_GET['productId'];
                $userId = $_SESSION['user']->user_id;

                $cart = new Cart($database);
                try {
                    $insert = $cart->insertInCart($productId, $userId);
                    $this->returnJson(["Message" => "Uspesno ste uneli proizvod u korpu."], 204);
                } catch (Exception $ex) {
                    http_response_code(500);
                }
            }
        }

        public function sortProducts() {
            if(isset($_GET['sort'])){
                global $database;
                $product = new Product($database);
                $sort = $_GET['sort'];
        
                $query = $product->sortQuery();
        
                switch($sort){
                    case 1:
                        $query .= " ORDER BY p.title ASC";
                        break;
                    case 2:
                        $query .= " ORDER BY p.title DESC";
                        break;
                    case 3:
                        $query .= " ORDER BY p.price ASC";
                        break;
                    case 4:
                        $query .= " ORDER BY p.price DESC";
                        break;
                }
        
                $products = $product->getFromQuery($query);

                if($products) {
                    $this->returnJson([
                        "products" => $products,
                    ], 200);
                } else {
                    $this->returnJson(null, 400);
                }
            }
        }

        public function filterProducts() {
            if(isset($_GET['send'])){
                global $database;
                $product = new Product($database);

                if($_GET['send'] == "search"){
        
                    $input = "%".strtolower($_GET['input'])."%";
        
        
                    if($input == ""){            
                        http_response_code(400);
                    }else {
                        $products = $product->searchProducts($input);
        
                        if($products) {
                            $this->returnJson([
                                "products" => $products,
                            ], 200);
                        } else {
                            $this->returnJson(null, 400);
                        }
                    }
                }else if($_GET['send'] == "filter-gender"){
                    $gender_id = $_GET['gender_id'];

                    if($gender_id == 0){
                        $products = $product->getAllProducts();

                        if($products) {
                            $this->returnJson([
                                "products" => $products,
                            ], 200);
                        } else {
                            $this->returnJson(null, 400);
                        }
                    } else {
                        $products = $product->filterGender($gender_id);
        
                        if($products) {
                            $this->returnJson([
                                "products" => $products,
                            ], 200);
                        } else {
                            $this->returnJson(null, 400);
                        }
                    }

                }else if($_GET['send'] == "filter-color"){
                    $color_id = $_GET['color_id'];
        
                    $products = $product->filterColor($color_id);
        
                    if($products) {
                        $this->returnJson([
                            "products" => $products,
                        ], 200);
                    } else {
                        $this->returnJson(null, 400);
                    }
                }
            }else {
                http_response_code(400);
            }
        }
    }
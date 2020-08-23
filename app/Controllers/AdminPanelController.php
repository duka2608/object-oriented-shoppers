<?php
    namespace app\Controllers;

    use app\Models\users\User;
    use app\Models\products\Product;

    class AdminPanelController extends Controller {

        public function index() {
            global $database;

            $user = new User($database);
            $users = $user->getAllUsers();

            $product = new Product($database);
            $products = $product->getAllProducts();


            // var_dump($products);
            $this->view("admin", [
                "users" => $users,
                "products" => $products
            ]);
        }

        public function deleteProduct() {
            if(isset($_GET['id'])){
                global $database;
                $pr_id = $_GET['id'];

                $product = new Product($database);

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

        public function deleteUser() {
            if(isset($_POST['id'])){
                global $database;
                $user = new User($database);

                $id = $_POST['id'];
                $role = $user->getRole($id);
        
                if($role->role == "administrator"){
                    $this->returnJson(["Message" => "Ne mozete izbrisati administratorski nalog."], 403);
                }else{
                    $result = $user->deleteUser($id);
                    if($result){
                        $this->returnJson(["Message" => "Uspesno ste izbrisali korisnika."], 204);
                    }else{
                        http_response_code(500);
                    }
                }
            }
        }

        public function sendDataForUpdate() {
            if(isset($_POST['id'])){
                global $database;
                $user = new User($database);
                $id = $_POST['id'];
        
                $userData = $user->getSingleUser($id);
        
                if($userData){
                    $this->returnJson($userData);
                }else {
                    $this->returnJson(null, 500);
                }
            }else {
                $this->returnJson(null, 400);
            }
        }

        public function updateUser() {
            if(isset($_POST['send'])){
                global $database;
                $user = new User($database);

                $f_name = $_POST['f_name'];
                $l_name = $_POST['l_name'];
                $email = $_POST['email'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $id = $_POST['id'];

                $reg_fname = "/^[A-Z]\w{2,9}$/";
                $reg_lname = "/^[A-Z]\w{2,9}(\s[A-Z]\w{2,9})?$/";
                $reg_email = "/^([a-z0-9][-a-z0-9_\+\.]*[a-z0-9])@(ict\.edu|gmail|yahoo)\.(rs|com)$/";
                $reg_username = "/^((?=.*\d)(?=.*[a-z])).{8,}$/";
                $reg_password = "/^((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W])).{8,}$/";

                $errors = false;
                $data = [];

                if(!preg_match($reg_fname, $f_name)){
                    $errors = true;
                }else {
                    $data[] = $f_name;
                }
                if(!preg_match($reg_lname, $l_name)){
                    $errors = true;
                }else {
                    $data[] = $l_name;
                }
                if(!preg_match($reg_email, $email)){
                    $errors = true;
                }else {
                    $data[] = $email;
                }
                if(!preg_match($reg_username, $username)){
                    $errors = true;
                }else {
                    $data[] = $username;
                }
                if(!preg_match($reg_password, $password)){
                    $errors = true;
                }else {
                    $data[] = $password;
                }
                if($errors){
                    $this->returnJson(null, 422);
                }else {
                    try {
                        $result = $user->updateUser([$f_name, $l_name, $email, $username, $password, $id]);
                        if($result){
                            $this->returnJson(["Message" => "Uspesno ste izmenili korisnika."], 204);
                        }else {
                            $this->returnJson(null, 400);
                        }

                    } catch (PDOException $ex) {
                        $this->returnJson(null, 500);
                    }

                }
            }
        }
    }
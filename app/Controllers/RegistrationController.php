<?php
    namespace app\Controllers;

    use app\Models\users\User;

    class RegistrationController extends Controller {
        public function index(){
            $this->view("registration");
        }

        public function checkForUsername() {
            if(isset($_POST['send'])){
                $username = $_POST['username_value'];

                global $database;
                $user = new User($database);

                try {
                    $userN = $user->checkUsername($username);
                    $this->returnJson($userN);
                } catch(PDOException $ex) {
                    $this->returnJson(null, 500);
                }
            }
        }

        public function checkForEmail() {
            if(isset($_POST['send'])){
                $email = $_POST['email_value'];

                global $database;
                $user = new User($database);

                try {
                    $email = $user->checkEmail($email);
                    $this->returnJson($email);
                } catch(PDOException $ex) {
                    $this->returnJson(null, 500);
                }
            }
        }

        public function signIn() {
            if(isset($_POST['send']) && ($_GET['method'] == "signIn")){
                $f_name = $_POST['f_name'];
                $l_name = $_POST['l_name'];
                $email = $_POST['email'];
                $username = $_POST['username'];
                $password = $_POST['password'];
        
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
                    http_response_code(500);
                }else {
                    try {
                    global $database;
                    $user = new User($database);
                    $insertUser = $user->insertUser($data);

                    if($insertUser) {
                        $this->returnJson([
                            "result" => $insertUser,
                            "success" => "Uspešno ste napravili nalog."
                        ], 201);
                    } else {
                        http_response_code(422);
                    }
                    } catch (Exception $ex) {
                        http_response_code(500);
                    }
                }

            }
        }
    }
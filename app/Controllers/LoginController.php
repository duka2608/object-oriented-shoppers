<?php
    namespace app\Controllers;

    use app\Models\users\User;

    class LoginController extends Controller {
        public function login() {
            if(isset($_POST['send'])){
                $username = $_POST['username'];
                $password = $_POST['password'];
        
                if($username == "" || $password == ""){
                    $this->returnJson(["Error" => "Polja za username/password ne smeju biti prazna."], 401);
                }else {
                    try {
                        global $database;
                        $user = new User($database);
                        $data = $user->selectUser($username, $password);
                        if($data->rowCount() == 1){
                            $_SESSION['user'] = $data->fetch();
                            $status = $user->online($_SESSION['user']->user_id);
                            $this->returnJson($data, 204);
                        }else{
                            $this->returnJson(["Error" => "Neuspesan login"], 401);
                        }
                    } catch (PDOException $ex) {
                        $ex->getMessage();
                    }
                }
            }
        }

        public function logout() {
            global $database;
            $user = new User($database);
            $user->offline($_SESSION['user']->user_id);
            unset($_SESSION["user"]);
            session_destroy();
            header("Location: index.php?page=home");
        }
    }
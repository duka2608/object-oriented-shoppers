<?php
    session_start();

    require_once 'app/config/config.php';
    require_once 'app/Models/Database.php';
    require_once 'app/Models/products/Product.php';
    require_once 'app/Models/products/Category.php';
    require_once 'app/Models/products/Color.php';
    require_once 'app/Models/products/Gender.php';
    require_once 'app/Models/products/Size.php';
    require_once 'app/Models/products/Cart.php';
    require_once 'app/Models/users/User.php';

    require_once 'app/Controllers/Controller.php';
    require_once 'app/Controllers/HomeController.php';
    require_once 'app/Controllers/AboutController.php';
    require_once 'app/Controllers/ShopController.php';
    require_once 'app/Controllers/RegistrationController.php';
    require_once 'app/Controllers/CartController.php';
    require_once 'app/Controllers/LoginController.php';
    require_once 'app/Controllers/AdminPanelController.php';
    require_once 'app/Controllers/ProductFormController.php';


    use app\Models\Database;
    use app\Controllers\HomeController;
    use app\Controllers\AboutController;
    use app\Controllers\ShopController;
    use app\Controllers\RegistrationController;
    use app\Controllers\CartController;
    use app\Controllers\LoginController;
    use app\Controllers\AdminPanelController;
    use app\Controllers\ProductFormController;

    $database = new Database();

    if(isset($_GET['method']) && $_GET['method'] == "logout") {
        $login = new LoginController();
        $login->logout();
    }

    if(!isset($_GET['page'])){
        $home = new HomeController();
        $home->index();
    } else {
        switch($_GET['page']) {
            case 'home':
                $home = new HomeController();
                if(isset($_GET['method']) && $_GET['method'] == 'login'){
                    $login = new LoginController();
                    $login->login();
                    break;
                } else if(isset($_GET['method']) && $_GET['method'] == 'logout'){
                    $login->logout();
                    break;
                } else {
                    $home->index();
                    break;
                }
            case 'cart':
                $cart = new CartController();
                if(isset($_SESSION['user'])) {
                    if(isset($_GET['method']) && $_GET['method'] == "removeFromCart"){
                        $cart->deleteProduct();
                    break;
                    } else if(isset($_GET['method']) && $_GET['method'] == 'emptyCart'){
                        $cart->emptyCart();
                        break;  
                    }
                    $cart->index();
                break;
                } else {
                    echo "<h1>Page not found</h1>";
                }
            case 'about':
                $about = new AboutController();
                $about->index();
                break;
            case 'shop':
                $shop = new ShopController();
                if((isset($_GET['method']) && $_GET['method'] == "sortProducts" && isset($_GET['sort']))) {
                    $shop->sortProducts();
                    break;
                }  else if((isset($_GET['method']) && $_GET['method'] == "filterByGender")) {
                    $shop->filterProducts();
                    break;
                } else if((isset($_GET['method']) && $_GET['method'] == "filterByColor")) {
                    $shop->filterProducts();
                    break;
                }else if((isset($_GET['method']) && $_GET['method'] == "searchProducts")) {
                    $shop->filterProducts();
                    break;
                } else if((isset($_GET['method']) && $_GET['method']) == 'addToCart'){
                    $shop->insertProduct();
                    break;
                } else {
                    $shop->index();
                    break;
                }
            case 'registration':
                $reg = new RegistrationController();
                if((isset($_GET['method']) && $_GET['method'] == "signIn")){
                    $reg->signIn();
                    break ;
                } else if((isset($_GET['method']) && $_GET['method'] == "checkUsername")){
                    $reg->checkForUsername();
                    break ;
                } else if((isset($_GET['method']) && $_GET['method'] == "checkEmail")){
                    $reg->checkForEmail();
                    break ;
                } else {
                    $reg->index();
                    break;
                }
            case 'admin':
                    if(isset($_SESSION['user']) && $_SESSION['user']->role == "administrator"){
                        $admin = new AdminPanelController();
                        if(isset($_GET['method']) && $_GET['method'] == 'deleteProduct') {
                            $admin->deleteProduct();
                            break;
                        } else if(isset($_GET['method']) && $_GET['method'] == 'deleteUser') {
                            $admin->deleteUser();
                            break;
                        } else if(isset($_GET['method']) && $_GET['method'] == 'updateUser') {
                            $admin->sendDataForUpdate();
                            break;
                        } else if(isset($_GET['method']) && $_GET['method'] == 'sendUpdated') {
                            $admin->updateUser();
                            break;
                        }
                        else {
                            $admin->index();
                            break;
                        }
                    }else {
                        echo "<h1>Page not found</h1>";
                    }
                break;
            case 'insert-product':
                if(isset($_SESSION['user']) && $_SESSION['user']->role == "administrator"){
                    $admin = new ProductFormController();
                    if(isset($_GET['method']) && $_GET['method'] == 'insert') {
                        $admin->insertProduct();
                        break;
                    } else {
                        $admin->index();
                        break;
                    }
                }else {
                    echo "<h1>Page not found</h1>";
                }
                break;

            default: 
                $home = new HomeController();
                $home->index();
                break;
        }
    }

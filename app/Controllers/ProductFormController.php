<?php
    namespace app\Controllers;

    use app\Models\products\Gender;
    use app\Models\products\Color;
    use app\Models\products\Category;
    use app\Models\products\Size;
    use app\Models\products\Product;

    class ProductFormController extends Controller {

        public function index() {
            global $database;

            $gender = new Gender($database);
            $color = new Color($database);
            $category = new Category($database);
            $size = new Size($database);

            $this->view("product-form", [
                "genders" => $gender->getAllGenders(),
                "colors" => $color->getAllColors(),
                "categories" => $category->getAllCategories(),
                "sizes" => $size->getAllSizes()
            ]);
        }

        public function insertProduct() {
            if(isset($_FILES['ip_file'])){
                $title = $_POST['ip_title'];
                $description = $_POST['ip_description'];
                $price = $_POST['ip_price'];
                $gender = isset($_POST['chbGenders'])?$_POST['chbGenders']:null;
                $color = $_POST['ip_color'];
                $category = $_POST['ip_category'];
                $size = isset($_POST['chbSizes'])?$_POST['chbSizes']:null;
                $errors = [];
        
                if(empty($title)){
                    array_push($errors, "Morate uneti naziv proizvoda.");
                }
                if(empty($description)){
                    array_push($errors, "Morate uneti opis proizvoda.");
                }
                if(empty($price)){
                    array_push($errors, "Morate uneti cenu proizvoda.");
                }
                if(empty($gender)){
                    array_push($errors, "Morate izabrati pol.");
                }
                if($color == 0){
                    array_push($errors, "Morate izabrati boju.");
                }
                if($category == 0){
                    array_push($errors, "Morate izabrati kategoriju.");
                }
                if(empty($size)){
                    array_push($errors, "Morate izabrati velicinu.");
                }
        
                if(!empty($errors)){
                    $this->returnJson(["Errors" => $errors], 422);
                }else{
                    $file_name = $_FILES['ip_file']['name'];
                    $tmp_location = $_FILES['ip_file']['tmp_name'];
                    $file_size = $_FILES['ip_file']['size'];
                    $file_type = $_FILES['ip_file']['type'];
        
                    $errors = [];
        
                    $allowed_types = ['image/jpg', 'image/png', 'image/jpeg'];
        
                    if(!in_array($file_type, $allowed_types)){
                        array_push($errors, "Wrong file type.");
                    }
                    if($file_size > 3000000){
                        array_push($errors, "Max file size is 3MB");
                    }
        
                    if(count($errors) == 0){
                        global $database;
                        $product = new Product($database);
                        list($width, $height) = getimagesize($tmp_location);
        
                        $existingImage = null;
                        switch($file_type){
                            case 'image/jpeg':
                                $existingImage = imagecreatefromjpeg($tmp_location);
                                break;
                            case 'image/png':
                                $existingImage = imagecreatefrompng($tmp_location);
                                break;
                        }
        
                        $newHeight = $height/1.3;
                        $newWidth = ($height/$newHeight) * $width;
        
                        $newImage = imagecreatetruecolor($newWidth, $newHeight);
        
                        imagecopyresampled($newImage, $existingImage, 0, 0, 0, 0, $newWidth, $newWidth, $width, $height);
        
                        $name = time().$file_name;
                        $pathNewImage = 'app/assets/images/small/small_'.$name;
        
                        switch($file_type){
                            case 'image/jpeg':
                                imagejpeg($newImage, $pathNewImage, 75);
                                break;
                            case 'image/png':
                                imagepng($newImage, $pathNewImage);
                                break;
                        }
        
                        $pathOriginal = 'app/assets/images/'.$name;
        
                        if(move_uploaded_file($tmp_location, $pathOriginal)){
                            try {
                                $isInserted = $product->insertImage($pathOriginal, $pathNewImage);
        
                                if($isInserted){
                                    $image_id = $database->getLastId();
                                    $insertProduct = $product->insertInDb([$title, $description, $price, $category, $color, $image_id]);
                                    if($insertProduct){
                                        $prod_id = $database->getLastId();
                                        foreach($gender as $key=>$value){
                                            $pg = $product->insertIntoPG($value, $prod_id);
                                        }
                                        foreach($size as $key=>$value){
                                            $ps = $product->insertIntoPS($value, $prod_id);
                                        }
                                        if($pg && $ps) {
                                            $this->returnJson([
                                                "success" => "Uspešno ste uneli proizvod."
                                            ], 201);
                                        }

                                    }
                                }
                            } catch (PDOException $ex) {
                                echo $ex->getMessage();
                            }
                        }
        
                        imagedestroy($existingImage);
                        imagedestroy($newImage);
                    }else {
                        var_dump($errors);
                    }
                }
        
        
            }
        }
        
    }
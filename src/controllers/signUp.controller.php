<?php

namespace Src\Application\Controllers;

use Error;
use Respect\Validation\Exceptions\NestedValidationException;
use Src\Application\Core\Controller;
use Src\Infra\Models\UserModel;

use Respect\Validation\Validator as v;
use Src\Infra\Models\CategorieModel;
use Src\Infra\Models\CategoryModel;

use function Src\Application\Utils\verifyRecaptcha;

require_once __DIR__ . '/../application/core/controller.php';

class SignUpController extends Controller {
    private UserModel $userModel;
    private CategoryModel $categoryModel;

    public function index() {
        try {
            $this->userModel = $this->model("user");
            $this->categoryModel = $this->model("category");
            
            $_POST["keep_logged_in"] = $_POST["keep_logged_in"] ? "on" : "off";

            $schema = 
            v::key(
                'name',
                v::stringType()->length(3, 150)
            )->key(
                'email',
                v::email(),
            )->key(
                'password',
                v::stringType()->length(8, 16)
            )->key(
                'date_birthday',
                v::stringType()->date()
            )->key(
                "username", 
                v::stringType()->length(3, 60)
            )->key(
                "token_recaptcha",
                v::stringType()
            )->key(
                "categories",
                v::stringType()
            );
            
            $schema->assert($_POST);
            
            // $isValidRecaptcha = verifyRecaptcha($_POST["token_recaptcha"]);

            // if($isValidRecaptcha) return throw new Error("- invalid reCAPTCHA");

            $isUserExists = $this->userModel->getUserByEmail($_POST["email"]);

            if(!empty($isUserExists)) {
                throw new Error("- Email already exists");
            }

            $isUserExists = $this->userModel->getUserByUsername($_POST["username"]);

            if(!empty($isUserExists)) {
                throw new Error("- Username already exists");
            }
            
            $_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT, [
                "cost" => 14
            ]);

            $categories = array_unique(explode(",", $_POST["categories"]));

            if (count($categories) == 0) return throw new Error("- Categories is not provide");

            $indexCategory = 0;

            foreach($categories as $category) {
                $categoryByName = $this->categoryModel->findByName($category);
    
                if(empty($categoryByName)) {
                    return throw new Error("- Category not exists");
                }

                $categories[$indexCategory] = $categoryByName;
                $indexCategory++;
            }

            $token = uniqid(more_entropy: true) . uniqid(more_entropy: true);

            $userId = $this->userModel->create($_POST["name"], $_POST["email"], $_POST["password"], $_POST["username"], $_POST["date_birthday"], $token);
            
            foreach($categories as $category) {
                $this->categoryModel->addCategoryInUser($category["id"], $userId);    
            }

            if($_POST["keep_logged_in"] == "off") return 1;

            setcookie("token", $token, 3600 * 24 * 7, httponly: true, secure: true);

            return 1;
        } catch (NestedValidationException | Error  $exception) {
            if($exception instanceof Error) {
                echo $exception->getMessage();
            }

            echo $exception->getFullMessage();
        }
        
    }
}
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

            $_POST["password"] = password_hash($_POST["password"], PASSWORD_BCRYPT, [
                "cost" => 14
            ]);

            $isValidRecaptcha = verifyRecaptcha($_POST["token_recaptcha"]);

            if($isValidRecaptcha) return throw new Error("- invalid reCAPTCHA");

            $categories = explode(",", $_POST["categories"]);

            if (count($categories) == 0) return throw new Error("- Categories is not provide");


            $indexCategory = 0;

            foreach($categories as $category) {
                $categoryByName = $this->categoryModel->findByName($category);
    
                if(empty($categoryByName)) {
                    return throw new Error("- Category not exists");
                }

                $category[$indexCategory] = $categoryByName;
                $indexCategory++;
            }


            return $this->userModel->create($_POST["name"], $_POST["email"], $_POST["password"], $_POST["username"], $_POST["date_birthday"]);
        } catch (NestedValidationException | Error  $exception) {
            if($exception instanceof Error) {
                echo $exception->getMessage();
            }

            echo $exception->getFullMessage();
        }
        
    }
}
<?php
namespace Src\Views\Components\Utils;
require __DIR__ . "/../../../../components/utils/buttonComponent.php";
require __DIR__ . "/../../../../components/utils/inputComponent.php";

use function Src\Views\Components\Utils\InputComponent;
use function Src\Views\Components\Utils\ButtonComponent;
use function Src\Application\Utils\Redirect\redirect;
use Respect\Validation\Validator as v;

require_once __DIR__ . '/../../../../../../vendor/autoload.php';
require_once __DIR__ . '/../../../../../application/middlewares/RedirectUserLoggedMiddleware.php';
require_once __DIR__ . '/../../../../../application/utils/redirect.php';

$errors = [];
$error = false;

$schema = 
v::key(
    'username',
    v::stringType()->length(3, 60)
)->key(
    "email",
    v::email()
)->key(
    "date_birthday",
    v::stringType()->date()
);

$passwordSchema = 
v::key(
    "password",
    v::stringType()->length(8, 16)
)->key(
    "confirm_password",
    v::stringType()->length(8, 16),
);

if(!$schema->validate($_SESSION["redirect_data"])) redirect("../../register"); 
// TODO: TIRAR VALIDACAO IR PARA BACK-END
if($passwordSchema->validate($_POST)) {
    
    if($_POST["password"] !== $_POST["confirm_password"]) {
        $errors["password"] = "As senhas devem ser iguais!";
        $errors["confirm_password"] = "As senhas devem ser iguais!";
        $error = true;
    }
    
    if(!$error) {
        print_r($_POST["g-recaptcha-response"]);

        foreach($_SESSION["redirect_data"] as $key => $v) {
            $_POST[$key] = $v;
        }

        $url = "http://localhost/VHS/src/application/routes/route.php/api/v1/auth/signup";
        
        $post = http_build_query($_POST);

        $options = [
            "http" => [
                "method" => "POST",
                "header"  => "Content-type: application/x-www-form-urlencoded\r\n" .
                "Content-Length: " . strlen($post) . "\r\n",
                "content" => $post,
            ]
        ];

        $context = stream_context_create($options);

        $response = file_get_contents($url, false, $context);
        print("\n");
        print_r($response);


        if($response != 1 && strlen($response) == 46) {
            setcookie("token", $response, time() + 3600 * 24 * 7, path: "/", httponly: true, secure: true);
            redirect("../../../home");
        }
    }


} else {
    $errors["password"] = "Mínimo 8 caracteres e máximo 16 caracteres";
    $errors["confirm_password"] = "Mínimo 8 caracteres e máximo 16 caracteres";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VHS - Quase lá!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="/VHS/src/styles/tailwindglobal.js"></script>
    <link rel="stylesheet" href="/VHS/src/styles/global.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="flex min-h-screen text-white xl:justify-start justify-center max-w-[1920px] mx-auto">
        <div class="flex justify-center mr-24 xl:mr-24 max-xl:hidden">
            <img src="/VHS/public/images/Cassete.svg" alt="" class="relative right-14 mr-28 w-6/16">
        </div>
        <form method="post" action="?" class="relative xl:min-w-1/2 xl:mx-20 flex items-center justify-center w-full max-w-md xl:max-w-none xl:w-auto px-4 xl:px-0">
            <div class="flex flex-col gap-4">
                <div class="flex items-center flex-col gap-2">
                    <img src="/VHS/public/logos/Logo.svg" alt="">
                    <h2 class="font-semibold text-3xl text-white max-xl:text-2xl">Quase lá!</h2>
                    <p class="text-gray-200">Informe sua senha para criar sua conta!</p>
                </div>
                <div class="flex flex-col gap-4 w-full xl:w-96">
                    <?= InputComponent(name: "password", placeholder: "Insira sua senha", type: "password", label: "Senha", icon: "/VHS/public/icons/eyeOff.svg", iconPosition: "right-3", error: isset($errors["password"]), errorDescription: isset($errors["password"]) ? $errors["password"] : "") ?>
                    <?= InputComponent(name: "confirm_password", placeholder: "Confirme sua senha", type: "password", label: "Confirmar senha", icon: "/VHS/public/icons/eyeOff.svg", iconPosition: "right-3", error: isset($errors["confirm_password"]), errorDescription: isset($errors["confirm_password"]) ? $errors["confirm_password"] : "") ?>
                      <?= ButtonComponent("Continuar", "default", className: " g-recaptcha btn-submit mt-4", type: "button", attributes: [
                        "data-sitekey" => "6LeZE6MrAAAAAFW6zL9HUPU8eJ616uwPWu92db9a",
                        "data-callback" => "onSubmit",
                        "data-action" => 'submit',
                        "onClick" => '() => grecaptcha.execute()'
                    ]) ?>
                </div>
            </div>
        </form>
    </div>
    <script>
        function onSubmit(token) {
            document.querySelector("form").submit();
        }
    </script>
</body>
</html>
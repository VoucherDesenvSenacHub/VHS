<?php

namespace Src\Application\Controllers;

use Src\Application\Core\Controller;
use Src\Infra\Model\UserModel;
use Faker\Factory;

class SeedUsersController extends Controller
{
    private UserModel $userModel;

    public function index()
    {
        $this->userModel = $this->model("user");
        $faker = Factory::create('pt_BR');

        $count = 0;
        for ($i = 0; $i < 50; $i++) {
            $name = $faker->name;
            $email = $faker->unique()->email;
            $password = password_hash('12345678', PASSWORD_DEFAULT);
            $username = $faker->unique()->userName;
            $date_birthday = $faker->date('Y-m-d', '-18 years');
            $token = bin2hex(random_bytes(16));

            $userId = $this->userModel->create($name, $email, $password, $username, $date_birthday, $token);

            // Update role to CREATOR for some users to be searchable as channels
            if ($i % 2 == 0) {
                $this->userModel->updateUserAdmin($userId, $name, 'CREATOR', '1');
            }

            $count++;
        }

        echo "Seeded $count users successfully!";
    }
}

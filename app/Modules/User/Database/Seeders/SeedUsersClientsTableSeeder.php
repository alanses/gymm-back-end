<?php

namespace App\Modules\User\Database\Seeders;

use App\Modules\User\Entities\User;
use App\Modules\User\Repositories\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Generator as Faker;

class SeedUsersClientsTableSeeder extends Seeder
{
    private $userRepository;
    /**
     * @var Faker
     */
    private $generator;

    public function __construct(UserRepository $userRepository, Faker $generator)
    {
        $this->userRepository = $userRepository;
        $this->generator = $generator;
    }

    public function run()
    {
        Model::unguard();

        for ($i = 1; $i <= 50; $i++) {
            $this->userRepository->create([
                'name' => $this->generator->name,
                'email' => $this->generator->email,
                'password' => 'secret',
                'user_type' => User::$is_user
            ]);
        }
    }
}

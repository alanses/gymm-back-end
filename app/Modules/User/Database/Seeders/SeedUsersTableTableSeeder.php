<?php

namespace App\Modules\User\Database\Seeders;

use App\Modules\User\Entities\User;
use App\Modules\User\Repositories\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeedUsersTableTableSeeder extends Seeder
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function run()
    {
        Model::unguard();

        $this->userRepository->create([
            'name' => 'admin',
            'password' => 'admin',
            'email' => 'SupperAdmin@gmail.com',
            'user_type' => User::$is_supper_admin
        ]);

        $this->userRepository->create([
            'name' => 'TestGym',
            'password' => '12345678',
            'email' => 'TestGym@gmail.com',
            'user_type' => User::$is_gym
        ]);

        $this->userRepository->create([
            'name' => 'TestUser',
            'password' => '12345678',
            'email' => 'TestUser@gmail.com',
            'user_type' => User::$is_user
        ]);
    }
}

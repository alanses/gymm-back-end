<?php

namespace App\Modules\User\Database\Seeders;

use App\Modules\Gym\Repositories\GymRepository;
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
    private $gymRepository;

    public function __construct(UserRepository $userRepository, GymRepository $gymRepository)
    {
        $this->userRepository = $userRepository;
        $this->gymRepository = $gymRepository;
    }

    public function run()
    {
        Model::unguard();

        $this->userRepository->create([
            'name' => 'admin',
            'password' => 'admin',
            'email' => 'SupperAdmin@gmail.com',
            'user_type' => User::$is_admin
        ]);

        $this->userRepository->create([
            'name' => 'TestUser',
            'password' => '12345678',
            'email' => 'TestUser@gmail.com',
            'user_type' => User::$is_user
        ]);
    }
}

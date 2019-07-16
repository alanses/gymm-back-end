<?php

namespace App\Modules\User\Database\Seeders;

use App\Modules\Gym\Repositories\GymRepository;
use App\Modules\User\Entities\User;
use App\Modules\User\Repositories\UserRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeedGymsTableTableSeeder extends Seeder
{
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

        $userGym = $this->userRepository->create([
            'name' => 'TestGym',
            'password' => '12345678',
            'email' => 'TestGym@gmail.com',
            'user_type' => User::$is_gym
        ]);

        $this->gymRepository->create([
            'user_id' => $userGym->id
        ]);
    }
}

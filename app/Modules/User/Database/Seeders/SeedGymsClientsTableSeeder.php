<?php

namespace App\Modules\User\Database\Seeders;

use App\Modules\Gym\Repositories\GymRepository;
use App\Modules\User\Entities\User;
use App\Modules\User\Repositories\UserRepository;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeedGymsClientsTableSeeder extends Seeder
{
    private $userRepository;
    private $gymRepository;
    /**
     * @var Faker
     */
    private $generator;

    public function __construct
    (
        UserRepository $userRepository,
        GymRepository $gymRepository,
        Faker $generator
    )
    {
        $this->userRepository = $userRepository;
        $this->gymRepository = $gymRepository;
        $this->generator = $generator;
    }

    public function run()
    {
        Model::unguard();

        for ($i = 1; $i <= 50; $i++) {
            $userGym = $this->userRepository->create([
                'name' => $this->generator->name,
                'password' => 'secret',
                'email' => $this->generator->email,
                'user_type' => User::$is_gym
            ]);

            $this->gymRepository->create([
                'user_id' => $userGym->id,
                'address' => $this->generator->address,
                'description' => $this->generator->text,
                'available_from' => $this->generator->dateTime($max = 'now', $timezone = null),
                'available_to' => $this->generator->dateTime($max = 'now', $timezone = null),
                'lat' => $this->generator->randomFloat(NULL, 0,100),
                'lng' => $this->generator->randomFloat(NULL, 0,100)
            ]);
        }
    }
}

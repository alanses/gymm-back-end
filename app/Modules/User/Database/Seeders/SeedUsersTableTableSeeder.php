<?php

namespace App\Modules\User\Database\Seeders;

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
            'login' => 'admin',
            'password' => 'admin',
            'email' => 'admin@gmail.com'
        ]);
    }
}

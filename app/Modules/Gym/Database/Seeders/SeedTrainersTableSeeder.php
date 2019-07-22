<?php

namespace App\Modules\Gym\Database\Seeders;

use App\Modules\Gym\Repositories\TrainerRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\WithFaker;

class SeedTrainersTableSeeder extends Seeder
{

    use WithFaker;
    /**
     * @var TrainerRepository
     */
    private $trainerRepository;

    public function __construct(TrainerRepository $trainerRepository)
    {
        $this->trainerRepository = $trainerRepository;
        $this->setUpFaker();
    }

    public function run()
    {
        Model::unguard();

        for ($i = 1; $i <= 50; $i++) {
            $trainer = $this->trainerRepository->create([
                'gym_id' => 1,
                'trainer_name' => $this->faker->name,
                'level' => rand(1,3),
                'cretits_from' => rand(1,15),
                'cretits_to' => rand(16,30),
            ]);

            $trainer->activities()->sync([
                1,
                2,
                3
            ]);
        }
    }
}

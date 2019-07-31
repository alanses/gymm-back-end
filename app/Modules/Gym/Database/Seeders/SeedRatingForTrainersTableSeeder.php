<?php

namespace App\Modules\Gym\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Gym\Repositories\RatingForTrainerRepository;
use Illuminate\Foundation\Testing\WithFaker;

class SeedRatingForTrainersTableSeeder extends Seeder
{

    use WithFaker;
    /**
     * @var RatingForTrainerRepository
     */
    private $ratingForTrainerRepository;

    public function __construct(RatingForTrainerRepository $ratingForTrainerRepository)
    {
        $this->ratingForTrainerRepository = $ratingForTrainerRepository;
    }

    public function run()
    {
        Model::unguard();

        $this->setUpFaker();

        for ($i = 1; $i <= 50; $i++) {
            $this->ratingForTrainerRepository->create([
                'trainer_id'  => rand(1, 50),
                'user_id' => 2,
                'rating_value' => rand(0, 5),
                'comment' => $this->faker->text
            ]);
        }
    }
}

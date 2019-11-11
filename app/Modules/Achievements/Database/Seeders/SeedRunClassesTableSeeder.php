<?php

namespace App\Modules\Achievements\Database\Seeders;

use App\Modules\Achievements\Repositories\AchievementRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeedRunClassesTableSeeder extends Seeder
{
    /**
     * @var AchievementRepository
     */
    private $repository;

    public function __construct(AchievementRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        Model::unguard();

        $this->repository->create([
            'displayed_name' => '10 Run Classes',
            'achivement_id' => 4,
            'count_classes' => 3
        ]);

        $this->repository->create([
            'displayed_name' => '15 Run Classes',
            'achivement_id' => 4,
            'count_classes' => 15,
        ]);

        $this->repository->create([
            'displayed_name' => '30 Run Classes',
            'achivement_id' => 4,
            'count_classes' => 30,
        ]);
    }
}

<?php

namespace App\Modules\Activities\Database\Seeders;

use App\Modules\Activities\Repositories\ActivityRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeedActivitiesTableTableSeeder extends Seeder
{
    /**
     * @var ActivityRepository
     */
    private $activityRepository;

    public function __construct(ActivityRepository $activityRepository)
    {
        $this->activityRepository = $activityRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $listActivities = [
            [
                'name' => 'yoga',
                'displayed_name' => 'Yoga',
            ],
            [
                'name' => 'cicling',
                'displayed_name' => 'Cicling',
            ],
            [
                'name' => 'gym_time',
                'displayed_name' => 'Gym time',
            ],
            [
                'name' => 'running',
                'displayed_name' => 'Running',
            ],
            [
                'name' => 'boxing',
                'displayed_name' => 'Boxing',
            ],
            [
                'name' => 'dance',
                'displayed_name' => 'Dance',
            ],
        ];

        array_map(function ($activity) {
            $this->activityRepository->create($activity);
        }, $listActivities);
    }
}

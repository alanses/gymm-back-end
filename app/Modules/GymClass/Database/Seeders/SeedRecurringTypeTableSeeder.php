<?php

namespace App\Modules\GymClass\Database\Seeders;

use App\Modules\GymClass\Repositories\RecurringTypeRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeedRecurringTypeTableSeeder extends Seeder
{
    /**
     * @var RecurringTypeRepository
     */
    private $repository;

    public function __construct(RecurringTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        Model::unguard();

        $this->repository->create([
            'displayed_name' => 'Every day',
            'recurring_type' => 'every_day'
        ]);

        $this->repository->create([
            'displayed_name' => 'Every week',
            'recurring_type' => 'every_week'
        ]);

        $this->repository->create([
            'displayed_name' => 'Every month',
            'recurring_type' => 'every_month'
        ]);

    }
}

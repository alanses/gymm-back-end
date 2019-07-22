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
            'displayed_name' => 'Daily',
            'recurring_type' => 'daily'
        ]);

        $this->repository->create([
            'displayed_name' => 'Weekly',
            'recurring_type' => 'weekly'
        ]);

        $this->repository->create([
            'displayed_name' => 'Monthly',
            'recurring_type' => 'monthly'
        ]);

    }
}

<?php

namespace App\Modules\Plans\Database\Seeders;

use App\Modules\Plans\Repositories\PlanRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeedPlansTableTableSeeder extends Seeder
{

    /**
     * @var PlanRepository
     */
    private $repository;

    public function __construct(PlanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        Model::unguard();

        $this->repository->create([
            'name' => 'Base',
            'description' => 'Access to thousands studios gyms and classes',
            'count_credits' => 15,
            'payment_for_month' => 59
        ]);

        $this->repository->create([
            'name' => 'Core',
            'description' => 'Access to thousands studios gyms and classes',
            'count_credits' => 25,
            'payment_for_month' => 139
        ]);

        $this->repository->create([
            'name' => 'Unlimited',
            'description' => 'Access to thousands studios gyms and classes',
            'count_credits' => 80,
            'payment_for_month' => 219
        ]);
    }
}

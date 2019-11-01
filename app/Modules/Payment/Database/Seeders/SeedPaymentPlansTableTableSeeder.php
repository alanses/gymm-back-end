<?php

namespace App\Modules\Payment\Database\Seeders;

use App\Modules\Payment\Repositories\PaymentPlanRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeedPaymentPlansTableTableSeeder extends Seeder
{
    /**
     * @var PaymentPlanRepository
     */
    private $repository;

    public function __construct(PaymentPlanRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        Model::unguard();

        $this->repository->create([
            'name' => 'small',
            'description' => 'small plan',
            'count_credits' => 10,
            'price' => 10
        ]);

        $this->repository->create([
            'name' => 'medium',
            'description' => 'medium plan',
            'count_credits' => 20,
            'price' => 20
        ]);

        $this->repository->create([
            'name' => 'large',
            'description' => 'large plan',
            'count_credits' => 30,
            'price' => 30
        ]);
    }
}

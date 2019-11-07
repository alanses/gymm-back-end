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
            'price' => 79,
            'old_price' => 89,
            'discount' => 11
        ]);

        $this->repository->create([
            'name' => 'medium',
            'description' => 'medium plan',
            'count_credits' => 25,
            'price' => 179,
            'old_price' => 223,
            'discount' => 20
        ]);

        $this->repository->create([
            'name' => 'large',
            'description' => 'large plan',
            'count_credits' => 50,
            'price' => 350,
            'old_price' => 445,
            'discount' => 21
        ]);
    }
}

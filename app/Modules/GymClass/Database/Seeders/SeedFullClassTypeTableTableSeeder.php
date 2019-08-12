<?php

namespace App\Modules\GymClass\Database\Seeders;

use App\Modules\GymClass\Repositories\FullClassTypeRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeedFullClassTypeTableTableSeeder extends Seeder
{
    /**
     * @var FullClassTypeRepository
     */
    private $repository;

    public function __construct(FullClassTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        Model::unguard();

        $this->repository->create([
            'name' => 'CF',
            'displayed_name' => 'Completely full'
        ]);

        $this->repository->create([
            'name' => 'NF',
            'displayed_name' => 'Nearly Full'
        ]);

        $this->repository->create([
            'name' => 'APF',
            'displayed_name' => 'About 75 Percent Full'
        ]);

        $this->repository->create([
            'name' => 'HWF',
            'displayed_name' => 'HAlf Way Full'
        ]);

        $this->repository->create([
            'name' => 'LTHF',
            'displayed_name' => 'Less Than Half Full'
        ]);
    }
}

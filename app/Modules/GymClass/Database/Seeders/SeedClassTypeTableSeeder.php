<?php

namespace App\Modules\GymClass\Database\Seeders;

use App\Modules\GymClass\Repositories\ClassTypeRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeedClassTypeTableSeeder extends Seeder
{
    /**
     * @var ClassTypeRepository
     */
    private $classTypeRepository;

    public function __construct(ClassTypeRepository $classTypeRepository)
    {
        $this->classTypeRepository = $classTypeRepository;
    }


    public function run()
    {
        Model::unguard();

        $this->classTypeRepository->create([
            'name' => 'Group',
            'displayed_name' => 'group'
        ]);

        $this->classTypeRepository->create([
            'name' => 'Personal',
            'displayed_name' => 'personal'
        ]);
    }
}

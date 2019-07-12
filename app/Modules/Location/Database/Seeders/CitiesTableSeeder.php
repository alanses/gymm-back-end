<?php

namespace App\Modules\Location\Database\Seeders;

use App\Modules\Location\Repositories\CitiesRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CitiesTableSeeder extends Seeder
{
    /**
     * @var CitiesRepository
     */

    private $citiesRepository;

    public function __construct(CitiesRepository $citiesRepository)
    {
        $this->citiesRepository = $citiesRepository;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function run()
    {
        Model::unguard();

        $this->citiesRepository->create([
            'country_id' => 228,
            'name' => 'lviv'
        ]);
    }
}

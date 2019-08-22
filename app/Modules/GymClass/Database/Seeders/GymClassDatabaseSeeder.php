<?php

namespace App\Modules\GymClass\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class GymClassDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(SeedClassTypeTableSeeder::class);
        $this->call(SeedRecurringTypeTableSeeder::class);
        $this->call(SeedFullClassTypeTableTableSeeder::class);
    }
}

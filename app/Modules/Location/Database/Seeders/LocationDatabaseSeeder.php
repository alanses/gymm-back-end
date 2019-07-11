<?php

namespace App\Modules\Location\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class LocationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CountriesDatabaseSeeder::class);

        // $this->call("OthersTableSeeder");
    }
}

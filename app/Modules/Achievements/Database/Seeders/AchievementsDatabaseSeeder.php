<?php

namespace App\Modules\Achievements\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AchievementsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(SeedBoxingClassesTableSeeder::class);
        $this->call(SeedClassesTableSeeder::class);
        $this->call(SeedYogaClassesTableSeeder::class);
        $this->call(SeedRunClassesTableSeeder::class);
        $this->call(SeedDancesClassesTableSeeder::class);
        $this->call(SeedCyclingTableSeeder::class);

    }
}

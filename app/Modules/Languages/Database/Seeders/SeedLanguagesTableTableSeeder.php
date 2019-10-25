<?php

namespace App\Modules\Languages\Database\Seeders;

use App\Modules\Languages\Repositories\LanguageRepository;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeedLanguagesTableTableSeeder extends Seeder
{
    /**
     * @var LanguageRepository
     */
    private $languageRepository;

    public function __construct(LanguageRepository $languageRepository)
    {
        $this->languageRepository = $languageRepository;
    }

    public function run()
    {
        Model::unguard();

        $this->languageRepository->create([
            'short_name' => 'en',
            'disabled_name' => 'English'
        ]);

        $this->languageRepository->create([
            'short_name' => 'kz',
            'disabled_name' => 'Kazakhstan'
        ]);
    }
}

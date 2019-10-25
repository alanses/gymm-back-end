<?php

namespace App\Modules\Languages\Tasks;

use App\Modules\Languages\Repositories\LanguageRepository;
use App\Ship\Abstraction\AbstractTask;

class GetListLanguagesTask extends AbstractTask
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
        return $this->languageRepository->get();
    }
}

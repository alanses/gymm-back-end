<?php

namespace App\Modules\Languages\Repositories;

use App\Modules\Languages\Entities\Language;
use App\Ship\Abstraction\AbstractRepository;

class LanguageRepository extends AbstractRepository
{
    protected $fieldSearchable = [];

    /**
    * @throws \Prettus\Repository\Exceptions\RepositoryException
    */
    public function boot()
    {

    }

    /**
    * @return string
    */
    function model()
    {
        return Language::class;
    }
}

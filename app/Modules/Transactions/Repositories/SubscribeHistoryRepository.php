<?php

namespace App\Modules\Transactions\Repositories;

use App\Modules\Transactions\Entities\SubscribeHistory;
use App\Ship\Abstraction\AbstractRepository;

class SubscribeHistoryRepository extends AbstractRepository
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
        return SubscribeHistory::class;
    }
}

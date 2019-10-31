<?php

namespace App\Modules\Transactions\Repositories;

use App\Modules\Transactions\Entities\Transaction;
use App\Ship\Abstraction\AbstractRepository;

class TransactionRepository extends AbstractRepository
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
        return Transaction::class;
    }
}

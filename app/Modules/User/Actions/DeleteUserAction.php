<?php

namespace App\Modules\User\Actions;

use App\Modules\User\Repositories\UserRepository;
use App\Ship\Abstraction\AbstractAction;

class DeleteUserAction extends AbstractAction
{
    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        return $this->repository->delete($id);
    }
}

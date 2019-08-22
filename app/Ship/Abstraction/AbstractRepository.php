<?php


namespace App\Ship\Abstraction;

use Prettus\Repository\Eloquent\BaseRepository;

abstract class AbstractRepository extends BaseRepository
{
    /**
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function count() {

        $this->applyCriteria();
        $this->applyScope();

        $result = $this->model->count();

        $this->resetModel();
        $this->resetScope();

        return $result;
    }

    /**
     * @param string $field
     * @return mixed
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function sum(string $field)
    {
        $this->applyCriteria();
        $this->applyScope();

        $result = $this->model->sum($field);

        $this->resetModel();
        $this->resetScope();

        return $result;
    }
}

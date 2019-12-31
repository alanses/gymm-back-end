<?php

namespace App\Modules\SliderImages\Tasks;

use App\Modules\SliderImages\Repositories\ImageSliderRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisEqualThatCriteria;

class GetSliderImageTask extends AbstractTask
{
    /**
     * @var ImageSliderRepository
     */
    private $repository;

    public function __construct(ImageSliderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        return $this->repository->first();
    }

    public function findByRelation($field, $value)
    {
        $this->repository->pushCriteria(new ThisEqualThatCriteria($field, $value));
    }
}

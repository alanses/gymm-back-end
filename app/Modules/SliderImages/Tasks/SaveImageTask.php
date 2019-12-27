<?php

namespace App\Modules\SliderImages\Tasks;

use App\Modules\SliderImages\Repositories\ImageSliderRepository;
use App\Ship\Abstraction\AbstractTask;

class SaveImageTask extends AbstractTask
{
    /**
     * @var ImageSliderRepository
     */
    private $repository;

    public function __construct(ImageSliderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $attributes)
    {
        return $this->repository->create($attributes);
    }
}

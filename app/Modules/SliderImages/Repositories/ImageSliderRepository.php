<?php

namespace App\Modules\SliderImages\Repositories;

use App\Modules\SliderImages\Entities\ImageSlider;
use App\Ship\Abstraction\AbstractRepository;

class ImageSliderRepository extends AbstractRepository
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
        return ImageSlider::class;
    }
}

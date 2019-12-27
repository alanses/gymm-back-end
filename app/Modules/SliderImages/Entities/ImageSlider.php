<?php

namespace App\Modules\SliderImages\Entities;

use App\Ship\Abstraction\AbstractEntity;

class ImageSlider extends AbstractEntity
{
    protected $table = 'images_slider';

    protected $fillable = [
        'image',
        'description',
        'origin_image'
    ];

    public static $PATH_TO_IMAGE = 'images/slider';
}

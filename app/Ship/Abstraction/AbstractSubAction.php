<?php


namespace App\Ship\Abstraction;

use App\Ship\Interfaces\ParentInterface;
use App\Ship\Interfaces\SubActionInterface;
use App\Ship\Traits\CallableTrait;

abstract class AbstractSubAction implements SubActionInterface, ParentInterface
{
    use CallableTrait;
}

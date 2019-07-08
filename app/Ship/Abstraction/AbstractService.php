<?php


namespace App\Ship\Abstraction;

use App\Ship\Interfaces\ParentInterface;
use App\Ship\Interfaces\ServiceInterface;
use App\Ship\Traits\CallableTrait;

abstract class AbstractService implements ServiceInterface, ParentInterface
{
    use CallableTrait;
}

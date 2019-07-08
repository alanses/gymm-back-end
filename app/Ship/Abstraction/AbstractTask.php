<?php


namespace App\Ship\Abstraction;

use App\Ship\Interfaces\ParentInterface;
use App\Ship\Interfaces\TaskInterface;
use App\Ship\Traits\CallableTrait;

abstract class AbstractTask implements TaskInterface, ParentInterface
{
    use CallableTrait;
}

<?php


namespace App\Ship\Abstraction;

use App\Ship\Interfaces\ActionInterface;
use App\Ship\Interfaces\ParentInterface;
use App\Ship\Traits\CallableTrait;

abstract class AbstractAction implements ActionInterface, ParentInterface
{
    use CallableTrait;
}

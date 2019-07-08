<?php


namespace App\Ship\Abstraction;

use App\Ship\Interfaces\EntityInterface;
use App\Ship\Interfaces\ParentInterface;
use App\Ship\Traits\HasResourceKeyTrait;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractEntity extends Model implements EntityInterface, ParentInterface
{
    use HasResourceKeyTrait;
}

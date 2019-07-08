<?php


namespace App\Ship\Parents;

use App\Ship\Interfaces\ParentInterface;
use App\Ship\Interfaces\WebControllerInterface;
use App\Ship\Traits\CallableTrait;
use App\Ship\Traits\HttpResponses;

class WebController implements WebControllerInterface, ParentInterface
{
    use HttpResponses;
    use CallableTrait;
}

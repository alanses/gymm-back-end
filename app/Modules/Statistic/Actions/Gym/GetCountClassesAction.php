<?php
namespace App\Modules\Statistic\Actions\Gym;

use App\Modules\Gym\Entities\Gym;
use App\Ship\Abstraction\AbstractAction;

class GetCountClassesAction extends AbstractAction
{
    public function run(Gym $gym)
    {
        return $gym->classSchedules()->count();
    }
}

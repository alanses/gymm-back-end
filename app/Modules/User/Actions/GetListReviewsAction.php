<?php

namespace App\Modules\User\Actions;

use App\Modules\Gym\Tasks\GetGymFromUserTask;
use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Modules\User\Tasks\ListReviewsTask;
use App\Ship\Abstraction\AbstractAction;

class GetListReviewsAction extends AbstractAction
{
    public function run()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);
        $gym = $this->call(GetGymFromUserTask::class, [$user]);

        $reviews = $this->call(ListReviewsTask::class, [], [
            ['whereGymIS' => [$gym->id]]
        ]);

        return $reviews->load('user');
    }
}

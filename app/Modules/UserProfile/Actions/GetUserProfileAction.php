<?php

namespace App\Modules\UserProfile\Actions;

use App\Modules\User\Tasks\GetAuthenticatedUserTask;
use App\Ship\Abstraction\AbstractAction;
use Carbon\Carbon;

class GetUserProfileAction extends AbstractAction
{
    public function run()
    {
        $user = $this->call(GetAuthenticatedUserTask::class);

        return $user->load(
            [
                'userDetail' => function($query) {
                    $query->with('plan');
                },
                'bookings' => function($query2) {
                    $query2->with('classSchedule')
                        ->whereHas('classSchedule', function($query) {
                            $query->where('start_date', '>', Carbon::now());
                        });
                }
            ]
        );
    }
}

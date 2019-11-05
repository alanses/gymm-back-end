<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\User\Entities\User;
use App\Ship\Abstraction\AbstractTask;
use Illuminate\Support\Facades\DB;

class DeleteSubscribedJobsTask extends AbstractTask
{
    public function run(User $user)
    {
        DB::table('jobs')
            ->where('payload','like', '%'. $user->email .'%')
            ->orWhere('payload', 'like', '%'. $user->login .'%')
            ->delete();
    }
}

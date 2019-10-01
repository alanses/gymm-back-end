<?php

namespace App\Modules\Gym\Tasks;

use App\Modules\Admin\Http\Requests\GymRequest;
use App\Modules\Gym\Entities\Gym;
use App\Ship\Abstraction\AbstractTask;

class ChangeConfirmationGymTask extends AbstractTask
{
    public function run(Gym $gym, GymRequest $request)
    {
        $available = (int)$request->available;

        return $gym->update([
            'is_available' => $available
        ]);
    }
}

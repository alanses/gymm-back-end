<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Http\Requests\ReviewRequest;
use App\Modules\Gym\Tasks\UpdateRatingForTrainerTask;
use App\Ship\Abstraction\AbstractAction;

class UpdateReviewAction extends AbstractAction
{
    public function run(ReviewRequest $request)
    {
        return $this->call(UpdateRatingForTrainerTask::class, [
            $this->getDataForUpdateTrainerRating($request),
            $request->id
        ]);
    }

    private function getDataForUpdateTrainerRating(ReviewRequest $request)
    {
        return $request->only(['comment']);
    }
}

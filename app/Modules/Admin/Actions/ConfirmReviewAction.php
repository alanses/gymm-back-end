<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Http\Requests\ConfirmReviewRequest;
use App\Modules\Gym\Tasks\UpdateRatingForTrainerTask;
use App\Ship\Abstraction\AbstractAction;

class ConfirmReviewAction extends AbstractAction
{
    public function run(ConfirmReviewRequest $request)
    {
        return $this->call(UpdateRatingForTrainerTask::class, [
            $this->getDataForUpdateTrainerRating($request),
            $request->id
        ]);
    }

    private function getDataForUpdateTrainerRating(ConfirmReviewRequest $request)
    {
        return [
            'published' => (int)$request->available
        ];
    }
}

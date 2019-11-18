<?php

namespace App\Modules\Admin\Actions;

use App\Modules\Admin\Http\Requests\EmailToAdminRequest;
use App\Modules\Admin\Tasks\SendEmailToAdminAboutReviewTask;
use App\Modules\GymClass\Tasks\GetReviewTask;
use App\Ship\Abstraction\AbstractAction;

class SendEmailToAdminAboutReviewAction extends AbstractAction
{
    public function run(EmailToAdminRequest $request)
    {
        $adminEmail = env('ADMIN_EMAIL');

        $review = $this->call(GetReviewTask::class, [], [
            ['findByField' => ['id', $request->review_id]]
        ])
            ->load(['user']);

        return $this->call(SendEmailToAdminAboutReviewTask::class, [$adminEmail, $review]);
    }
}

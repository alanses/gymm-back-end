<?php

namespace App\Modules\User\Http\Controllers;

use App\Modules\User\Actions\GetListReviewsAction;
use App\Modules\User\Transformers\ReviewsTrasformer;
use App\Ship\Parents\ApiController;

class ReviewsController extends ApiController
{
    public function getListReviews()
    {
        $reviews = $this->call(GetListReviewsAction::class);

        return ReviewsTrasformer::collection($reviews);
    }
}

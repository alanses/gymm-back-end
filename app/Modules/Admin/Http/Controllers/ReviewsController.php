<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Admin\Actions\ConfirmReviewAction;
use App\Modules\Admin\Actions\GetListReviewsAction;
use App\Modules\Admin\Actions\GetReviewAction;
use App\Modules\Admin\Actions\UpdateReviewAction;
use App\Modules\Admin\Http\Requests\ConfirmReviewRequest;
use App\Modules\Admin\Http\Requests\ReviewRequest;
use App\Modules\Admin\Transformers\ListReviewsTransformer;
use App\Ship\Parents\ApiController;

class ReviewsController extends ApiController
{
    public function getListReviews()
    {
        $reviews = $this->call(GetListReviewsAction::class);

        return ListReviewsTransformer::collection($reviews);
    }

    public function getReview($id)
    {
        $review = $this->call(GetReviewAction::class, [$id]);

        return new ListReviewsTransformer($review);
    }

    public function updateReview(ReviewRequest $request)
    {
        $review = $this->call(UpdateReviewAction::class, [$request]);

        return new ListReviewsTransformer($review);
    }

    public function confirmReview(ConfirmReviewRequest $request)
    {
        $review = $this->call(ConfirmReviewAction::class, [$request]);

        return new ListReviewsTransformer($review);
    }
}

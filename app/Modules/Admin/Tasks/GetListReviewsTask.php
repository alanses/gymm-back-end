<?php

namespace App\Modules\Admin\Tasks;

use App\Modules\Gym\Repositories\RatingForTrainerRepository;
use App\Ship\Abstraction\AbstractTask;
use App\Ship\Criterias\Eloquent\ThisLikeThatCriteria;

class GetListReviewsTask extends AbstractTask
{
    /**
     * @var RatingForTrainerRepository
     */
    private $ratingForTrainerRepository;

    public function __construct(RatingForTrainerRepository $ratingForTrainerRepository)
    {
        $this->ratingForTrainerRepository = $ratingForTrainerRepository;
    }

    public function run()
    {
        return $this->ratingForTrainerRepository->paginate(10);
    }

    public function withRelation()
    {
        $this->ratingForTrainerRepository->with(['user', 'classSchedule.gym']);
    }

    public function search(?string $value)
    {
        if($value) {
            $this->ratingForTrainerRepository->pushCriteria(new ThisLikeThatCriteria('comment', $value));
        }
    }
}

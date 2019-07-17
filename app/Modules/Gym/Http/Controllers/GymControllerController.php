<?php

namespace App\Modules\Gym\Http\Controllers;

use App\Modules\Gym\Actions\CreateTrainerAction;
use App\Modules\Gym\Actions\FindTrainerByIdAction;
use App\Modules\Gym\Actions\GetListTrainersForSelectAction;
use App\Modules\Gym\Http\Requests\AddTrainerRequest;
use App\Modules\Gym\Transformers\TrainersForSelectTransformer;
use App\Modules\Gym\Transformers\TrainerTransformer;
use App\Ship\Parents\ApiController;
use Illuminate\Http\Request;

class GymControllerController extends ApiController
{
    /**
     * @param AddTrainerRequest $request
     * @return TrainerTransformer
     */
    public function addTrainer(AddTrainerRequest $request)
    {
        $trainer = $this->call(CreateTrainerAction::class, [$request]);

        return new TrainerTransformer($trainer);
    }

    /**
     * @param $id
     * @return TrainerTransformer
     */
    public function getTrainerById($id)
    {
        $trainer = $this->call(FindTrainerByIdAction::class, [$id]);

        return new TrainerTransformer($trainer);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getListTrainersForSelect(Request $request)
    {
        $trainers = $this->call(GetListTrainersForSelectAction::class, [$request->user_id]);

        return TrainersForSelectTransformer::collection($trainers);
    }
}

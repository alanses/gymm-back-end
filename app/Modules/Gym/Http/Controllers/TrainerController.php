<?php

namespace App\Modules\Gym\Http\Controllers;

use App\Modules\Gym\Actions\GetTrainerByIdForScheduleAction;
use App\Modules\Gym\Actions\Trainers\DeleteTrainerAction;
use App\Modules\Gym\Actions\Trainers\GetListTrainersForProfileAction;
use App\Modules\Gym\Http\Requests\DeleteTrainerRequest;
use App\Modules\Gym\Http\Requests\TrainerScheduleRequest;
use App\Modules\Gym\Transformers\TrainerScheduleTransformer;
use App\Modules\Gym\Transformers\TrainersForProfileTransformer;
use App\Ship\Parents\ApiController;
use App\Modules\Gym\Actions\CreateTrainerAction;
use App\Modules\Gym\Actions\FindTrainerByIdAction;
use App\Modules\Gym\Http\Requests\AddTrainerRequest;
use App\Modules\Gym\Transformers\TrainerTransformer;
use App\Modules\Gym\Actions\GetListTrainersForSelectAction;
use App\Modules\Gym\Transformers\TrainersForSelectTransformer;
use Illuminate\Http\Request;

class TrainerController extends ApiController
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getListTrainersForSelect()
    {
        $trainers = $this->call(GetListTrainersForSelectAction::class);

        return TrainersForSelectTransformer::collection($trainers);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */

    public function getListTrainerForProfile()
    {
        $trainers = $this->call(GetListTrainersForProfileAction::class);

        return TrainersForProfileTransformer::collection($trainers);
    }

    public function getTrainerSchedule(TrainerScheduleRequest $request)
    {
        $trainer = $this->call(GetTrainerByIdForScheduleAction::class, [$request->id]);

        return new TrainerScheduleTransformer($trainer);
    }

    public function deleteTrainer(DeleteTrainerRequest $request)
    {
        $this->call(DeleteTrainerAction::class, [$request->id]);

        return $this->success('ok');
    }
}

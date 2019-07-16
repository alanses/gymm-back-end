<?php

namespace App\Modules\Gym\Actions;

use App\Modules\Gym\Entities\Gym;
use App\Modules\Gym\Http\Requests\AddTrainerRequest;
use App\Modules\Gym\Tasks\CreateTrainerTask;
use App\Modules\Gym\Tasks\FindGymTask;
use App\Modules\Gym\Tasks\SyncTrainerWithActivitiesTask;
use App\Ship\Abstraction\AbstractAction;

class CreateTrainerAction extends AbstractAction
{
    /**
     * @param AddTrainerRequest $request
     * @return mixed
     */
    public function run(AddTrainerRequest $request)
    {
        $gym = $this->call(FindGymTask::class, [], [
            [
                'getByField' => ['user_id', $request->user_id]
            ]
        ]);

        $trainer = $this->call(CreateTrainerTask::class, [
            $this->getDataForCreateTrainer($gym, $request)
        ]);

        $this->call(SyncTrainerWithActivitiesTask::class, [$trainer, $request->activities]);

        return $trainer->load('activities');
    }

    /**
     * @param Gym $gym
     * @param AddTrainerRequest $request
     * @return array
     */
    private function getDataForCreateTrainer(Gym $gym, AddTrainerRequest $request) :array
    {
        return [
            'gym_id' => $gym->id,
            'trainer_name' => $request->trainer_name,
            'level' => $request->level,
            'cretits_from' => $request->cretits_from,
            'cretits_to' => $request->cretits_to,
        ];
    }
}

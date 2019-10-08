<?php

namespace App\Modules\GymClass\Http\Controllers;

use App\Modules\GymClass\Actions\GetEventAction;
use App\Modules\GymClass\Transformers\ClassEventTransformer;
use App\Ship\Parents\ApiController;

class EventsController extends ApiController
{
    public function getEvent($id)
    {
        $event = $this->call(GetEventAction::class, [$id]);

        return new ClassEventTransformer($event);
    }
}

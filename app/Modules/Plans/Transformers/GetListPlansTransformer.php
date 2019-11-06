<?php

namespace App\Modules\Plans\Transformers;

use App\Modules\GymClass\Entities\ClassSchedule;
use Illuminate\Http\Resources\Json\Resource;
use Illuminate\Support\Facades\Auth;

class GetListPlansTransformer extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'user_plan_id' => $this->getUserPlan(),
            'list_plans' => $this->getListPlans(),
        ];
    }

    private function getUserPlan()
    {
        $user = Auth::user();

        if($userDetail = $user->userDetail) {
            return $userDetail->plan_id;
        }
    }

    private function getListPlans()
    {
        return $this->resource->map(function ($plan) {
            return [
                'plan_id' => $plan->id,
                'name' => $plan->name,
                'description' => $plan->description,
                'count_credits' => $plan->count_credits,
                'payment_for_month' => $plan->payment_for_month,
                'count_class' => $this->getCountClass($plan) //Temp solusion
            ];
        });
    }

    private function getCountClass($plan)
    {
        $classes = ClassSchedule::where('credits', '<=', $plan->count_credits)
            ->get();

        if ($classes->isEmpty()) {
            return 0;
        }

        $sum = 0;
        $index = 0;

        foreach ($classes as $class) {
            $sum += $class->credits;
            if ($sum <= $plan->count_credits) {
                $index++;
            }
        }

        return $index;
    }
}

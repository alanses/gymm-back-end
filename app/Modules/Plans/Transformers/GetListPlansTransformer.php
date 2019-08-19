<?php

namespace App\Modules\Plans\Transformers;

use App\Modules\GymClass\Entities\ClassSchedule;
use Illuminate\Http\Resources\Json\Resource;

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
            'plan_id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'count_credits' => $this->count_credits,
            'payment_for_month' => $this->payment_for_month,
            'count_class' => $this->getCountClass() //Temp solusion
        ];
    }

    private function getCountClass()
    {
        $classes = ClassSchedule::where('credits', '<=', $this->count_credits)
            ->get();

        if ($classes->isEmpty()) {
            return 0;
        }

        $sum = 0;
        $index = 0;

        foreach ($classes as $class) {
            $sum += $class->credits;
            if ($sum <= $this->count_credits) {
                $index++;
            }
        }

        return $index;
    }
}

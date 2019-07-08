<?php

namespace App\Ship\Tasks;

use App\Ship\Abstraction\AbstractTask;

class GetParamsWithRulesTask extends AbstractTask
{
    /**
     * @param  array  $data
     * @param  array  $rules
     * @return array
     */
    public function run(array $data, array $rules)
    {
        $indexesWithRules = collect(array_keys($rules));
        $params = collect(array_keys($data));
        $params = $params->intersect($indexesWithRules);

        $requestData = collect($data)->diff($params)->toArray();

        return $requestData;
    }
}

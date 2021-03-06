<?php


namespace App\Ship\Abstraction;

use App\Ship\Interfaces\ParentInterface;
use App\Ship\Interfaces\RequestInterface;
use App\Ship\Traits\CallableTrait;
use App\Ship\Traits\SanitizerTrait;
use Illuminate\Foundation\Http\FormRequest;

abstract class AbstractRequest extends FormRequest implements RequestInterface, ParentInterface
{
    use SanitizerTrait;
    use CallableTrait;

    protected $urlParameters = [];

    /**
     * @param null $keys
     * @return array
     */
    public function all($keys = null)
    {
        $requestData = parent::all($keys);
        $requestData = $this->mergeUrlParametersWithRequestData($requestData);

        return $requestData;
    }

    /**
     * @param array $requestData
     * @return array
     */
    private function mergeUrlParametersWithRequestData(array $requestData)
    {
        if (isset($this->urlParameters) && !empty($this->urlParameters)) {
            foreach ($this->urlParameters as $param) {
                $requestData[$param] = $this->route($param);
            }
        }
        return $requestData;
    }
}

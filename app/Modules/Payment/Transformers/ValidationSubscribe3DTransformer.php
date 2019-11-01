<?php

namespace App\Modules\Payment\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ValidationSubscribe3DTransformer extends Resource
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
            'need_validation' => true,
            'validation_url' => $this->getValidationUrl()
        ];
    }

    private function getValidationUrl()
    {
        $PaReq = '?PaReq=' . base64_encode($this->getPaReq());
        $AcsUrl = '&AcsUrl=' . base64_encode($this->getAcsUrl());
        $MD = '&MD=' . base64_encode($this->getMD());
        return env('APP_URL') . 'subscribe' . $PaReq . $AcsUrl . $MD;
    }

    private function getPaReq() {
        return $this->resource->Model->PaReq;
    }

    private function getAcsUrl()
    {
        return $this->resource->Model->AcsUrl;
    }

    public function getMD()
    {
        return $this->resource->Model->TransactionId;
    }


}

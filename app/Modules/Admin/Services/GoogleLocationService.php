<?php
/**
 * Created by PhpStorm.
 * User: Slavik
 * Date: 30.09.2019
 * Time: 13:55
 */

namespace App\Modules\Admin\Services;

use App\Modules\Admin\Services\Interfaces\LocationInterface;
use \GuzzleHttp\Client as HttpClient;

class GoogleLocationService implements LocationInterface
{
    /**
     * @var HttpClient
     */
    private $httpClient;
    /**
     * @var string
     */
    private $responseType;

    protected static $GOOGLE_SERVICE_URL = 'https://maps.googleapis.com/maps/api/geocode/';
    /**
     * @var string
     */
    private $applicationKey;

    private $locationInfo;

    public function __construct(
        HttpClient $httpClient,
        string $responseType,
        string $applicationKey
    )
    {
        $this->httpClient = $httpClient;
        $this->responseType = $responseType;
        $this->applicationKey = $applicationKey;
        $this->locationInfo = null;
    }

    private function getUrl() :string
    {
        return static::$GOOGLE_SERVICE_URL . $this->responseType;
    }

    /**
     * @param string $address
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public function getDataFromSource(string $address)
    {
        $data = $this->httpClient->request('GET',
            $this->getUrl() . '?' . "&address=$address" . "&" . "key=$this->applicationKey");


        return json_decode($data->getBody());
    }

    public function getLat(array $locationInfo) :string
    {
        if($locationInfo) {
            return $locationInfo;
        }
    }

    public function getLng(array $locationInfo) :string
    {
        if($locationInfo) {

        }
    }
}
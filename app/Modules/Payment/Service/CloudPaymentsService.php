<?php


namespace App\Modules\Payment\Service;

use App\Modules\Plans\Entities\Plan;
use App\Modules\User\Entities\User;
use \GuzzleHttp\Client as HttpClient;

class CloudPaymentsService
{
    /**
     * @var string
     */
    private $CloudPaymentsPublicID;
    /**
     * @var string
     */
    private $CloudPaymentsSecretApi;
    /**
     * @var HttpClient
     */
    private $client;

    public function __construct
    (
        string $CloudPaymentsPublicID,
        string $CloudPaymentsSecretApi
    )
    {
        $this->CloudPaymentsPublicID = $CloudPaymentsPublicID;
        $this->CloudPaymentsSecretApi = $CloudPaymentsSecretApi;
    }

    public function request()
    {
        return new HttpClient([
            'headers' => [
                'Authorization' => $this->getToken(),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ]
        ]);
    }

    private function getToken()
    {
        return 'Basic ' . base64_encode($this->CloudPaymentsPublicID . ':' . $this->CloudPaymentsSecretApi);
    }

    public function testConnect()
    {
        $request = $this->request()->get('https://api.cloudpayments.ru/test');

        $response = json_decode($request->getBody()->getContents());

        return $response;
    }

    public function makePaymentsCardsCharge(Plan $plan, string $cryptID, User $user)
    {
        return $this->request()
            ->post('https://api.cloudpayments.ru/payments/cards/charge', [
                'json' => [
                    'publicId' => $this->CloudPaymentsPublicID,
                    'Amount' => $plan->payment_for_month,
                    'Currency' => 'USD',
                    'IpAddress' => $this->getIdAddress(),
                    'AccountId' => $user->email,
                    'Name' => $user->name,
                    'CardCryptogramPacket' => $cryptID
                ]
            ])
            ->getBody()
            ->getContents();
    }

    private function getIdAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}

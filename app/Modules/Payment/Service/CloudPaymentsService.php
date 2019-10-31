<?php


namespace App\Modules\Payment\Service;

use App\Modules\Plans\Entities\Plan;
use App\Modules\User\Entities\User;
use Carbon\Carbon;
use \GuzzleHttp\Client as HttpClient;
use stdClass;

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
                    'AccountId' => $user->email ?? $user->login,
                    'Name' => $user->name,
                    'CardCryptogramPacket' => $cryptID
                ]
            ])
            ->getBody()
            ->getContents();
    }

    public function confirmPayment(string $TransactionId, string $PaRes)
    {
        return $this->request()
            ->post('https://api.cloudpayments.ru/payments/cards/post3ds', [
                'json' => [
                    'TransactionId' => $TransactionId,
                    'PaRes' => $PaRes
                ]
            ])
            ->getBody()
            ->getContents();
    }

    public function makeSubscribe(stdClass $payment)
    {
        return $this->request()->post('https://api.cloudpayments.ru/subscriptions/create', [
                'json' => [
                    'token' => $this->getPaymentToken($payment),
                    'accountId' => $this->getPaymentAccountId($payment),
                    'description' => $this->getPaymentDescription($payment),
                    'email' => $this->getUserEmail($payment),
                    'amount' => $this->getAmount($payment),
                    'currency' => $this->getCurrency($payment),
                    'requireConfirmation' => false,
                    'startDate' => $this->getDateForNextMonth(),
                    'interval' => 'Month',
                    'period' => 1
                ]
            ])
            ->getBody()
            ->getContents();
    }

    private function getToken()
    {
        return 'Basic ' . base64_encode($this->CloudPaymentsPublicID . ':' . $this->CloudPaymentsSecretApi);
    }

    private function getDateForNextMonth()
    {
        return Carbon::now()
            ->addMonth();
    }

    private function getCurrency(stdClass $payment)
    {
        return $payment->Model->PaymentCurrency;
    }

    private function getAmount(stdClass $payment)
    {
        return $payment->Model->Amount;
    }

    private function getUserEmail(stdClass $payment)
    {
        return $payment->Model->AccountId;
    }

    private function getPaymentDescription(stdClass $payment)
    {
        return 'monthly subscription to the service gym.com for user ' . $payment->Model->AccountId;
    }

    private function getPaymentToken(stdClass $payment)
    {
        return $payment->Model->Token;
    }

    private function getPaymentAccountId(stdClass $payment)
    {
        return $payment->Model->AccountId;
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

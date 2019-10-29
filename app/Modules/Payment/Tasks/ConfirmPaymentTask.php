<?php

namespace App\Modules\Payment\Tasks;

use App\Modules\Payment\Service\CloudPaymentsService;
use App\Ship\Abstraction\AbstractTask;
use Illuminate\Http\Request;

class ConfirmPaymentTask extends AbstractTask
{
    /**
     * @var CloudPaymentsService
     */
    private $cloudPaymentsService;

    public function __construct(CloudPaymentsService $cloudPaymentsService)
    {
        $this->cloudPaymentsService = $cloudPaymentsService;
    }

    public function run(Request $request)
    {
        return json_decode($this->cloudPaymentsService
                ->confirmPayment($request->MD, $request->PaRes));
    }
}

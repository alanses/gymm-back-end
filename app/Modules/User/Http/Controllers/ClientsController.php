<?php

namespace App\Modules\User\Http\Controllers;

use App\Modules\User\Actions\GetListClientsAction;
use App\Modules\User\Transformers\ClientsTransformer;
use App\Ship\Parents\ApiController;

class ClientsController extends ApiController
{
    public function getListClients()
    {
        $clients = $this->call(GetListClientsAction::class);

        return ClientsTransformer::collection($clients);
    }
}

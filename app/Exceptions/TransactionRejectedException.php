<?php


namespace App\Exceptions;
use Exception;

class TransactionRejectedException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public function report()
    {
    }

    public function render($request)
    {
        return view('payment::transaction-rejected', [
            'message' => $this->getMessage()
        ]);
    }
}

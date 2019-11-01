<?php


namespace App\Exceptions;

use stdClass;

class Need3DVerificationException extends \Exception
{
    private $data = [];

    public function __construct(string $message, stdClass $data)
    {
        $this->data = $data;
        parent::__construct($message);
    }

    public function getData()
    {
        return $this->data;
    }
}

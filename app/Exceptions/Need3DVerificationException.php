<?php


namespace App\Exceptions;

class Need3DVerificationException extends \Exception
{
    private $data = [];

    public function __construct($message, $data)
    {
        $this->data = $data;
        parent::__construct($message);
    }

    public function getData()
    {
        return $this->data;
    }
}

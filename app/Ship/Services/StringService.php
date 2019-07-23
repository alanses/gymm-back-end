<?php
/**
 * Created by PhpStorm.
 * User: yaroslav
 * Date: 23.07.19
 * Time: 11:29
 */

namespace App\Ship\Services;

use App\Ship\Abstraction\AbstractService;

class StringService extends AbstractService
{
    public function convertStringForCallableMethod(string $string) :string
    {
        $array = explode('_', $string);
        $newString = ucfirst($array[1]);

        return $array[0] . $newString;
    }
}

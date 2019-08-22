<?php
/**
 * Created by PhpStorm.
 * User: yaroslav
 * Date: 22.08.19
 * Time: 12:32
 */

namespace App\Ship\Services;
use App\Ship\Abstraction\AbstractService;

class ConverterDateHelperService extends AbstractService
{
    protected static $MOUTH_NUMBERS = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
    ];

    public static function getMouths()
    {
        return self::$MOUTH_NUMBERS;
    }

    public function getMouthNumber(string $mouthName)
    {
        $numberOfMonth = false;

        if(is_string($mouthName)) {
            $numberOfMonth = array_search($mouthName, self::getMouths());
        }

        if(is_int($mouthName)) {
            $numberOfMonth = $mouthName;
        }

        if(!$numberOfMonth) {
            throw new \LogicException('Mouth not found');
        }

        return $numberOfMonth;
    }

    
}

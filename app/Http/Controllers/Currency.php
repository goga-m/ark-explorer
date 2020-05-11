<?php

namespace App\Http\Controllers;

use Brick\Math\BigDecimal;

/**
 * Currency controller.
 */
class Currency extends Controller
{
    /**
     * Convert ARK units and transform
     * into human readable format.
     *
     * @return string
     */
    public static function format($amountInMinUnits)
    {
        $fraction = 100000000;
        $value = BigDecimal::of($amountInMinUnits)
            ->exactlyDividedBy($fraction);

        return number_format((string) $value);
    }


}
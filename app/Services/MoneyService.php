<?php

namespace App\Services;

use Brick\Money\Money;

class MoneyService
{
    public static function convertToSmallestUnit($amount, $currencyCode = 'USD'): ?int
    {
        if (blank($amount)) {
            return null;
        }

        $money = Money::of($amount, $currencyCode);

        $amountInSmallestUnit = $money->getMinorAmount()->toInt();

        return $amountInSmallestUnit;
    }
}

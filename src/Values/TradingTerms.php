<?php

namespace Terah\Saasu\Values;

/**
 * Class TradingTerms
 * @package Terah\Saasu\Values
 */
/**
 * Class TradingTerms
 *
 * @package Terah\Saasu\Values
 */
class TradingTerms extends Value
{
    /**
     * The trading terms type. 1 = Due In, 2 = EOM+(End Of Month + number of Days), 3 = COD(Cash On Delivery).
     * @var int
     */
    public $TradingTermsType            = null;

    /**
     * Use with Due In and EOM+ types. Reflects the number of days/weeks/months.
     * @var int
     */
    public $TradingTermsInterval        = null;

    /**
     * The interval type. 1 = Days, 2 = Weeks, 3 = Months.
     * @var int
     */
    public $TradingTermsIntervalType    = null;
}
<?php
/**
 * Created by PhpStorm.
 * User: zkrat
 * Date: 09/11/2017
 * Time: 15:40
 */

namespace zkrat\BasicPower\Helper\Math;


class MathValues {

	public static function getLimitsValue(array $arrLimits, $number) {
        $number=min(max($arrLimits),$number);
        return max(min($arrLimits),$number);
	}


}
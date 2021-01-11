<?php
/**
 * Created by PhpStorm.
 * User: zkrat
 * Date: 09/11/2017
 * Time: 15:40
 */

namespace zkrat\BasicPower\Helper;


class HelperString {

	public static function camelCaseToUnderscore($input) {
		return ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $input)), '_');
	}

	public static function underscoreToCamelCase($string, $capitalizeFirstCharacter = false,$separator='_')
	{
		$str = lcfirst(implode('', array_map('ucfirst', explode($separator, $string))));;

		if ($capitalizeFirstCharacter) {
			$str[0] = strtoupper($str[0]);
		}
		return $str;
	}

	public static function isInString($fullString,$findString  ) {
		return is_numeric(strpos($fullString,$findString));
	}

	public static function removeStrings(array $arrayStrings,$string){
		foreach ($arrayStrings as $removeString){
			$string= str_replace($removeString,'',$string);
		}
		return $string;
	}

}
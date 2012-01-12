<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sbEcomToolkit
 *
 * @author pureroon
 */
class sbEcomToolkit
{
	public static function formatNumber($number)
	{
		return number_format($number, 2, '.', ',');
	}
	
	public static function costFormat($cost)
	{
		return sfConfig::get('app_sbEcom_currency_symbol', '&pound;') . self::formatNumber($cost);
	}
}

?>

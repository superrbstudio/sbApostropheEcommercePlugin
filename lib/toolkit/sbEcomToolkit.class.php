<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Useful tools for the Ecommerce Plugin
 *
 * @author Giles Smith <tech@superrb.com>
 */
class sbEcomToolkit
{
	/**
	 * Creates a list of Slots allowed in a product template
	 * @return array 
	 */
	public static function productAreaSlots()
	{
		$slots = aTools::standardAreaSlots();
		return array_merge($slots, sfConfig::get('app_sbApostropheEcommerce_product_area_slots', array('sbEcomAddToBasket')));
	}
	
	/**
	 * Formats a number for use in the Ecommerce Plugin
	 * @param float $number
	 * @return float 
	 */
	public static function formatNumber($number)
	{
		return number_format($number, 2, '.', ',');
	}
	
	/**
	 * Formats a cost for use in the Ecommerce Plugin
	 * @param float $cost
	 * @return string 
	 */
	public static function costFormat($cost)
	{
		return sfConfig::get('app_sbEcom_currency_symbol', '&pound;') . self::formatNumber($cost);
	}
	
	public static function getCategoryTemplates()
	{
		return sfConfig::get('app_sbApostropheEcommerce_category_templates', array('sbEcomCategory'));
	}
	
	public static function getProductTemplates()
	{
		return sfConfig::get('app_sbApostropheEcommerce_product_templates', array('sbEcomProduct'));
	}
}
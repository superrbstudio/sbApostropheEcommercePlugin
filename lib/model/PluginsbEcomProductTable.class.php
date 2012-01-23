<?php

/**
 * Description of PluginsbApostropheProductTable
 *
 * @author Giles Smith <tech@superrb.com>
 */
abstract class PluginsbEcomProductTable extends PluginaPageTable
{
	/**
	 * Returns a Doctrine_Collection of Product Pages
	 * @return Doctrine_Collection 
	 */
	public static function getProducts($version = false, $culture = null, $query = null)
	{
		if(is_null($query))
		{
			$query = Doctrine::getTable('aPage')->createQuery('p');
		}
		
		$query->where('p.template IN ?', sfConfig::get('app_sbApostropheEcommerce_product_templates', array('sbEcomProduct')));
		return aPageTable::queryWithSlots($version, $culture, $query)->execute();
	}
	
	/** 
	 * Returns an array of Product pages sorted by page title and with the page id as the array key
	 * @return array 
	 */
	public static function getProductsForChoiceWidget($version = false, $culture = null, $query = null)
	{
		if(is_null($query))
		{
			$query = Doctrine::getTable('aPage')->createQuery('p');
		}
		
		$tempProducts = self::getProducts($version, $culture, $query);
		$products = array();
		
		// sort by title
		$i = 0;
		foreach($tempProducts as $product)
		{
			$products[$product['title'] . $i] = $product;
			$i++;
		}
		
		$tempProducts = array();
		$tempProducts = $products;
		ksort($tempProducts);
		$products = array();
		
		foreach($tempProducts as $product)
		{
			$products[$product['id']] = $product;
		}
		
		return $products;
	}
}

?>

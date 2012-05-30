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
  
  /**
   * Returns the lowest price for a given product id
   * @param integer $id
   * @return float 
   */
  public static function getLowestCostForProductById($id)
  {
    $product = parent::retrieveByIdWithSlots($id);
    
    if($product instanceof aPage)
    {
      $costs = self::getCostsFromAreas($product);
    }
    
    return false;
  }
  
  /**
   * Returns the highest price for a given product id
   * @param integer $id
   * @return float 
   */
  public static function getHighestCostForProductById($id)
  {
    $product = parent::retrieveByIdWithSlots($id);
    
    if($product instanceof aPage)
    {
      //return $product->getLowestCost();
    }
    
    return false;
  }
  
  private static function getCostsFromAreas($product)
  {
    $areaNames = sfConfig::get('app_sbApostropheEcommerce_product_detail_areas', array('product-detail'));
    
    if(count($areaNames) > 0)
    {
      foreach($areaNames as $name)
      {
        $slots = $product->getArea($name);
        
        if(count($slots) > 0)
        {
          foreach($slots as $slot)
          {
            var_dump($slot->getType());
          }
        }
      }
    }
  }
}
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
  public static function getLowestCostForProductById($id, $includeTax = false)
  {
    $product = parent::retrieveByIdWithSlots($id);
    
    if($product instanceof aPage)
    {
      return self::getLowestCostForProduct($product, $includeTax);
    }
    
    return 0;
  }
  
  public static function getLowestCostForProduct($product, $includeTax = false)
  {
    $costs = self::getCostsFromAreas($product);
    return self::extractLowestCost($costs, $includeTax);
  }
  
  /**
   * Returns the lowest price for a given product id
   * @param integer $id
   * @return float 
   */
  public static function getHighestCostForProductById($id, $includeTax = false)
  {
    $product = parent::retrieveByIdWithSlots($id);
    
    if($product instanceof aPage)
    {
      return self::getHighestCostForProduct($product, $includeTax);
    }
    
    return 0;
  }
  
  public static function getHighestCostForProduct($product, $includeTax = false)
  {
    $costs = self::getCostsFromAreas($product);
    return self::extractHighestCost($costs, $includeTax);
  }
  
  private static function extractHighestCost($costs, $includeTax = false)
  {
    if($includeTax)
    {
      return floatval(round($costs['high']['cost'] + ($costs['high']['tax'] / 100), 2));
    }
    else
    {
      return floatval(round($costs['high']['cost'], 2));
    }
  }
  
  private static function extractLowestCost($costs, $includeTax = false)
  {
    if($includeTax)
    {
      return floatval(round($costs['low']['cost'] + ($costs['low']['tax'] / 100), 2));
    }
    else
    {
      return floatval(round($costs['low']['cost'], 2));
    }
  }
  
  /**
   * Returns an array of high and low costs
   * @param aPage $product
   * @return array
   */
  private static function getCostsFromAreas($product)
  {
    $areaNames = sfConfig::get('app_sbApostropheEcommerce_product_detail_areas', array('product-detail'));
    
    $costs = array('high' => array('cost' => 0, 'tax' => 0),
                   'low'  => array('cost' => 0, 'tax' => 0));
    
    if(count($areaNames) > 0)
    {
      foreach($areaNames as $name)
      {
        $slots = $product->getArea($name);
        
        if(count($slots) > 0)
        {
          foreach($slots as $slot)
          {
            if(in_array($slot->getType(), sfConfig::get('app_sbApostropheEcommerce_product_add_to_basket_slots', array('sbEcomAddToBasket'))))
            {
              $values = $slot->getArrayValue();
              
              if($values['cost'] > $costs['high']['cost'])
              {
                $costs['high'] = array('cost' => $values['cost'], 'tax' => $values['tax']);
              }
              
              if(($values['cost'] < $costs['low']['cost'] and $values['cost'] > 0) or $costs['low']['cost'] == 0)
              {
                $costs['low'] = array('cost' => $values['cost'], 'tax' => $values['tax']);
              }
            }
          }
        }
      }
    }
    
    return $costs;
  }
}
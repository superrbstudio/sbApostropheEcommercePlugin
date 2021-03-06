<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BasesbEcomBasket
 *
 * @author pureroon
 */
class PluginsbEcomBasket
{
	protected $basketProducts    = array();
	protected $total             = 0;
	protected $tax               = 0;
	protected $numProducts       = 0;
	protected $numItems          = 0;
  protected $postage           = 0;
  protected $postageCalculated = false;
	
	public function __construct($products = null) 
	{
		if($products instanceof Doctrine_Collection)
		{
			foreach($products as $product)
			{
				if($product instanceof sbEcomBasketProduct)
				{
					$this->basketProducts[] = $product;
					$this->total      += $product->getCost();
					$this->tax        += $product->getTax();
					$this->numItems   += $product->getQuantity();
					$this->numProducts++;
				}
			}
		}
	}
	
	public function getBasketProducts()
	{
		return $this->basketProducts;
	}
	
	public function getCost()
	{
		return (float)round($this->total, 2);
	}
	
	public function getTax()
	{
		return (float)round($this->tax, 2);
	}
	
  /**
   * Calculates the basket postage cost
   * Works out the most expensive item and uses the main postage cost and then uses the
   * secondary cost for all other items. If no secondary then the primary is used.
   * 
   * @return float
   */
	public function getPostage()
	{
    if($this->postageCalculated == true)
    {
      return $this->postage;
    }
    
    $this->postageCalculated = true;
    $this->postage = (float)round(sbEcomBasketTable::calculateBasketPostage($this->getBasketProducts()), 2);
		return $this->postage;
	}
  
  public function getPostageTax()
  {
    return (float)round($this->getPostage() * (sfConfig::get('app_sbApostropheEcommerce_postage_tax', 20) / 100), 2);
  }
	
	public function getTotal()
	{
		return $this->total + $this->getTax() + $this->getPostage() + $this->getPostageTax();
	}
	
	public function getNumProducts()
	{
		return $this->numProducts;
	}
	
	public function getNumItems()
	{
		return $this->numItems;
	}
}
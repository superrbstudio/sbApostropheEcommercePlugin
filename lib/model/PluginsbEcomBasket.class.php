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
	protected $basketProducts = array();
	protected $total          = 0;
	protected $tax            = 0;
	protected $postage        = 0;
	protected $numProducts    = 0;
	protected $numItems       = 0;
	
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
					$this->postage    += $product->getPostage();
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
		return $this->total;
	}
	
	public function getTax()
	{
		return $this->tax;
	}
	
	public function getPostage()
	{
		return $this->postage;
	}
	
	public function getTotal()
	{
		return $this->total + $this->tax + $this->postage;
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

?>

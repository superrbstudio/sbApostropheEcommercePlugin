<?php

/**
 * Description of sbEcomBasket
 *
 * @author pureroon
 */
class sbEcomBasket 
{
	protected $basketProducts = array();
	protected $total          = 0;
	protected $tax            = 0;
	protected $numProducts    = 0;
	protected $numItems       = 0;
	
	public function __construct($products = null) 
	{
		if(is_array($products))
		{
			foreach($products as $product)
			{
				if($product instanceof sbEcomBasketProduct)
				{
					$this->basketProducts[] = $product;
					$this->total      += ($product->getEcomProduct()->getCost() * $product->getQuantity());
					$this->tax        += (($product->getEcomProduct()->getCost() * ($product->getEcomProduct()->getTax() / 100)) * $product->getQuantity());
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
	
	public function getTotal()
	{
		return $this->total;
	}
	
	public function getTax()
	{
		return $this->tax;
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
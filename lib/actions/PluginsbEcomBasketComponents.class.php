<?php

/**
 * Base sbEcomBasket components for the sbApostropheEcommerce Plugin
 * 
 * @package    sbApostropheEcommercePlugin
 * @subpackage sbEcomBasket
 * @author     Giles Smith
 */
abstract class PluginsbEcomBasketComponents extends sfComponents 
{	
	public function executeBasketSummary()
	{
		$this->basket = sbEcomBasketTable::getUsersBasket();
		
		// if the there are no products remove attached checkout
		if($this->basket->getNumProducts() == 0)
		{
			$this->getUser()->setAttribute('checkout_id', null);
		}
	}
	
	public function executeBasketSummaryExpanded()
	{
		$this->basket = sbEcomBasketTable::getUsersBasket();
	}
	
	public function executeAddToBasketForm()
	{
		$this->basketForm = new sbEcomAddToBasketForm();
		
		if($this->product instanceof sbEcomProduct)
		{
			$values = array('product_id' => $this->product['id'], 'quantity' => 1);
			$this->basketForm->setDefaults($values);
		}
	}
}

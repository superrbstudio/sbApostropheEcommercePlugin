<?php

/**
 * Base sbEcomBasket components for the sbApostropheEcommerce Plugin
 * 
 * @package    sbApostropheEcommercePlugin
 * @subpackage sbEcomBasket
 * @author     Giles Smith
 */
abstract class BasesbEcomBasketComponents extends sfComponents 
{
	public function preExecute()
  {
    parent::preExecute();
  }
	
	public function executeBasketSummary()
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

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
	public function preExecute()
  {
    parent::preExecute();
		$this->getUser()->setFlash('aCacheInvalid', true);
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

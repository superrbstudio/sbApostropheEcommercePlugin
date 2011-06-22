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
		$this->basket = sbEcomBasketTable::getUsersBasket(session_id());
	}
}

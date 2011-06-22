<?php

/**
 * Base sbEcomBasket actions for the sbApostropheEcommerce Plugin.
 * 
 * @package    sbApostropheEcommercePlugin
 * @subpackage sbEcomBasket
 * @author     Giles Smith
 */
abstract class BasesbEcomBasketActions extends aEngineActions 
{
	public function preExecute() {
		parent::preExecute();
	}
	
	public function executeIndex(sfWebRequest $request)
	{
		
	}
}

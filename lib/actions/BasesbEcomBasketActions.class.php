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
	public function preExecute() 
	{
		parent::preExecute();
	}
	
	public function executeIndex(sfWebRequest $request)
	{
		$this->basket = sbEcomBasketTable::getUsersBasket();
	}
	
	public function executeAdd(sfWebRequest $request)
	{
		// must be posted
		$this->forward404Unless($request->getMethod() == 'POST');
		
		$this->basketForm = new sbEcomAddToBasketForm();
		$this->basketForm->bind($request->getParameter('sb_ecom_add_to_basket'));
		
		// must be valid
		$this->forward404Unless($this->basketForm->isValid());
		
		$product = sbEcomProductTable::getProductById($this->basketForm->getValue('product_id'));
		$this->forward404Unless($product instanceof sbEcomProduct);
		$this->forward404Unless($product->getActive());
		
		// product appears to be valid now add to basket
		$success = sbEcomBasketTable::addProductToBasket($product->getId(), $this->basketForm->getValue('quantity'));
		$this->getUser()->setFlash('basketAddSuccess', $success);
		
		if(!$request->isXmlHttpRequest())
		{
			$this->redirect('@sb_ecom_basket');
		}
	}
}

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
	
	public function executeAdd(sfWebRequest $request)
	{
		$this->forward404If(is_null($request->getParameter('id')));
		$product = sbEcomProductTable::getProductById($request->getParameter('id'));
		$this->forward404If(!($product instanceof sbEcomProduct));
		$success = sbEcomBasketProductTable::addProductToBasket($product->getId(), session_id());
		$this->getUser()->setFlash('basketAddSuccess', $success);
		$this->redirect('@sb_ecom_basket');
	}
}

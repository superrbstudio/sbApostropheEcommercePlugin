<?php

/**
 * Base sbEcomBasket actions for the sbApostropheEcommerce Plugin.
 * 
 * @package    sbApostropheEcommercePlugin
 * @subpackage sbEcomBasket
 * @author     Giles Smith
 */
abstract class PluginsbEcomBasketActions extends aEngineActions 
{	
	public function preExecute() 
	{
		parent::preExecute();
		$this->getUser()->setFlash('aCacheInvalid', true);
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
		else
		{
			// @TODO display json result
		}
	}
	
	public function executeDelete(sfWebRequest $request)
	{
		// verify the parameter
		$this->forward404Unless($request->getParameter('product') != '');
		
		// verify the product
		$basketProduct = sbEcomBasketTable::getBasketProductForUserByProductId($request->getParameter('product'));
		$this->forward404Unless($basketProduct instanceof sbEcomBasketProduct);
		
		// delete the product and return to the basket
		$basketProduct->delete();
		$this->redirect('@sb_ecom_basket');
	}
	
	public function executePlus(sfWebRequest $request)
	{
		// verify the parameter
		$this->forward404Unless($request->getParameter('product') != '');
		
		// verify the product
		$basketProduct = sbEcomBasketTable::getBasketProductForUserByProductId($request->getParameter('product'));
		$this->forward404Unless($basketProduct instanceof sbEcomBasketProduct);
		
		$currentCount = $basketProduct->getQuantity();
		
		if(is_numeric($request->getParameter('quantity')))
		{
			$currentCount+= $request->getParameter('quantity');
		}
		else
		{
			$currentCount++;
		}
		
		$basketProduct->setQuantity($currentCount);
		$basketProduct->save();
		$this->redirect('@sb_ecom_basket');
	}
	
	public function executeSubtract(sfWebRequest $request)
	{
		// verify the parameter
		$this->forward404Unless($request->getParameter('product') != '');
		
		// verify the product
		$basketProduct = sbEcomBasketTable::getBasketProductForUserByProductId($request->getParameter('product'));
		$this->forward404Unless($basketProduct instanceof sbEcomBasketProduct);
		
		$currentCount = $basketProduct->getQuantity();
		
		if(is_numeric($request->getParameter('quantity')))
		{
			$currentCount-= $request->getParameter('quantity');
		}
		else
		{
			$currentCount--;
		}
		
		if($currentCount <= 0)
		{
			$basketProduct->delete();
		}
		else
		{
			$basketProduct->setQuantity($currentCount);
			$basketProduct->save();
		}
		
		$this->redirect('@sb_ecom_basket');
	}
}

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
    
    if($this->basket->getNumProducts() == 0)
    {
      $this->getUser()->setAttribute('checkout_id', null);
    }
	}
	
	public function executeAdd(sfWebRequest $request)
	{	
		// must be posted
		$this->forward404Unless($request->getMethod() == 'POST');
    
    $basketParameters = $request->getParameter('sb_ecom_add_to_basket');
    var_dump($basketParameters);
		
		// get the product page and verify
		$this->product = Doctrine_Core::getTable('aPage')->findOneById($basketParameters['product_id']);
		$this->forward404Unless($this->product instanceof aPage);
		$this->forward404Unless(in_array($this->product->getTemplate(), sfConfig::get('app_sbApostropheEcommerce_product_templates', 'sbEcomProduct')));
		$this->forward404If($this->product->getArchived() and !is_null($this->product->getArchived()));
		
		$this->slot = Doctrine_Core::getTable('aSlot')->findOneById($basketParameters['slot_id']);
		$this->forward404Unless($this->slot instanceof aSlot);
		
		$this->productParams = unserialize($this->slot->getValue());
		$this->forward404If(in_array($this->productParams['call_to_order'], array('call_to_order', 'call_to_order_no_price')));
    
    // is there an option param from the sbEcomAddToBasketWithOptionSlot
    if(isset($basketParameters['add_to_basket_type']) and $basketParameters['add_to_basket_type'] == 'withOption')
    {
      $this->basketForm = new sbEcomAddToBasketWithOptionForm(null, array('optionValues' => sbEcomAddToBasketWithOptionSlotTable::convertOptionValuesToSelectOptions($this->slot)));
    }
    else
    {
      $this->basketForm = new sbEcomAddToBasketForm();
    }
    
		$this->basketForm->bind($request->getParameter('sb_ecom_add_to_basket'));
		
		// must be valid
		$this->forward404Unless($this->basketForm->isValid());
		
    // send the selected slot form
    $this->productParams['productForm'] = $this->basketForm;
    
		// product appears to be valid now add to basket
		sbEcomBasketTable::addProductToBasket(sbEcomBasketTable::createBasketValues($this->product, $this->slot, $this->basketForm->getValue('quantity'), $this->productParams));
		
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
		$this->forward404Unless($request->getParameter('slot') != '');
		
		// verify the product
		$basketProduct = sbEcomBasketTable::getBasketProductForUserByProductId($request->getParameter('product'), $request->getParameter('slot'));
		$this->forward404Unless($basketProduct instanceof sbEcomBasketProduct);
		
		// delete the product and return to the basket
		$basketProduct->delete();
		$this->redirect('@sb_ecom_basket');
	}
	
	public function executePlus(sfWebRequest $request)
	{
		// verify the parameter
		$this->forward404Unless($request->getParameter('product') != '');
		$this->forward404Unless($request->getParameter('slot') != '');
		
		// verify the product
		$basketProduct = sbEcomBasketTable::getBasketProductForUserByProductId($request->getParameter('product'), $request->getParameter('slot'));
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
		$this->forward404Unless($request->getParameter('slot') != '');
		
		// verify the product
		$basketProduct = sbEcomBasketTable::getBasketProductForUserByProductId($request->getParameter('product'), $request->getParameter('slot'));
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

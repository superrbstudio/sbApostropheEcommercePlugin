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
  
  /**
   * Returns a JSON feed of the basket
   * @param sfWebRequest $request
   * @return type
   */
  public function executeBasketFeed(sfWebRequest $request)
  {
    $this->basket = sbEcomBasketTable::getUsersBasket();
    
    $basket   = array('subTotal' => $this->basket->getCost(),
                      'subTotalTax' => $this->basket->getTax(),
                      'postage' => $this->basket->getPostage(),
                      'postageTax' => $this->basket->getPostageTax(),
                      'total' => $this->basket->getTotal(),
                      'numProducts' => $this->basket->getNumProducts(),
                      'basket-url' => url_for('@sb_ecom_basket'),
                      'checkout-url' => url_for('@sb_ecom_checkout'),
                      'products' => array());
    
    foreach($this->basket->getBasketProducts() as $basketProduct)
    {
      $image = sbEcomProductTable::getProductImage($basketProduct->getEcomProduct()->getId());
      
      if($image)
      {
        $image = $image->getScaledUrl(array('width' => sfConfig::get('app_sbApostropheEcommerce_basket_thumb_width', 100), 'height' => sfConfig::get('app_sbApostropheEcommerce_basket_thumb_height', 100), 'resizeType' => sfConfig::get('app_sbApostropheEcommerce_basket_thumb_resize_type', 'c')));
      }
      else
      {
        $image = '';
      }
      
      $product = array('title' => $basketProduct->getItemTitle(),
                       'reference' => $basketProduct->getItemReference(),
                       'quantity' => $basketProduct->getQuantity(),
                       'cost' => $basketProduct->getCost(),
                       'tax' => $basketProduct->getTax(),
                       'image' => $image);
      $basket['products'][] = $product;
    }
    
    $this->setLayout(false);
    $this->getResponse()->setContentType('application/json');
    $this->getResponse()->setContent(json_encode(array('basket' => $basket)));
    return sfView::NONE;
  }
	
	public function executeAdd(sfWebRequest $request)
	{	
		// must be posted
		$this->forward404Unless($request->getMethod() == 'POST');
    
    $basketParameters = $request->getParameter('sb_ecom_add_to_basket');
		
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
    elseif(isset($basketParameters['add_to_basket_type']) and $basketParameters['add_to_basket_type'] == 'noQuantity')
    {
      $this->basketForm = new sbEcomAddToBasketNoQuantityForm();
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
      $this->setLayout(false);
      $this->getResponse()->setContentType('application/json');
			$this->getResponse()->setContent(json_encode(array('success' => true)));
      return sfView::NONE;
		}
	}
	
	public function executeDelete(sfWebRequest $request)
	{
		// verify the parameter
		$this->forward404Unless($request->getParameter('product') != '');
		$this->forward404Unless($request->getParameter('slot') != '');
    $this->forward404Unless($request->getParameter('title') != '');
		
		// verify the product
		$basketProduct = sbEcomBasketTable::getBasketProductForUserByProductId($request->getParameter('product'), $request->getParameter('slot'), $request->getParameter('title'));
		$this->forward404Unless($basketProduct instanceof sbEcomBasketProduct);
		
		// delete the product and return to the basket
		$basketProduct->delete();
    
		if(!$request->isXmlHttpRequest())
		{
			$this->redirect('@sb_ecom_basket');
		}
		else
		{
      $this->setLayout(false);
      $this->getResponse()->setContentType('application/json');
			$this->getResponse()->setContent(json_encode(array('success' => true)));
      return sfView::NONE;
		}
	}
	
	public function executePlus(sfWebRequest $request)
	{
		// verify the parameter
		$this->forward404Unless($request->getParameter('product') != '');
		$this->forward404Unless($request->getParameter('slot') != '');
    $this->forward404Unless($request->getParameter('title') != '');
		
		// verify the product
		$basketProduct = sbEcomBasketTable::getBasketProductForUserByProductId($request->getParameter('product'), $request->getParameter('slot'), $request->getParameter('title'));
		$this->forward404Unless($basketProduct instanceof sbEcomBasketProduct);
    
    // are we allowed to add more?
    $this->forward404Unless($basketProduct->getAllowDuplicates());
		
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
    
    
		if(!$request->isXmlHttpRequest())
		{
			$this->redirect('@sb_ecom_basket');
		}
		else
		{
      $this->setLayout(false);
      $this->getResponse()->setContentType('application/json');
			$this->getResponse()->setContent(json_encode(array('success' => true)));
      return sfView::NONE;
		}
	}
	
	public function executeSubtract(sfWebRequest $request)
	{
		// verify the parameter
		$this->forward404Unless($request->getParameter('product') != '');
		$this->forward404Unless($request->getParameter('slot') != '');
    $this->forward404Unless($request->getParameter('title') != '');
		
		// verify the product
		$basketProduct = sbEcomBasketTable::getBasketProductForUserByProductId($request->getParameter('product'), $request->getParameter('slot'), $request->getParameter('title'));
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
		
		if(!$request->isXmlHttpRequest())
		{
			$this->redirect('@sb_ecom_basket');
		}
		else
		{
      $this->setLayout(false);
      $this->getResponse()->setContentType('application/json');
			$this->getResponse()->setContent(json_encode(array('success' => true)));
      return sfView::NONE;
		}
	}
}

<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PluginsbEcomPaypalPaymentsProWithIframeActions
 *
 * @author pureroon
 */
class PluginsbEcomPaypalPaymentsProWithIframeActions extends aEngineActions
{
	public function preExecute() 
	{
		parent::preExecute();
		$this->getUser()->setFlash('aCacheInvalid', true);
	}
	
	public function executeIndex(sfWebRequest $request)
	{
		$this->checkout = null;
		
		if(is_numeric($this->getUser()->getAttribute('checkout_id')))
		{
			$this->checkout = sbEcomCheckoutTable::getInstance()->findOneById($this->getUser()->getAttribute('checkout_id'));
		}
		
		if(!($this->checkout instanceof sbEcomCheckout))
		{
			$this->redirect($this->generateUrl('sb_ecom_checkout'));
		}
		
		// create urls
		$this->baseUrl = $request->getUriPrefix();
	}
	
	public function executeReturn(sfWebRequest $request)
	{
		// must be posted
		//$this->forward404Unless($request->getMethod() == 'POST');
		
		// get the checkout
		if(is_numeric($request->getParameter('id')))
		{
			$this->checkout = sbEcomCheckoutTable::getInstance()->findOneById($request->getParameter('id'));
		}
		
		// must be a valid checkout
		$this->forward404Unless($this->checkout instanceof sbEcomCheckout);
		
		// can't be complete already
		$this->forward404If($this->checkout->getStatus() == 'Complete');
    
    // can't be paid
    $this->forward404If($this->checkout->getStatus() == 'Paid');
		
		$this->checkout->setPaymentReference($request->getParameter('txn_id'));
		$this->checkout->setStatus('Paid');
		
		foreach($this->checkout->getEcomCheckoutProduct() as $product)
		{
			$product->setSessionId('');
			$product->save();
		}
		
		$this->checkout->save();
		
		// @TODO needs more verification here, I think there is a call back to Paypal to double check.
		
		// @TODO send receipt email
		
		return sfView::NONE;
	}
}
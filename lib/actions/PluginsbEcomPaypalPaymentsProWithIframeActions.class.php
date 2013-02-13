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
  
  public function executeThanks(sfWebRequest $request)
  {
    
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
    else
    {
      return sfView::NONE;
    }
		
		// must be a valid checkout
		$this->forward404Unless($this->checkout instanceof sbEcomCheckout);
		
		// Only Awaiting payment can be changed
		$this->forward404Unless($this->checkout->getStatus() == 'Awaiting Payment');
		
    // Set the checkout as paid
		$this->checkout->setPaymentComplete($request->getParameter('txn_id'));
		
		// Send the confirmation email
    $this->sendConfirmationEmail();
		
		return sfView::NONE;
	}
  
  /*
   * Override this method to handle your requirements
   */
  public function sendConfirmationEmail()
  {
    return true;
  }
}
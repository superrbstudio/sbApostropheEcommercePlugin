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
	public function executeIndex(sfWebRequest $request)
	{
		$this->validCheckout = false;
		$this->checkout = sbEcomCheckoutTable::getInstance()->findOneById($this->getUser()->getAttribute('checkout_id'));
		
		if($this->checkout instanceof sbEcomCheckout)
		{
			$this->validCheckout = true;
		}
		
	}
}
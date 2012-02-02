<?php

/**
 * Description of PluginsbEcomCheckoutActions
 *
 * @author Giles Smith <tech@superrb.com>
 */
class PluginsbEcomCheckoutActions extends aEngineActions 
{
	public function preExecute() 
	{
		parent::preExecute();
		$this->getUser()->setFlash('aCacheInvalid', true);
	}
	
	public function executeIndex(sfWebRequest $request)
	{
		$this->basket = sbEcomBasketTable::getUsersBasket();
		
		if($this->getUser()->getFlash('checkout_form') instanceof sbEcomCheckoutForm)
		{
			$this->form = $this->getUser()->getFlash('checkout_form');
		}
		else
		{
			$this->form = new sbEcomCheckoutForm();
			$this->form->setDefault('delivery_country', 'GB');
			$this->form->setDefault('billing_country', 'GB');
		}
	}
	
	public function executeProcess(sfWebRequest $request)
	{
		// must be posted
		$this->forward404Unless($request->getMethod() == 'POST');
		$this->basket = sbEcomBasketTable::getUsersBasket();
		
		$this->form = new sbEcomCheckoutForm();
		$this->form->bind($request->getParameter($this->form->getName()));
		$this->getUser()->setFlash('checkout_form', $this->form);
		
		// return to form or forward to chosen payment gateway
		if($this->form->isValid() and $this->basket instanceof sbEcomBasket)
		{
			$this->checkout = new sbEcomCheckout();
			$this->checkout->setStatus('Awaiting Payment');			
			
			// set vals
			$this->checkout->setContactTitle($this->form->getValue('contact_title'));
			$this->checkout->setContactFirstname($this->form->getValue('contact_firstname'));
			$this->checkout->setContactLastname($this->form->getValue('contact_lastname'));
			$this->checkout->setContactEmail($this->form->getValue('contact_email'));
			$this->checkout->setContactTelephone($this->form->getValue('contact_telephone'));
			$this->checkout->setContactMobile($this->form->getValue('contact_mobile'));
			$this->checkout->setDeliveryStreetAddress($this->form->getValue('delivery_street_address'));
			$this->checkout->setDeliveryPostOfficeBoxNumber($this->form->getValue('delivery_post_office_box_number'));
			$this->checkout->setDeliveryLocality($this->form->getValue('delivery_locality'));
			$this->checkout->setDeliveryRegion($this->form->getValue('delivery_region'));
			$this->checkout->setDeliveryPostalCode($this->form->getValue('delivery_postal_code'));
			$this->checkout->setDeliveryCountry($this->form->getValue('delivery_country'));
			$this->checkout->setBillingStreetAddress($this->form->getValue('billing_street_address'));
			$this->checkout->setBillingPostOfficeBoxNumber($this->form->getValue('billing_post_office_box_number'));
			$this->checkout->setBillingLocality($this->form->getValue('billing_locality'));
			$this->checkout->setBillingRegion($this->form->getValue('billing_region'));
			$this->checkout->setBillingPostalCode($this->form->getValue('billing_postal_code'));
			$this->checkout->setBillingCountry($this->form->getValue('billing_country'));
			
			// attach all the products
			foreach($this->basket->getBasketProducts() as $product)
			{
				$product->setSessionId(null);
				$product->save();
				$this->checkout->EcomCheckoutProduct[] = $product;
			}
			
			// save and continue
			$this->checkout->save();
			$this->getUser()->setAttribute('checkout_id', $this->checkout->getId());
			$this->redirect($this->generateUrl(sfConfig::get('app_sbEcommercePlugin_payment_route', 'sb_ecom_paypal_payments_pro_with_iframe')));
		}
		
		$this->redirect('sbEcomCheckout/index');
	}
}
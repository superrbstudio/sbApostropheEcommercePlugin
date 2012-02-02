<?php

/**
 * PluginsbEcomCheckout form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginsbEcomCheckoutForm extends BasesbEcomCheckoutForm
{
	public function setup()
	{
		parent::setup();
		
		$this->setWidget('contact_title', new sfWidgetFormInputText(array('label' => 'Title'), array('class' => 'small')));
		$this->setValidator('contact_title', new sfValidatorString(array('required' => false), array('invalid' => 'Please enter a valid title')));
		
		$this->setWidget('contact_firstname', new sfWidgetFormInputText(array('label' => 'First name'), array('class' => 'large')));
		$this->setValidator('contact_firstname', new sfValidatorString(array('required' => true), array('required' => 'Please enter your first name', 'invalid' => 'Please enter a valid first name')));
		
		$this->setWidget('contact_lastname', new sfWidgetFormInputText(array('label' => 'Last name'), array('class' => 'large')));
		$this->setValidator('contact_lastname', new sfValidatorString(array('required' => true), array('required' => 'Please enter your last name', 'invalid' => 'Please enter a valid last name')));
		
		$this->setWidget('contact_email', new sfWidgetFormInputText(array('label' => 'Email address'), array('class' => 'large')));
		$this->setValidator('contact_email', new sfValidatorEmail(array('required' => true), array('required' => 'Please enter your email address', 'invalid' => 'Please enter a valid email address')));
		
		$this->setWidget('contact_telephone', new sfWidgetFormInputText(array('label' => 'Telephone'), array('class' => 'medium')));
		$this->setValidator('contact_telephone', new sfValidatorString(array('required' => true), array('required' => 'Please enter your telephone number', 'invalid' => 'Please enter a valid telephone number')));
		
		$this->setWidget('contact_mobile', new sfWidgetFormInputText(array('label' => 'Mobile Phone'), array('class' => 'medium')));
		$this->setValidator('contact_mobile', new sfValidatorString(array('required' => false), array('invalid' => 'Please enter a valid mobile number')));
		
		$this->setWidget('delivery_street_address', new sfWidgetFormInputText(array('label' => 'Street address'), array('class' => 'large')));
		$this->setValidator('delivery_street_address', new sfValidatorString(array('required' => true), array('required' => 'Please enter your delivery street address', 'invalid' => 'Please enter a valid delivery street address')));
		
		$this->setWidget('delivery_post_office_box_number', new sfWidgetFormInputText(array('label' => 'PO Box number (if required)'), array('class' => 'medium')));
		$this->setValidator('delivery_post_office_box_number', new sfValidatorString(array('required' => false), array('invalid' => 'Please enter a valid PO Box number')));
		
		$this->setWidget('delivery_locality', new sfWidgetFormInputText(array('label' => 'Locality'), array('class' => 'medium')));
		$this->setValidator('delivery_locality', new sfValidatorString(array('required' => false), array('invalid' => 'Please enter a valid delivery locality')));
		
		$this->setWidget('delivery_region', new sfWidgetFormInputText(array('label' => 'Region'), array('class' => 'medium')));
		$this->setValidator('delivery_region', new sfValidatorString(array('required' => true), array('required' => 'Please enter your delivery region', 'invalid' => 'Please enter a valid delivery region')));
		
		$this->setWidget('delivery_postal_code', new sfWidgetFormInputText(array('label' => 'Postal code'), array('class' => 'small')));
		$this->setValidator('delivery_postal_code', new sfValidatorString(array('required' => true), array('required' => 'Please enter your postal code', 'invalid' => 'Please enter a valid postal code')));
		
		$this->setWidget('delivery_country', new sfWidgetFormI18nChoiceCountry());
		$this->setValidator('delivery_country', new sfValidatorI18nChoiceCountry(array('required' => true), array('required' => 'Please select a valid country', 'invalid' => 'Please select a valid country')));
		
		$this->setWidget('billing_street_address', new sfWidgetFormInputText(array('label' => 'Street address'), array('class' => 'large')));
		$this->setValidator('billing_street_address', new sfValidatorString(array('required' => true), array('required' => 'Please enter your billing street address', 'invalid' => 'Please enter a valid billing street address')));
		
		$this->setWidget('billing_post_office_box_number', new sfWidgetFormInputText(array('label' => 'PO Box number (if required)'), array('class' => 'medium')));
		$this->setValidator('billing_post_office_box_number', new sfValidatorString(array('required' => false), array('invalid' => 'Please enter a valid PO Box number')));
		
		$this->setWidget('billing_locality', new sfWidgetFormInputText(array('label' => 'Locality'), array('class' => 'medium')));
		$this->setValidator('billing_locality', new sfValidatorString(array('required' => false), array('invalid' => 'Please enter a valid billing locality')));
		
		$this->setWidget('billing_region', new sfWidgetFormInputText(array('label' => 'Region'), array('class' => 'medium')));
		$this->setValidator('billing_region', new sfValidatorString(array('required' => true), array('required' => 'Please enter your billing region', 'invalid' => 'Please enter a valid billing region')));
		
		$this->setWidget('billing_postal_code', new sfWidgetFormInputText(array('label' => 'Postal code'), array('class' => 'small')));
		$this->setValidator('billing_postal_code', new sfValidatorString(array('required' => true), array('required' => 'Please enter your postal code', 'invalid' => 'Please enter a valid postal code')));
		
		$this->setWidget('billing_country', new sfWidgetFormI18nChoiceCountry());
		$this->setValidator('billing_country', new sfValidatorI18nChoiceCountry(array('required' => true), array('required' => 'Please select a valid country', 'invalid' => 'Please select a valid country')));
		
		unset($this['created_at'], $this['updated_at']);
	}
}

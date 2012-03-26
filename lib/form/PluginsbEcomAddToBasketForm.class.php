<?php

/**
 * BasesbEcomAddToBasketForm - Sets up the Add to Basket Slot
 *
 * @author Giles Smith <tech@superrb.com>
 */
abstract class PluginsbEcomAddToBasketForm extends sfForm 
{
	public function setup() 
	{
		parent::setup();
		
		$this->disableCSRFProtection(); // breaks cache and form values arent saved
		
		$this->setWidget('product_id', new sfWidgetFormInputHidden());
		$this->setValidator('product_id', new sfValidatorDoctrineChoice(array('model' => 'aPage')));
		
		$this->setWidget('slot_id', new sfWidgetFormInputHidden());
		$this->setValidator('slot_id', new sfValidatorDoctrineChoice(array('model' => 'aSlot')));
		
		for($i = 1; $i <= sfConfig::get('app_sbApostropheEcommerce_max_add_to_basket_quantity', 10); $i++){ $choices[$i] = $i; }
		$this->setWidget('quantity', new sfWidgetFormChoice(array('choices' => $choices, 'label' => 'Quantity')));
		$this->setValidator('quantity', new sfValidatorChoice(array('choices' => array_keys($choices))));
		
		$this->widgetSchema->setNameFormat('sb_ecom_add_to_basket[%s]');
	}
}
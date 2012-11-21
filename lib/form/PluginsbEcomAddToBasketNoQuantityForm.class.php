<?php

/**
 * BasesbEcomAddToBasketForm - Sets up the Add to Basket Slot
 *
 * @author Giles Smith <tech@superrb.com>
 */
abstract class PluginsbEcomAddToBasketNoQuantityForm extends PluginsbEcomAddToBasketForm 
{
	public function setup() 
	{
		parent::setup();
    
    $this->setWidget('add_to_basket_type', new sfWidgetFormInputHidden());
    $this->setValidator('add_to_basket_type', new sfValidatorChoice(array('choices' => array('noQuantity'))));
    $this->setDefault('add_to_basket_type', 'noQuantity');
		
		$this->setWidget('quantity', new sfWidgetFormInputHidden());
    $this->setDefault('quantity', 1);
	}
}
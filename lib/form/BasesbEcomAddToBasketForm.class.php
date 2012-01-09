<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BasesbEcomAddToBasketForm
 *
 * @author pureroon
 */
class BasesbEcomAddToBasketForm extends sfForm 
{
	public function setup() 
	{
		parent::setup();
		
		$this->setWidget('product_id', new sfWidgetFormInputHidden());
		$this->setValidator('product_id', new sfValidatorDoctrineChoice(array('model' => 'sbEcomProduct')));
		
		for($i = 1; $i <= 10; $i++){ $choices[$i] = $i; }
		$this->setWidget('quantity', new sfWidgetFormChoice(array('choices' => $choices, 'label' => 'Quantity')));
		$this->setValidator('quantity', new sfValidatorChoice(array('choices' => array_keys($choices))));
	}
}

?>

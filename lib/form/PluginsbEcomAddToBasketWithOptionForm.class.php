<?php

/**
 * Description of PluginsbEcomAddToBasketWithOptionForm
 *
 * @author pureroon
 */
class PluginsbEcomAddToBasketWithOptionForm extends PluginsbEcomAddToBasketForm 
{
  public function setup() 
	{
		parent::setup();
    
    $this->setWidget('add_to_basket_type', new sfWidgetFormInputHidden());
    $this->setValidator('add_to_basket_type', new sfValidatorChoice(array('choices' => array('withOption'))));
    $this->setDefault('add_to_basket_type', 'withOption');
    
    $this->setWidget('option_value', new sfWidgetFormChoice(array('choices' => $this->getOption('optionValues')), array()));
    $this->setValidator('option_value', new sfValidatorChoice(array('choices' => array_keys($this->getOption('optionValues')))));
  }
}
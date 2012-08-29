<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PluginsbEcomAddToBasketWithOptionSlotEditForm
 *
 * @author pureroon
 */
class PluginsbEcomAddToBasketWithOptionSlotEditForm extends BaseForm
{
  // Ensures unique IDs throughout the page
  protected $id;
  public function __construct($id, $defaults = array(), $options = array(), $CSRFSecret = null)
  {
    $this->id = $id;
    parent::__construct($defaults, $options, $CSRFSecret);
  }
  public function configure()
  { 
    // ADD YOUR FIELDS HERE
		
		$this->setWidget('title', new sfWidgetFormInputText());
		$this->setValidator('title', new sfValidatorString(array('required' => true), array('required' => 'Please enter a title for this basket option')));
		
		$this->setWidget('cost', new sfWidgetFormInputText(array('label' => 'Cost (' . sfConfig::get('app_sbApostropheEcommerce_currency_symbol', '&pound;') . ')')));
		$this->setValidator('cost', new sfValidatorNumber(array('required' => true, 'min' => 0)));
		
		$this->setWidget('tax', new sfWidgetFormInputText(array('label' => 'Tax (%)')));
		$this->setValidator('tax', new sfValidatorNumber(array('required' => true, 'min' => 0, 'max' => 100), array('required' => 'Please enter the Tax percentage value', 'invalid' => 'Please enter a numeric value (0-100)')));
		
		$choices = array('add_to_basket' => 'Add to basket', 'call_to_order' => 'Call to order (With price)', 'call_to_order_no_price' => 'Call to order (No price)');
		$this->setWidget('call_to_order', new aWidgetFormChoice(array('choices' => $choices, 'label' => 'Purchase type')));
		$this->setValidator('call_to_order', new sfValidatorChoice(array('choices' => array_keys($choices))));
		
		$postageChoices = sfConfig::get('app_sbApostropheEcommerce_postage_options', array('free' => 'Free post', 'weight' => 'Postage by Weight', 'fixed' => 'Fixed Cost'));
		$this->setWidget('postage_type', new sfWidgetFormChoice(array('choices' => $postageChoices)));
		$this->setValidator('postage_type', new sfValidatorChoice(array('choices' => array_keys($postageChoices))));
		
		$this->setWidget('weight', new sfWidgetFormInputText(array('label' => 'Weight (' . sfConfig::get('app_sbApostropheEcommerce_weight_unit', 'kg') . ')')));
		$this->setValidator('weight', new sfValidatorNumber(array('required' => false), array('invalid' => 'Please enter a numeric weight in ' . sfConfig::get('app_sbApostropheEcommerce_weight_unit', 'kg'))));
		
		$this->setWidget('cost_per_weight', new sfWidgetFormInputText(array('label' => 'Cost per ' . sfConfig::get('app_sbApostropheEcommerce_weight_unit', 'kg'))));
		$this->setValidator('cost_per_weight', new sfValidatorNumber(array('required' => false), array('invalid' => 'Please enter a numeric cost per ' . sfConfig::get('app_sbApostropheEcommerce_weight_unit', 'kg'))));
    
    $this->setWidget('cost_per_weight_with_others', new sfWidgetFormInputText(array('label' => 'Cost per ' . sfConfig::get('app_sbApostropheEcommerce_weight_unit', 'kg') . ' (with others)')));
		$this->setValidator('cost_per_weight_with_others', new sfValidatorNumber(array('required' => false), array('invalid' => 'Please enter a numeric cost per ' . sfConfig::get('app_sbApostropheEcommerce_weight_unit', 'kg'))));
		
		$this->setWidget('fixed', new sfWidgetFormInputText(array('label' => 'Fixed postage (' . sfConfig::get('app_sbApostropheEcommerce_currency_symbol', '&pound;') . ')')));
		$this->setValidator('fixed', new sfValidatorNumber(array('required' => false), array('invalid' => 'Please enter a numeric cost in ' . sfConfig::get('app_sbApostropheEcommerce_currency_symbol', '&pound;'))));
    
    $this->setWidget('fixed_with_others', new sfWidgetFormInputText(array('label' => 'Fixed postage (' . sfConfig::get('app_sbApostropheEcommerce_currency_symbol', '&pound;') . ') (with others)')));
		$this->setValidator('fixed_with_others', new sfValidatorNumber(array('required' => false), array('invalid' => 'Please enter a numeric cost in ' . sfConfig::get('app_sbApostropheEcommerce_currency_symbol', '&pound;'))));
    
    $this->setWidget('option_name', new sfWidgetFormInputText(array('label' => 'Option Name')));
    $this->setValidator('option_name', new sfValidatorString(array('required' => true), array('required' => 'Please enter the option name')));
    
    $this->setWidget('option_value', new sfWidgetFormInputHidden(array(), array('class' => 'option-value')));
    $this->setValidator('option_value', new sfValidatorCallback(array('callback' => array($this, 'validateOptions'))));
    
    // Ensures unique IDs throughout the page. Hyphen between slot and form to please our CSS
    $this->widgetSchema->setNameFormat('slot-form-' . $this->id . '[%s]');
    
    // You don't have to use our form formatter, but it makes things nice
    $this->widgetSchema->setFormFormatterName('aAdmin');
  }
  
  public static function validateOptions($validator, $value)
  {
    $returnValues = array();
    $values = json_decode($value);
    
    if(!$values)
    {
      throw new sfValidatorError($validator, 'Unable to decode option values');
    }
    
    foreach($values as $value)
    {
      if($value->value != '' and $value->reference != '' and is_numeric($value->cost))
      {
        $returnValues[$value->value] = $value;
      }
    }
    
    if(count($returnValues) == 0)
    {
      throw new sfValidatorError($validator, 'Please select at least one option value (the cost must be numeric)');
    }
    
    return json_encode(array_values($returnValues));
  }
}
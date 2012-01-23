<?php

/**
 * Description of PluginsbEcomAddToBasketSlotEditForm
 *
 * @author Giles Smith <tech@superrb.com>
 */
class PluginsbEcomAddToBasketSlotEditForm extends BaseForm
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
		
		$this->setWidget('reference', new sfWidgetFormInputText());
		$this->setValidator('reference', new sfValidatorString(array('required' => true), array('required' => 'Please enter a product reference for this basket option')));
		
		$this->setWidget('cost', new sfWidgetFormInputText(array('label' => 'Cost (' . sfConfig::get('app_sbApostropheEcommerce_currency_symbol', '&pound;') . ')')));
		$this->setValidator('cost', new sfValidatorNumber(array('required' => true, 'min' => 0)));
		
		$this->setWidget('tax', new sfWidgetFormInputText(array('label' => 'Tax (%)')));
		$this->setValidator('tax', new sfValidatorNumber(array('required' => true, 'min' => 0, 'max' => 100), array('required' => 'Please enter the Tax percentage value', 'invalid' => 'Please enter a numeric value (0-100)')));
		
		$this->setWidget('call_to_order', new sfWidgetFormInputCheckbox());
		$this->setValidator('call_to_order', new sfValidatorBoolean());
		
		$postageChoices = sfConfig::get('app_sbApostropheEcommerce_postage_options', array('free' => 'Free post', 'weight' => 'Postage by Weight', 'fixed' => 'Fixed Cost'));
		$this->setWidget('postage_type', new sfWidgetFormChoice(array('choices' => $postageChoices)));
		$this->setValidator('postage_type', new sfValidatorChoice(array('choices' => array_keys($postageChoices))));
		
		$this->setWidget('weight', new sfWidgetFormInputText(array('label' => 'Weight (' . sfConfig::get('app_sbApostropheEcommerce_weight_unit', 'kg') . ')')));
		$this->setValidator('weight', new sfValidatorNumber(array('required' => false), array('invalid' => 'Please enter a numeric weight in ' . sfConfig::get('app_sbApostropheEcommerce_weight_unit', 'kg'))));
		
		$this->setWidget('cost_per_weight', new sfWidgetFormInputText(array('label' => 'Cost per ' . sfConfig::get('app_sbApostropheEcommerce_weight_unit', 'kg'))));
		$this->setValidator('cost_per_weight', new sfValidatorNumber(array('required' => false), array('invalid' => 'Please enter a numeric cost per ' . sfConfig::get('app_sbApostropheEcommerce_weight_unit', 'kg'))));
		
		$this->setWidget('fixed', new sfWidgetFormInputText(array('label' => 'Fixed postage (' . sfConfig::get('app_sbApostropheEcommerce_currency_symbol', '&pound;') . ')')));
		$this->setValidator('fixed', new sfValidatorNumber(array('required' => false), array('invalid' => 'Please enter a numeric weight in Kg')));
    
    // Ensures unique IDs throughout the page. Hyphen between slot and form to please our CSS
    $this->widgetSchema->setNameFormat('slot-form-' . $this->id . '[%s]');
    
    // You don't have to use our form formatter, but it makes things nice
    $this->widgetSchema->setFormFormatterName('aAdmin');
  }
}

?>
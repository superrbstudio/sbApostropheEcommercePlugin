<?php

/**
 * Description of PluginsbEcomProductsSlotEditForm
 *
 * @author Giles Smith <tech@superrb.com>
 */
abstract class PluginsbEcomProductsSlotEditForm extends BaseForm
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
		$this->allowedPages = sbEcomProductTable::getProductsForChoiceWidget(false, null, null);
    $this->setWidgets(array('products' => new aWidgetFormChoice(array('choices' => $this->allowedPages, 'multiple' => true))));
    $this->setValidators(array('products' => new sfValidatorChoice(array('required' => false, 'choices' => array_keys($this->allowedPages), 'multiple' => true))));
    
    // Ensures unique IDs throughout the page. Hyphen between slot and form to please our CSS
    $this->widgetSchema->setNameFormat('slot-form-' . $this->id . '[%s]');
    
    // You don't have to use our form formatter, but it makes things nice
    $this->widgetSchema->setFormFormatterName('aAdmin');
  }
}

?>

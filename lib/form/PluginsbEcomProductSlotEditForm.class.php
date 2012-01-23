<?php

/**
 * Description of PluginsbEcomProductSlotEditForm
 *
 * @author Giles Smith <tech@superrb.com>
 */
class PluginsbEcomProductSlotEditForm extends BaseForm
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
    
    // A simple example: a slot with a single 'text' field with a maximum length of 100 characters
		$this->allowedPages = sbEcomProductTable::getProductsForChoiceWidget(false, null, null);
    $this->setWidgets(array('product_id' => new sfWidgetFormChoice(array('choices' => $this->allowedPages))));
    $this->setValidators(array('product_id' => new sfValidatorChoice(array('choices' => array_keys($this->allowedPages)))));
    
    // Ensures unique IDs throughout the page. Hyphen between slot and form to please our CSS
    $this->widgetSchema->setNameFormat('slot-form-' . $this->id . '[%s]');
    
    // You don't have to use our form formatter, but it makes things nice
    $this->widgetSchema->setFormFormatterName('aAdmin');
  }
}

?>

<?php

/**
 * PluginsbEcomNewProductForm form.
 *
 * @package    sbApostropheEcommercePlugin
 * @author     Giles Smith <tech@superrb.com>
 */
abstract class PluginsbEcomNewProductForm extends sfForm 
{
	public function configure()
  {
    parent::configure();
    $this->setWidget('title', new sfWidgetFormInputText());
    $this->setValidator('title', new sfValidatorString(array('min_length' => 2, 'required' => true)));
    $this->widgetSchema->setNameFormat('sb_ecom_new_product[%s]');
    $this->widgetSchema->setFormFormatterName('aAdmin');
		
		// post update validations
		$this->validatorSchema->setPostValidator(
			new sfValidatorAnd(array(
				new sfValidatorDoctrineUnique(array('model' => 'sbEcomProduct', 'column' => 'title'))
			))
		);
  }
}

?>

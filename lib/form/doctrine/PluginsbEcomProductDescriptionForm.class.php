<?php

/**
 * PluginsbEcomProductDescription form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginsbEcomProductDescriptionForm extends BasesbEcomProductDescriptionForm
{
	public function setup()
	{
		parent::setup();
		
		$this->setWidget('title', new sfWidgetFormInputText(array(), array('class' => 'small sb-ecom-description-title')));
		$this->setValidator('title', new sfValidatorString(array('required' => false), array('required' => "Please fill in the description title")));
		
		$this->setWidget('description', new aWidgetFormRichTextarea(array('tool' => 'sbEcomProductDescription', 'height' => 182), array('class' => 'sb-ecom-description-description')));
		$this->setValidator('description', new sfValidatorHtml(array('required' => false), array()));
		
		$this->setWidget('author_id', new sfWidgetFormInputHidden());
		$this->setWidget('product_id', new sfWidgetFormInputHidden());
		$this->setWidget('display_order', new sfWidgetFormInputHidden());
		
		unset($this['created_at'], $this['updated_at']);
	}
}

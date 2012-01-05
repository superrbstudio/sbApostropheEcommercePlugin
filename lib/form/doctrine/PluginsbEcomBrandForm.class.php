<?php

/**
 * PluginsbEcomBrand form.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage form
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: sfDoctrineFormPluginTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class PluginsbEcomBrandForm extends BasesbEcomBrandForm
{
	public function setup() 
	{
		parent::setup();
		
		$this->setWidget('author_id', new sfWidgetFormInputHidden());
		$this->setDefault('author_id', sfContext::getInstance()->getUser()->getGuardUser()->getId());
		
		// Main Details
		$this->setWidget('title', new sfWidgetFormInputText(array('label' => 'Product title<span class="required">*</span>'), array('class' => 'large')));
		$this->setValidator('title', new sfValidatorString(array('required' => true), array('required' => 'Please enter the product title')));
		
		$this->setWidget('slug', new sfWidgetFormInputText(array('label' => 'URL Segment<span class="required">*</span>'), array('class' => 'medium')));
		$this->setValidator('slug', new sfValidatorString(array('required' => true), array('required' => 'Please enter the product url segment')));
		
		// meta information
		$this->setWidget('meta_title', new sfWidgetFormInputText(array('label' => 'Meta title<span class="required">*</span>'), array('class' => 'large')));
		$this->setValidator('meta_title', new sfValidatorString(array(), array('required' => 'Please fill in the product meta title')));
		
		$this->setWidget('meta_description', new sfWidgetFormInputText(array('label' => 'Meta description<span class="required">*</span>'), array('class' => 'large')));
		$this->setValidator('meta_description', new sfValidatorString(array(), array('required' => 'Please fill in the product meta description')));
		
		$this->setWidget('meta_keywords', new sfWidgetFormInputText(array('label' => 'Meta keywords<span class="required">*</span>'), array('class' => 'large')));
		$this->setValidator('meta_keywords', new sfValidatorString(array(), array('required' => 'Please fill in the product meta keywords')));
		
		unset($this['created_at'], $this['updated_at']);
	}
}

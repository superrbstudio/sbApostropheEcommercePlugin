<?php

/**
 * PluginsbEcomQuickSearchForm form.
 *
 * @package    sbApostropheEcommercePlugin
 * @author     Giles Smith <tech@superrb.com>
 */
class PluginsbEcomQuickSearchForm extends sfForm
{
	public function setup() 
	{
		parent::setup();
		$this->setWidget('s', new sfWidgetFormInputText(array('label' => 'Search')));
		$this->setValidator('s', new sfValidatorString(array('required' => true), array('required' => 'Please enter a search term')));
	}
}
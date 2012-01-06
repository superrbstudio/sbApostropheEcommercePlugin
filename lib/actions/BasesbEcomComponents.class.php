<?php

/**
 * Base sbEcom components for the sbApostropheEcommerce Plugin
 * 
 * @package    sbApostropheEcommercePlugin
 * @subpackage sbEcom
 * @author     Giles Smith
 */
abstract class BasesbEcomComponents extends sfComponents 
{
	public function preExecute()
  {
    parent::preExecute();
  }
	
	public function executeSidebar()
	{
		
	}
	
	/**
	 * Displays a simple text form for product searches
	 * @param sfWebRequest $request 
	 */
	public function executeQuickSearch(sfWebRequest $request)
	{
		$this->form = new sbEcomQuickSearchForm();
		
		if($request->getParameter('s') != '')
		{
			$this->form->setDefault('s', $request->getParameter('s'));
		}
	}
}

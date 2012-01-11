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
	
	/**
	 * Displays a slideshow for an e-commerce product
	 * @param sfWebRequest $request
	 */
	public function executeSlideShow(sfWebRequest $request)
	{
		$defaults = array('class' => 'sb-location-main',
											'dimensions' => sfConfig::get('app_sbEcom_slideshow', array('width' => 600, 'height' => 400)));
		if(!is_array($this->params)){ $this->params = array(); }
		$this->params     = array_merge($defaults, $this->params);
	}
}












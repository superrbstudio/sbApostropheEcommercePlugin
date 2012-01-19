<?php

/**
 * Description of PluginsbEcomNavigationComponents
 *
 * @author Giles Smith <tech@superrb.com>
 */
class PluginsbEcomNavigationComponents extends BaseaNavigationComponents
{
	public function executeCategoryChildren()
	{
		$this->userAuthenticated = $this->getUser()->isAuthenticated();
		parent::executeTabs();
		
		// @TODO - add optional filter for page types based on category or product templates.
	}
}
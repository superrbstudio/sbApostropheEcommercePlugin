<?php

class BasesbEcomNavigationComponents extends BaseaNavigationComponents
{
	public function executeBreadcrumb()
	{	
		if($this->category instanceof Doctrine_Collection)
		{
			$this->category = $this->category[0];
		}
		
		parent::executeBreadcrumb();
	}
}

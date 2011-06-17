<?php

/**
 * Base sbEcom actions for the sbApostropheEcommerce Plugin.
 * 
 * @package    sbApostropheEcommercePlugin
 * @subpackage sbEcom
 * @author     Giles Smith
 */
abstract class BasesbEcomActions extends aEngineActions 
{
	public function executeIndex(sfWebRequest $request)
	{
		// get all featured products
		$this->featuredProducts = sbEcomProductTable::getFeaturedProducts();
		
		// get all categories that have products
		$this->categories = sbEcomProductTable::getProductCategories();
		
	}
	
	public function executeCategory(sfWebRequest $request)
	{
		// verify category exists
		$this->category = sbEcomProductTable::getProductCategoryBySlug($request->getParameter('slug'));
		$this->forward404If((!($this->category instanceof aCategory)));
		$this->response->setTitle(sfConfig::get('app_a_title_prefix', '') . $this->category->getName() . sfConfig::get('app_a_title_suffix', ''));
		
		
		// get all products in category and apply tag filters
		$this->products = sbEcomProductTable::getProductsInCategory($this->category);
	}
	
	public function executeProduct(sfWebRequest $request)
	{
		// verify product and load
		
	}
}

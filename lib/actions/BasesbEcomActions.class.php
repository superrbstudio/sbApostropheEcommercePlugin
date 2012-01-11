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
	public function preExecute() {
		parent::preExecute();
		$this->getEcomInfo();
	}
	
	public function executeIndex(sfWebRequest $request)
	{	
	}
	
	public function executeCategory(sfWebRequest $request)
	{
		// verify category exists
		$this->category = sbEcomProductTable::getProductCategoryBySlug($request->getParameter('cat'));
		$this->forward404If((!($this->category instanceof aCategory)));
		
		// Set Meta data
		$prefix = aTools::getOptionI18n('title_prefix');
    $suffix = aTools::getOptionI18n('title_suffix');
    $this->getResponse()->setTitle($prefix . $this->category->getMetaTitle() . $suffix, false);
		$this->getResponse()->addMeta('description', $this->category->getMetaDescription());
		$this->getResponse()->addMeta('keywords', $this->category->getMetaKeywords());
		
		// get all products in category
		$this->products = sbEcomProductTable::getProductsInCategory($this->category, true, array('order_by' => 'title asc'));
		
		// register a javascript record of the category
		$items = array('url' => url_for('@sb_ecom_categories?cat=' . $this->category->getSlug()), 'title' => $this->category->getName());
		a_js_call('sbEcomRegisterCategoryView(?)',  json_encode($items));
	}
	
	public function executeProduct(sfWebRequest $request)
	{
		$this->product = sbEcomProductTable::getProductBySlug($request->getParameter('slug'));
		$this->forward404Unless($this->product instanceof sbEcomProduct);
		$this->forward404Unless($this->product->getActive());
		
		// Set Meta data
		$prefix = aTools::getOptionI18n('title_prefix');
    $suffix = aTools::getOptionI18n('title_suffix');
    $this->getResponse()->setTitle($prefix . $this->product->getMetaTitle() . $suffix, false);
		$this->getResponse()->addMeta('description', $this->product->getMetaDescription());
		$this->getResponse()->addMeta('keywords', $this->product->getMetaKeywords());
		
		// get the user
		$this->user = $this->getUser();
		
		// get the basket form
		$this->basketForm = new sbEcomAddToBasketForm();
		$this->basketForm->setDefault('product_id', $this->product->getId());
		$this->basketForm->setDefault('count', 1);
		
		if($this->product->Categories instanceof Doctrine_Collection)
		{
			$categories = array();
			
			foreach($this->product->Categories as $category)
			{
				$categories[] = array('url' => urlencode(url_for('@sb_ecom_categories?cat=' . $category['slug'])), 'title' => urlencode($category['name']));
			}
			
			if(count($categories) > 0)
			{
				a_js_call('sbEcomUpdateCategoryBreadCrumb(?)', json_encode($categories));
			}
		}
	}
	
	public function executeSearch($request)
	{
		$this->form = new sbEcomSearchForm();
		$values = array('s' => $request->getParameter('s'));
		$this->form->bind($values);
		$this->searchValid = false;
		$this->products = array();
		
		if($this->form->isValid() and $request->getParameter('s') != '')
		{
			$this->searchValid = true;
			$this->products = sbEcomProductTable::getProductsBySearch($this->form->getValue('s'));
		}
	}
	
	protected function getEcomInfo()
	{
		// get all categories that have products
		$this->categories = sbEcomProductTable::getProductCategories(true, array('order_by' => 'c.name asc'));
	}
}

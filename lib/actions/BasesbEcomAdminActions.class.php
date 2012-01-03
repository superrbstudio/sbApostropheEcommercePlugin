<?php

require_once dirname(__FILE__).'/../../modules/sbEcomAdmin/lib/sbEcomAdminGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../../modules/sbEcomAdmin/lib/sbEcomAdminGeneratorHelper.class.php';

/**
 * Base sbEcomAdmin actions for the sbApostropheEcommerce Plugin.
 * 
 * @package    sbApostropheEcommercePlugin
 * @subpackage sbEcomAdmin
 * @author     Giles Smith <tech@superrb.com>
 */
abstract class BasesbEcomAdminActions extends autoSbEcomAdminActions 
{	
	// You must create with at least a title
  public function executeNew(sfWebRequest $request)
  {
    $this->forward404();
  }
	
	// Doctrine collection routes make it a pain to change the settings
  // of the standard routes fundamentally, so we provide another route
  public function executeNewWithTitle(sfWebRequest $request)
  {
		sfContext::getInstance()->getConfiguration()->loadHelpers(array('Url'));
    $this->form = new sbEcomNewProductForm();
    $this->form->bind($request->getParameter('sb_ecom_new_product'));
		$this->getResponse()->setHttpHeader('Content-Type','application/json; charset=utf-8');
		
    if ($this->form->isValid())
    {
			$this->product = new sbEcomProduct();
			$this->product->setTitle($this->form->getValue('title'));
			$this->product->Author = $this->getUser()->getGuardUser();
			$this->product->save();
			$this->getResponse()->setContent(json_encode(array('status' => true, 'redirect_url' => url_for('@sb_ecom_product_sbEcomAdmin') . "/" . $this->product->getId() . "/edit")));
    }
		else
		{
			$this->getResponse()->setContent(json_encode(array('status' => false, 'error' => array($this->form->renderGlobalErrors()))));
		}
    
		return sfView::NONE;
  }
}

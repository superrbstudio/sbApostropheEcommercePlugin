<?php

/**
 * sbApostropheEcommerce configuration.
 * 
 * @package     sbApostropheEcommercePlugin
 * @subpackage  config
 * @author      Giles Smith <tech@superrb.com>
 * @version     SVN: $Id: PluginConfiguration.class.php 17207 2009-04-10 15:36:26Z Kris.Wallsmith $
 */
class sbApostropheEcommercePluginConfiguration extends sfPluginConfiguration
{

  static $registered = false;
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    // Yes, this can get called twice. This is Fabien's workaround:
    // http://trac.symfony-project.org/ticket/8026
    
    if (!self::$registered)
    {
      $this->dispatcher->connect('a.getGlobalButtons', array('sbApostropheEcommercePluginConfiguration', 'getGlobalButtons'));
      
      self::$registered = true;
    }
  }
  
  static public function getGlobalButtons()
  {
    $user = sfContext::getInstance()->getUser();
 
    if ($user->hasCredential('sb_ecom_admin') or $user->hasCredential('sb_ecom_products_editor'))
    {
      aTools::addGlobalButtons(array(
        new aGlobalButton('sb-ecom-products', 'Products', '@sb_ecom_product_sbEcomAdmin', 'sb-ecom-products')
      ));
    }
		
		if ($user->hasCredential('sb_ecom_admin') or $user->hasCredential('sb_ecom_brands_editor'))
    {
      aTools::addGlobalButtons(array(
				new aGlobalButton('sb-ecom-brands', 'Brands', '@sb_ecom_product_sbEcomBrandAdmin', 'sb-ecom-brands')
      ));
    }
		
		/*if ($user->hasCredential('sb_ecom_admin') or $user->hasCredential('sb_ecom_orders_editor'))
    {
      aTools::addGlobalButtons(array(
				new aGlobalButton('sb-ecom-orders', 'Orders', '@sb_ecom_product_sbEcomOrdersAdmin', 'sb-ecom-orders')
      ));
    }*/
  }
}

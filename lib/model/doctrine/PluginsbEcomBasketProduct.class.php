<?php

/**
 * PluginsbEcomBasketProduct
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class PluginsbEcomBasketProduct extends BasesbEcomBasketProduct
{
  /**
   * Returns the cost (exluding tax) for the quantity of items
   * @return float 
   */
	public function getCost()
	{
		return (float)round($this->getItemCost() * $this->getQuantity(), 2);
	}
	
  /**
   * Returns the total tax for the quantity of items
   * @return float 
   */
	public function getTax()
	{
		return (float)round((($this->getItemTax() / 100) * $this->getItemCost()) * $this->getQuantity(), 2);
	}
	
  /** 
   * Returns the postage cost for the quantity of items
   * @return float 
   */
	public function getPostage()
	{
		return (float)round($this->getPostageCost() * $this->getQuantity(), 2);
	}
  
  /**
   * Returns the postage tax for the quantity of items
   * @return type 
   */
  public function getPostageTax()
  {
    return (float)round($this->getPostage() * (sfConfig::get('app_sbApostropheEcommerce_postage_tax', 20) / 100), 2);
  }
	
  /**
   * Returns the total cost including tax (excluding postage) for the quantity of items
   * @return float 
   */
	public function getTotalCost()
	{
		return (float)round($this->getCost() + $this->getTax(), 2);
	}
  
  /**
   * Returns the total tax for the quantity of items, including postage tax
   * @return type 
   */
  public function getTotalTax()
  {
    return (float)round($this->getTax() + $this->getPostageTax(), 2);
  }
}
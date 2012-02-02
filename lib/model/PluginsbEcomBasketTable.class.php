<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BasesbEcomBasketTable
 *
 * @author pureroon
 */
class PluginsbEcomBasketTable
{	
	public static $cookieName = 'sb-ecom-basket-identifier';
	
	public static function getUsersBasketIdentifier()
	{
		$ident  = sfContext::getInstance()->getRequest()->getCookie(self::$cookieName);
		
		if($ident == '' or is_null($ident))
		{
			$ident = session_id();
			sfContext::getInstance()->getResponse()->setCookie(self::$cookieName, $ident , time() + 24 * 3600);
		}
		
		return $ident;
	}
	
	public static function getUsersBasket()
	{
		return new sbEcomBasket(self::getProductsInUsersBasket(self::getUsersBasketIdentifier()));
	}
	
	public static function getProductsInUsersBasket()
	{
		return Doctrine_Core::getTable('sbEcomBasketProduct')->createQuery()
						->where('session_id = ?', self::getUsersBasketIdentifier())
						->andWhere('checkout_id IS NULL')
						->execute();
	}
	
	/**
		* Adds a product to a users basket
		* 
		* @param array $params
		* @return void 
		*/
	public static function addProductToBasket($params)
	{
		//check one doesn't exist already
		$basketProduct = self::getBasketProductForUserByProductId($params['product_id'], $params['slot_id'], self::getUsersBasketIdentifier());

		if(!($basketProduct instanceof sbEcomBasketProduct) or $basketProduct->isNew())
		{
			$basketProduct = new sbEcomBasketProduct();
			$basketProduct->setSessionId(self::getUsersBasketIdentifier());
			$basketProduct->setProductId($params['product_id']);
			$basketProduct->setSlotId($params['slot_id']);
		}
		
		$basketProduct->setItemCost($params['item_cost']);
		$basketProduct->setPostageCost($params['postage_cost']);
		$basketProduct->setItemTax($params['item_tax']);
		$basketProduct->setItemTitle($params['item_title']);
		$basketProduct->setItemReference($params['item_reference']);
		$basketProduct->setQuantity($basketProduct->getQuantity() + $params['quantity']);
		$basketProduct->save();
		
		// clean the basket
		self::cleanBasket();
	}
	
	public static function createBasketValues(aPage $productPage, aSlot $productSlot, $quantity, $params = array())
	{
		switch($params['postage_type'])
		{
			case 'fixed':
				$postage = $params['fixed'];
				break;
			
			case 'weight':
				$postage = $params['weight'] * $params['cost_per_weight'];
				break;
			
			default:
				$postage = 0;
		}
		
		return array(
				'product_id' => $productPage->getId(),
				'slot_id' => $productSlot->getId(),
				'quantity' => $quantity,
				'item_cost' => $params['cost'],
				'postage_cost' => $postage,
				'item_tax' => $params['tax'],
				'item_title' => $params['title'],
				'item_reference' => $params['reference']
						);
	}
	
	/**
		* Returns a Product in a user's basket
		* Will also combine any duplicates found
		* 
		* @param integer $productId The database ID of the product
		* @param string $sessionId The users session id
		* @return sbEcomBasketProduct 
		*/
	public static function getBasketProductForUserByProductId($productId, $slotId)
	{
		$root = Doctrine_Query::create()
						->select('b.*')
						->from('sbEcomBasketProduct b')
						->where('b.product_id = ?', $productId)
						->andWhere('b.slot_id = ?', $slotId)
						->andWhere('b.session_id = ?', self::getUsersBasketIdentifier())
						->execute();
		
		if(!($root instanceof Doctrine_Collection))
		{
			return false;
		}
		
		$i = 0;
		$basketProduct = new sbEcomBasketProduct();
		
		foreach($root as $product)
		{	
			if($i == 0)
			{
				$basketProduct = $product;
				$count = $basketProduct->getQuantity();
			}
			else
			{
				$count+= $product->getQuantity();
				$product->delete();
			}
			
			$i++;
		}
		
		if($i >= 1)
		{
			$basketProduct->setQuantity($count);
			$basketProduct->save();
		}
		
		return $basketProduct;
	}
	
	public static function cleanBasket()
	{
		// clean out any broken products and out of date ones
		Doctrine_Query::create()->delete()->from('sbEcomBasketProduct')
						->where('updated_at < DATE_SUB(CURDATE(),INTERVAL ' . sfConfig::get('app_sbApostropheEcommerce_clean_basket_days', 100) . ' DAY)')
						->andWhere('checkout_id IS NULL')
						->execute();
	}
}

?>

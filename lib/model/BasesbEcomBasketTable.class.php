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
class BasesbEcomBasketTable
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
		return sbEcomBasketProductTable::getInstance()->findBy('session_id', self::getUsersBasketIdentifier());
	}
	
	/**
		* Adds a product to a users basket
		* 
		* @param type $productId
		* @param type $sessionId
		* @return boolean 
		*/
	public static function addProductToBasket($productId, $quantity = 1)
	{
		//check one doesn't exist already
		$basketProduct = self::getBasketProductForUserByProductId($productId, self::getUsersBasketIdentifier());

		if(!($basketProduct instanceof sbEcomBasketProduct) or $basketProduct->isNew())
		{
			$basketProduct = new sbEcomBasketProduct();
			$basketProduct->setSessionId(self::getUsersBasketIdentifier());
			$basketProduct->setProductId($productId);
		}
		
		$basketProduct->setQuantity($basketProduct->getQuantity() + $quantity);
		return $basketProduct->save();
	}
	
	/**
		* Returns a Product in a user's basket
		* Will also combine any duplicates found
		* 
		* @param integer $productId The database ID of the product
		* @param string $sessionId The users session id
		* @return sbEcomBasketProduct 
		*/
	public static function getBasketProductForUserByProductId($productId)
	{
		$root = Doctrine_Query::create()
						->select('b.*')
						->from('sbEcomBasketProduct b')
						->where('b.product_id = ?', $productId)
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
}

?>

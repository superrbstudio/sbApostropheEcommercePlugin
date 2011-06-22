<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sbEcomBasketTable
 *
 * @author pureroon
 */
class sbEcomBasketTable 
{
	public static function getUsersBasket($sessionId)
	{
		return new sbEcomBasket(sbEcomBasketProductTable::getProductsInUsersBasket($sessionId));
	}
}

?>

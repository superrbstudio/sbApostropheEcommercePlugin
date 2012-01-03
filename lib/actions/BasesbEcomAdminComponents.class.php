<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BasesbEcomAdminComponents
 *
 * @author pureroon
 */
abstract class BasesbEcomAdminComponents extends sfComponents 
{
	public function executeNewProduct()
	{
		$this->form = new sbEcomNewProductForm();
	}
}

?>

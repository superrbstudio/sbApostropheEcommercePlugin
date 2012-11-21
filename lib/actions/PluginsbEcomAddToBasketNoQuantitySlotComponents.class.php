<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PluginsbEcomAddToBasketSlotComponents
 *
 * @author pureroon
 */
abstract class PluginsbEcomAddToBasketNoQuantitySlotComponents extends aSlotComponents
{
	public function executeEditView()
  {
    // Must be at the start of both view components
    $this->setup();
    
    // Careful, don't clobber a form object provided to us with validation errors
    // from an earlier pass
    if (!isset($this->form))
    {
      $this->form = new sbEcomAddToBasketNoQuantitySlotEditForm($this->id, $this->slot->getArrayValue());
    }
  }
	
  public function executeNormalView()
  {
    $this->setup();
    $this->values = $this->slot->getArrayValue();
		$this->addToBasketForm = new sbEcomAddToBasketNoQuantityForm();
		$this->addToBasketForm->setDefault('product_id', $this->pageid);
		$this->addToBasketForm->setDefault('slot_id', $this->slot->id);
  }
}

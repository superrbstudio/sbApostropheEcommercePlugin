<?php

/**
 * Description of PluginsbEcomAddToBasketWithOptionSlotComponents
 *
 * @author pureroon
 */
class PluginsbEcomAddToBasketWithOptionSlotComponents extends aSlotComponents
{
  public function executeEditView()
  {
    // Must be at the start of both view components
    $this->setup();
    
    // Careful, don't clobber a form object provided to us with validation errors
    // from an earlier pass
    if (!isset($this->form))
    {
      $this->form = new sbEcomAddToBasketWithOptionSlotEditForm($this->id, $this->slot->getArrayValue());
    }
  }
  
  public function executeNormalView()
  {
    $this->setup();
    $this->values = $this->slot->getArrayValue();
    $this->addToBasketForm = new sbEcomAddToBasketWithOptionForm(null, array('optionValues' => sbEcomAddToBasketWithOptionSlotTable::convertOptionValuesToSelectOptions($this)));
		$this->addToBasketForm->setDefault('product_id', $this->pageid);
		$this->addToBasketForm->setDefault('slot_id', $this->slot->id);
  }
}

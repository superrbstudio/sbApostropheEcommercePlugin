<?php

/**
 * Description of PluginsbEcomProductSlotComponents
 *
 * @author Giles Smith <tech@superrb.com>
 */
class PluginsbEcomProductSlotComponents extends aSlotComponents
{
	public function executeEditView()
  {
    // Must be at the start of both view components
    $this->setup();
    
    // Careful, don't clobber a form object provided to us with validation errors
    // from an earlier pass
    if (!isset($this->form))
    {
      $this->form = new sbEcomProductSlotEditForm($this->id, $this->slot->getArrayValue());
    }
  }
  public function executeNormalView()
  {
    $this->setup();
    $this->values = $this->slot->getArrayValue();
		$this->product = null;
		
		if(isset($this->values['product_id']) and is_numeric($this->values['product_id']))
		{
			$this->product = sbEcomProductTable::retrieveByIdWithSlots($this->values['product_id']);
		}
  }
}
<?php

/**
 * Description of PluginsbEcomProductsSlotComponents
 *
 * @author Giles Smith <tech@superrb.com>
 */
abstract class PluginsbEcomProductsSlotComponents extends aSlotComponents
{
	public function executeEditView()
  {
    // Must be at the start of both view components
    $this->setup();
    
    // Careful, don't clobber a form object provided to us with validation errors
    // from an earlier pass
    if (!isset($this->form))
    {
      $this->form = new sbEcomProductsSlotEditForm($this->id, $this->slot->getArrayValue());
    }
  }
  public function executeNormalView()
  {
    $this->setup();
    $this->values = $this->slot->getArrayValue();
		$this->products = null;
		
		if(isset($this->values['products']) and is_array($this->values['products']))
		{
			$this->products = sbEcomProductTable::queryWithSlots(false, null, Doctrine::getTable('aPage')->createQuery('p')->whereIn('p.id', $this->values['products']))->execute();
		}
  }
}

?>

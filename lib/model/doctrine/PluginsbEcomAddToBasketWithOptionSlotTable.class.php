<?php

/**
 * PluginsbEcomAddToBasketWithOptionSlotTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class PluginsbEcomAddToBasketWithOptionSlotTable extends aSlotTable
{
  /**
   * Returns an instance of this class.
   *
   * @return object PluginsbEcomAddToBasketWithOptionSlotTable
   */
  public static function getInstance()
  {
    return Doctrine_Core::getTable('PluginsbEcomAddToBasketWithOptionSlot');
  }
  
  public static function convertOptionValuesToSelectOptions($slot)
  { 
    // configure options
    $options = array();
    
    if(!($slot instanceof sbEcomAddToBasketWithOptionSlot))
    {
      return $options;
    }
    
    $slotValues = $slot->getArrayValue();
    $values = json_decode($slotValues['option_value']);
    
    if($values)
    {
      foreach($values as $key => $value)
      {
        $options[$value->value] = $value->value;
      }
    }
    
    return $options;
  }
  
  public static function convertOptionValuesToPriceDifferenceArray($slot)
  {
    // configure options
    $options = array();
    
    if(!($slot instanceof sbEcomAddToBasketWithOptionSlot))
    {
      return $options;
    }
    
    $slotValues = $slot->getArrayValue();
    $values = json_decode($slotValues['option_value']);
    
    if($values)
    {
      foreach($values as $key => $value)
      {
        $options[$value->value] = $value->cost;
      }
    }
    
    return $options;
  }
}
<?php // Just echo the form. You might want to render the form fields differently ?>
<?php echo $form ?>
<?php a_js_call('sbEcommerceSetupAddToBasketEditSlot(?)', 'slot-form-' . $pageid . '-' . $name . '-' . $permid); ?>

<div class="option-values-container">
  <strong>Option Values:</strong>
</div>
<a class="a-btn add-new-option" href="#" title="Add a new option value"><span class="icon"></span>Add new option value</a>

<?php a_js_call('sbEcommerceSetupAddToBasketEditSlotOptions(?)', 'slot-form-' . $pageid . '-' . $name . '-' . $permid); ?>
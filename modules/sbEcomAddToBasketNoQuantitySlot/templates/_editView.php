<?php // Just echo the form. You might want to render the form fields differently ?>
<?php echo $form ?>
<?php a_js_call('sbEcommerceSetupAddToBasketEditSlot(?)', 'slot-form-' . $pageid . '-' . $name . '-' . $permid); ?>
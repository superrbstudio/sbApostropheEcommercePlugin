<?php if($product->getCallToBuy()): ?>
	<?php /* Show nothing */ ?>
<?php elseif(!$product->getCallToBuy() and $product->getIsOutOfStock() and sfConfig::get('app_sbEcom_show_out_of_stock', false)): ?>
	<p class="out-of-stock">This product is currently out of stock. <span class="smaller">Please call <strong><?php echo sfConfig::get('app_sbEcom_contact_telephone'); ?></strong> for further details.</span></p>
<?php else: ?>
<form action="<?php echo url_for('@sb_ecom_basket_action?action=add'); ?>" method="post" class="a-ui product-basket-form">
	<?php echo $basketForm->renderHiddenFields(); ?>
	<input type="submit" class="a-submit" value="Add to basket" />
	<div class="product-quantity">
		<?php echo $basketForm['quantity']->renderLabel(); ?><?php echo $basketForm['quantity']->render(); ?>
	</div>
</form>
<?php endif; ?>
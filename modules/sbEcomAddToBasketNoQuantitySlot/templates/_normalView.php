<?php use_helper('a') ?>

<?php if ($editable): ?>
<?php include_partial('a/simpleEditWithVariants', array('pageid' => $pageid, 'name' => $name, 'permid' => $permid, 'slot' => $slot)) ?>
<?php endif; ?>

<?php if(isset($values['call_to_order']) and $values['call_to_order'] == 'call_to_order_no_price'): ?>
	<p class="sb-ecom-add-to-basket-call-to-buy">This product is not available via the website, please call <?php echo sfConfig::get('app_sbApostropheEcommerce_contact_phone'); ?> for more information.</p>
<?php elseif(isset($values['call_to_order']) and $values['call_to_order'] == 'call_to_order'): ?>
	<div class="sb-ecom-add-to-basket-cost">
		<?php if (isset($values['cost'])): ?><?php echo sbEcomToolkit::costFormat($values['cost']); ?><?php endif; ?>
	</div>
	<p class="sb-ecom-add-to-basket-call-to-buy">This product is not available via the website, please call <?php echo sfConfig::get('app_sbApostropheEcommerce_contact_phone'); ?> for more information.</p>
<?php else: ?>
	<div class="sb-ecom-add-to-basket-title">
		<?php if (isset($values['title'])): ?><h4><?php echo htmlspecialchars($values['title']); ?></h4><?php endif; ?>
		<?php if (isset($values['reference'])): ?><h5>Ref: <?php echo htmlspecialchars($values['reference']); ?></h5><?php endif; ?>
	</div>
	<div class="sb-ecom-add-to-basket-cost">
		<?php if (isset($values['cost'])): ?><?php echo sbEcomToolkit::costFormat($values['cost']); ?><?php endif; ?>
	</div>
	<?php if($addToBasketForm instanceof sbEcomAddToBasketNoQuantityForm): ?>
	<form action="<?php echo url_for('@sb_ecom_basket_action?action=add'); ?>" method="post" class="a-ui sb-ecom-add-to-basket-form">
		<?php echo $addToBasketForm->render(); ?>
		<input type="submit" name="add-to-basket" value="Add to basket" class="a-btn sb-ecom-add-to-basket big"/>
	</form>
	<?php endif; ?>
<?php endif; ?>

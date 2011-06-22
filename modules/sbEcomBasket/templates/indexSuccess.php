
<?php slot('body_class') ?>sb-ecom <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav', ''); ?>

<div id="sb-ecom-main" class="sb-ecom-main clearfix">
	
<?php if($basket->getNumProducts() > 0) : ?>
	<table id="ecom-basket-table">
		<thead>
			<tr>
				<th class="product-title">Product</th>
				<th class="product-quantity">Quantity</th>
				<th class="product-remove">Remove</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($basket->getBasketProducts() as $basketProduct): ?>
			<tr>
				<td class="product-title">
					<a href="<?php echo url_for('@sb_ecom_product?slug=' . $basketProduct->getEcomProduct()->getSlug()); ?>"><?php echo $basketProduct->getEcomProduct()->getTitle(); ?></a>
				</td>
				<td class="product-quantity">
					<a href="<?php echo url_for('@sb_ecom_basket_action?action=plus&id=' . $basketProduct->getEcomProduct()->getId()); ?>"><span>+</span></a>
					<?php echo $basketProduct->getQuantity(); ?>
					<a href="<?php echo url_for('@sb_ecom_basket_action?action=subtract&id=' . $basketProduct->getEcomProduct()->getId()); ?>"><span>-</span></a>
				</td>
				<td class="product-remove"><a href="<?php echo url_for('@sb_ecom_basket_action?action=delete&product=' . $basketProduct->getId()); ?>"><span>Delete</span></a>
			</tr>
	<?php endforeach; ?>
		</tbody>
	</table>
	<p class="checkout-link"><a href="<?php echo url_for('@sb_ecom_checkout'); ?>">Proceed to Checkout</a></p>
<?php else: ?>
	<p class="empty-basket">You have no products in your basket, <a href="<?php echo url_for('@sb_ecom_index'); ?>"add some</a> in the shop.</p>"
<?php endif; ?>	
</div>

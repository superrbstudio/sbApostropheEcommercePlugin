
<?php slot('body_class') ?>sb-ecom <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav', ''); ?>

<div id="sb-ecom-main-basket" class="sb-ecom-main clearfix">
	
	<h1 class="sb-ecom-basket-title">Your Basket</h1>
	
<?php if($basket->getNumProducts() > 0) : ?>
	<table id="sb-ecom-basket-table" class="a-ui">
		<thead>
			<tr>
				<th class="sb-ecom-basket-product-title"><span>Product</span></th>
				<th class="sb-ecom-basket-product-quantity"><span>Quantity</span></th>
				<th class="sb-ecom-basket-product-cost"><span>Cost</span></th>
				<th class="sb-ecom-basket-product-tax"><span>Tax</span></th>
				<th class="sb-ecom-basket-product-remove"><span>Remove</span></th>
			</tr>
		</thead>
		<tbody>
	<?php $i = 0; foreach($basket->getBasketProducts() as $basketProduct): ?>
			<tr class="<?php if(is_int($i / 2)) { echo "first"; } else { echo "second"; } ?>">
				<td class="sb-ecom-basket-product-title">
					<p class="title"><a href="<?php echo url_for($basketProduct->getEcomProduct()->getSlug()); ?>"><?php echo $basketProduct->getItemTitle(); ?></a></p>
					<p class="subtitle">Ref: <?php echo $basketProduct->getItemReference(); ?></p>
				</td>
				<td class="sb-ecom-basket-product-quantity a-ui">
          <?php if($basketProduct->getAllowDuplicates()): ?>
					<a class="a-btn" href="<?php echo url_for('@sb_ecom_basket_action?action=subtract&product=' . $basketProduct->getEcomProduct()->getId() . '&slot=' . $basketProduct->getSlotId() . '&title=' . $basketProduct->getItemTitle()); ?>"><span>-</span></a>
					<span class="sb-ecom-basket-product-quantity-value"><?php echo $basketProduct->getQuantity(); ?></span>
					<a class="a-btn" href="<?php echo url_for('@sb_ecom_basket_action?action=plus&product=' . $basketProduct->getEcomProduct()->getId() . '&slot=' . $basketProduct->getSlotId() . '&title=' . $basketProduct->getItemTitle()); ?>"><span>+</span></a>
          <?php endif; ?>
				</td>
				<td class="sb-ecom-basket-product-cost sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basketProduct->getCost()); ?></td>
				<td class="sb-ecom-basket-product-tax sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basketProduct->getTax()); ?></td>
				<td class="sb-ecom-basket-product-remove a-ui"><a class="a-btn icon no-label a-delete alt" href="<?php echo url_for('@sb_ecom_basket_action?action=delete&product=' . $basketProduct->getEcomProduct()->getId() . '&slot=' . $basketProduct->getSlotId() . '&title=' . $basketProduct->getItemTitle()); ?>"><span class="icon"></span>Delete</a>
			</tr>
	<?php $i++; endforeach; ?>
			<tr class="sb-ecom-divider">
				<td colspan="5"><hr/></td>
			</tr>
			<tr class="sb-ecom-basket-total-cost">
				<td colspan="3" class="sb-ecom-total-title">Subtotal</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getCost()); ?></td>
			</tr>
			<tr class="sb-ecom-basket-total-tax">
				<td colspan="3" class="sb-ecom-total-title">Tax</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getTax()); ?></td>
			</tr>
			<tr class="sb-ecom-basket-total-postage">
				<td colspan="3" class="sb-ecom-total-title">Postage</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getPostage()); ?></td>
			</tr>
      <tr class="sb-ecom-basket-total-postage">
				<td colspan="3" class="sb-ecom-total-title">Postage Tax</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getPostageTax()); ?></td>
			</tr>
			<tr class="sb-ecom-basket-total-total">
				<td colspan="3" class="sb-ecom-total-title">Total</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getTotal()); ?></td>
			</tr>
		</tbody>
	</table>
	<p class="sb-ecom-checkout-link a-ui"><a class="a-btn" href="<?php echo url_for('@sb_ecom_checkout'); ?>">Proceed to Checkout</a></p>
<?php else: ?>
	<p class="sb-ecom-empty-basket-message a-ui">You haven't added any products to your basket yet.</p>
<?php endif; ?>	
</div>

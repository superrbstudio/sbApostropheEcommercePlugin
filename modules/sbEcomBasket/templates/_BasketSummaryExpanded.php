<table id="sb-ecom-basket-table" class="a-ui">
		<thead>
			<tr>
				<th class="sb-ecom-basket-product-title"><span>Product</span></th>
				<th class="sb-ecom-basket-product-quantity"><span>Quantity</span></th>
				<th class="sb-ecom-basket-product-cost"><span>Cost</span></th>
				<th class="sb-ecom-basket-product-tax"><span>Tax</span></th>
			</tr>
		</thead>
		<tbody>
	<?php $i = 0; foreach($basket->getBasketProducts() as $basketProduct): ?>
			<tr class="<?php if(is_int($i / 2)) { echo "first"; } else { echo "second"; } ?>">
				<td class="sb-ecom-basket-product-title">
					<p class="title"><?php echo $basketProduct->getItemTitle(); ?></p>
					<p class="subtitle">Ref: <?php echo $basketProduct->getItemReference(); ?></p>
				</td>
				<td class="sb-ecom-basket-product-quantity a-ui">
					<span class="sb-ecom-basket-product-quantity-value"><?php echo $basketProduct->getQuantity(); ?></span>
				</td>
				<td class="sb-ecom-basket-product-cost sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basketProduct->getCost()); ?></td>
				<td class="sb-ecom-basket-product-tax sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basketProduct->getTax()); ?></td>
			</tr>
	<?php $i++; endforeach; ?>
			<tr class="sb-ecom-divider">
				<td colspan="5"><hr/></td>
			</tr>
			<tr class="sb-ecom-basket-total-cost">
				<td colspan="2" class="sb-ecom-total-title">Subtotal</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getCost()); ?></td>
			</tr>
			<tr class="sb-ecom-basket-total-tax">
				<td colspan="2" class="sb-ecom-total-title">Tax</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getTax()); ?></td>
			</tr>
			<tr class="sb-ecom-basket-total-postage">
				<td colspan="2" class="sb-ecom-total-title">Postage</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getPostage()); ?></td>
			</tr>
      <tr class="sb-ecom-basket-total-postage">
				<td colspan="2" class="sb-ecom-total-title">Postage Tax</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getPostageTax()); ?></td>
			</tr>
			<tr class="sb-ecom-basket-total-total">
				<td colspan="2" class="sb-ecom-total-title">Total</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getTotal()); ?></td>
			</tr>
		</tbody>
	</table>
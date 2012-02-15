<?php $sb_ecom_checkout = $form->getObject(); ?>
<table class="sb-ecom-checkout-products">
	<thead>
		<tr>
			<th>Product</th>
			<th>Quantity</th>
			<th>Cost</th>
			<th>Tax</th>
			<th>Postage</th>
		</tr>
	</thead>
	<tbody>
<?php $i = 0; foreach($sb_ecom_checkout->EcomCheckoutProduct as $product): ?>
		<tr class="<?php if(is_int($i / 2)): echo "first"; else: echo "second"; endif; ?>">
			<td><?php echo $product->getItemTitle(); ?><br/><?php echo $product->getItemReference(); ?></td>
			<td><?php echo $product->getQuantity(); ?></td>
			<td><?php echo sbEcomToolkit::costFormat($product->getCost()); ?></td>
			<td><?php echo sbEcomToolkit::costFormat($product->getTax()); ?></td>
			<td><?php echo sbEcomToolkit::costFormat($product->getPostageCost()); ?></td>
		</tr>
<?php $i++; endforeach; ?>
		<tr>
			<td colspan="3" class="total-title">Sub Total:</td>
			<td colspan="2" class="total-cost"><?php echo sbEcomToolkit::costFormat($sb_ecom_checkout->getCost()); ?></td>
		</tr>
		<tr>
			<td colspan="3" class="total-title">Tax:</td>
			<td colspan="2" class="total-cost"><?php echo sbEcomToolkit::costFormat($sb_ecom_checkout->getTax()); ?></td>
		</tr>
		<tr>
			<td colspan="3" class="total-title">Postage:</td>
			<td colspan="2" class="total-cost"><?php echo sbEcomToolkit::costFormat($sb_ecom_checkout->getPostage()); ?></td>
		</tr>
		<tr>
			<td colspan="3" class="total-title grand-total">Total:</td>
			<td colspan="2" class="total-cost grand-total"><?php echo sbEcomToolkit::costFormat($sb_ecom_checkout->getTotalCost()); ?></td>
		</tr>
	</tbody>
</table>


<?php slot('body_class') ?>sb-ecom <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav', ''); ?>

<div id="sb-ecom-main-basket" class="sb-ecom-main clearfix">
	
	<h1 class="sb-ecom-basket-title">Your Basket</h1>
	<?php a_slot('basket-title', 'aRichText', array('slug' => url_for('@sb_ecom_basket'))); ?>
	
<?php if($basket->getNumProducts() > 0) : ?>
	<table id="sb-ecom-basket-table" class="a-ui">
		<thead>
			<tr>
				<th class="sb-ecom-basket-product-image"><span>Image</span></th>
				<th class="sb-ecom-basket-product-title"><span>Product</span></th>
				<th class="sb-ecom-basket-product-quantity"><span>Quantity</span></th>
				<th class="sb-ecom-basket-product-cost"><span>Cost</span></th>
				<th class="sb-ecom-basket-product-tax"><span>Tax</span></th>
				<th class="sb-ecom-basket-product-remove"><span>Remove</span></th>
			</tr>
		</thead>
		<tbody>
	<?php $i = 0; foreach($basket->getBasketProducts() as $basketProduct): ?>
			<?php $image = sbEcomProductTable::getFirstImage($basketProduct->getEcomProduct()); ?>
			<?php
			if($image instanceof aMediaItem)
			{
				$options = array('flexHeight' => false, 'resizeType' => 'c');
				$thumbs = sfConfig::get('app_sbEcom_pop_up_thumbs', array('width' => 143, 'height' => 143));
				$dimensionsThumbs = aDimensions::constrain(
														$image->width, 
														$image->height,
														$image->format, 
														array("width" => $thumbs['width'],
															"height" => $options['flexHeight'] ? false : $thumbs['height'],
															"resizeType" => $options['resizeType']));
				$image = '<a href="' . url_for('@sb_ecom_product?slug=' . $basketProduct->getEcomProduct()->getSlug()) . '"><img class="shadow" src="' . $image->getScaledUrl(array('width' => $dimensionsThumbs['width'], 'height' => $dimensionsThumbs['height'], 'resizeType' => 'c')) . '" /></a>';
			}
			else
			{
				$image = '';
			}
			?>
			<tr class="<?php if(is_int($i / 2)) { echo "first"; } else { echo "second"; } ?>">
				<td class="sb-ecom-basket-product-image"><?php echo $image; ?></td>
				<td class="sb-ecom-basket-product-title">
					<p class="title"><a href="<?php echo url_for('@sb_ecom_product?slug=' . $basketProduct->getEcomProduct()->getSlug()); ?>"><?php echo $basketProduct->getEcomProduct()->getTitle(); ?></a></p>
					<p class="subtitle"><?php echo $basketProduct->getEcomProduct()->getLongTitle(); ?></p>
				</td>
				<td class="sb-ecom-basket-product-quantity a-ui">
					<a class="a-btn" href="<?php echo url_for('@sb_ecom_basket_action?action=subtract&product=' . $basketProduct->getEcomProduct()->getId()); ?>"><span>-</span></a>
					<span class="sb-ecom-basket-product-quantity-value"><?php echo $basketProduct->getQuantity(); ?></span>
					<a class="a-btn" href="<?php echo url_for('@sb_ecom_basket_action?action=plus&product=' . $basketProduct->getEcomProduct()->getId()); ?>"><span>+</span></a>
				</td>
				<td class="sb-ecom-basket-product-cost sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basketProduct->getCost()); ?></td>
				<td class="sb-ecom-basket-product-tax sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basketProduct->getTax()); ?></td>
				<td class="sb-ecom-basket-product-remove a-ui"><a class="a-btn icon no-label a-delete alt" href="<?php echo url_for('@sb_ecom_basket_action?action=delete&product=' . $basketProduct->getEcomProduct()->getId()); ?>"><span class="icon"></span>Delete</a>
			</tr>
	<?php $i++; endforeach; ?>
			<tr class="sb-ecom-divider">
				<td colspan="6"><hr/></td>
			</tr>
			<tr class="sb-ecom-basket-total-cost">
				<td></td>
				<td colspan="3" class="sb-ecom-total-title">Total Cost (Exc. Tax)</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getCost()); ?></td>
			</tr>
			<tr class="sb-ecom-basket-total-tax">
				<td></td>
				<td colspan="3" class="sb-ecom-total-title">Total Tax</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getTax()); ?></td>
			</tr>
			<tr class="sb-ecom-basket-total-total">
				<td></td>
				<td colspan="3" class="sb-ecom-total-title">Total</td>
				<td colspan="2" class="sb-ecom-cost"><?php echo sbEcomToolkit::costFormat($basket->getTotal()); ?></td>
			</tr>
		</tbody>
	</table>
	<p class="sb-ecom-checkout-link a-ui"><a class="a-btn" href="<?php echo url_for('@sb_ecom_checkout'); ?>">Proceed to Checkout</a></p>
<?php else: ?>
	<p class="sb-ecom-empty-basket-message a-ui">You haven't added any products to your basket yet.</p>
	<p class="sb-ecom-empty-basket-button a-ui"><a class="a-btn" href="<?php echo url_for('@sb_ecom_index'); ?>">Return to the shop</a></p>
<?php endif; ?>	
</div>

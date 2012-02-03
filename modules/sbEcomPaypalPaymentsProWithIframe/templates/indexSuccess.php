<?php slot('body_class') ?>sb-ecom <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav', ''); ?>

<div id="sb-ecom-main-basket" class="sb-ecom-main clearfix">
	
	<h1 class="sb-ecom-checkout-title">Checkout</h1>
	<h2 class="sb-ecom-checkout-subtitle">Step 2 of 2</h2>
	
	<?php include_component('sbEcomBasket', 'BasketSummaryExpanded'); ?>
	
	<p>PAYPAL IFRAME HERE</p>
	
</div>


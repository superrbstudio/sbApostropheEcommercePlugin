<?php slot('body_class') ?>sb-ecom <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav', ''); ?>

<div id="sb-ecom-main-basket" class="sb-ecom-main clearfix">
	
	<h1 class="sb-ecom-checkout-title">Checkout</h1>
	<h2 class="sb-ecom-checkout-subtitle">Step 2 of 2</h2>
	
	<?php include_component('sbEcomBasket', 'BasketSummaryExpanded'); ?>
	
	<h3 class="sb-ecom-checkout-subtitle">Payment Details</h3>
	<p class="sb-ecom-checkout-return-to-checkout"><a href="<?php echo url_for('@sb_ecom_checkout'); ?>">Return to Contact/Address Details</a><p>
    
  <form action="https://www.paypal.com/cgi-bin/webscr" method="post" />
    <input type="hidden" name="cmd" value="_xclick" />
    <input type="hidden" name="upload" value="1">
    <input type="hidden" name="business" value="giles@superrb.com" />
    <input type="hidden" name="item_name" value="<?php echo sfConfig::get('app_sbApostropheEcommerce_item_name'); ?> - Checkout ID #<?php echo $checkout->getId(); ?>" />
    <input type="hidden" name="currency_code" value="<?php echo sfConfig::get('app_sbApostropheEcommerce_currency_code'); ?>" />
    <input type="hidden" name="amount" value="<?php echo round($checkout->getCost(), 2); ?>" />
    <input type="hidden" name="shipping" value="<?php echo round($checkout->getPostage(), 2); ?>" />
    <input type="hidden" name="tax" value="<?php echo round($checkout->getTax() + $checkout->getPostageTax(), 2); ?>" />
    <input type="hidden" name="return" value="<?php echo $baseUrl; ?><?php echo url_for('@sb_ecom_paypal_standard_thanks'); ?>" />
    <input type="hidden" name="notify_url" value="<?php echo $baseUrl; ?><?php echo url_for('@sb_ecom_paypal_standard_notify?id=' . $checkout->getId()); ?>" />
    
    <input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but01.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" />
  </form>
	
</div>


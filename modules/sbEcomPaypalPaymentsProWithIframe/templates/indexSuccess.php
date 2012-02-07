<?php slot('body_class') ?>sb-ecom <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav', ''); ?>

<div id="sb-ecom-main-basket" class="sb-ecom-main clearfix">
	
	<h1 class="sb-ecom-checkout-title">Checkout</h1>
	<h2 class="sb-ecom-checkout-subtitle">Step 2 of 2</h2>
	
	<?php include_component('sbEcomBasket', 'BasketSummaryExpanded'); ?>
	
	<h3 class="sb-ecom-checkout-subtitle">Payment Details</h3>
	<p class="sb-ecom-checkout-return-to-checkout"><a href="<?php echo url_for('@sb_ecom_checkout'); ?>">Return to Contact/Address Details</a><p>
	<iframe id="paypalIframe" name="hss_iframe" width="600px" height="600px"></iframe>
	
	<form style="display:none" target="hss_iframe" name="form_iframe" method="post" action="<?php echo sfConfig::get('app_sbApostropheEcommerce_gateway_url'); ?>">
		<input type="hidden" name="cmd" value="_hosted-payment" />
		<input type="hidden" name="subtotal" value="<?php echo $checkout->getCost(); ?>" />
		<input type="hidden" name="shipping" value="<?php echo $checkout->getPostage(); ?>" />
		<input type="hidden" name="tax" value="<?php echo $checkout->getTax(); ?>" />
		<input type="hidden" name="business" value="<?php echo sfConfig::get('app_sbApostropheEcommerce_merchant_id'); ?>" />
		<input type="hidden" name="currency_code" value="<?php echo sfConfig::get('app_sbApostropheEcommerce_currency_code'); ?>" />
		<input type="hidden" name="paymentaction" value="sale" />
		<input type="hidden" name="template" value="templateD" />
		<input type="hidden" name="return" value="<?php echo $baseUrl; ?><?php echo url_for('@sb_ecom_checkout_action?action=thanks'); ?>" />
		<input type="hidden" name="notify_url" value="<?php echo $baseUrl; ?><?php echo url_for('@sb_ecom_paypal_payments_pro_with_iframe_notify?id=' . $checkout->getId()); ?>" />
		
		<input type="hidden" name="address1" value="<?php echo $checkout->getDeliveryStreetAddress(); ?>" />
		<input type="hidden" name="address2" value="<?php echo $checkout->getDeliveryPostOfficeBoxNumber();?>" />
		<input type="hidden" name="city" value="<?php echo $checkout->getDeliveryLocality(); ?>" />
		<input type="hidden" name="state" value="<?php echo $checkout->getDeliveryRegion(); ?>" />
		<input type="hidden" name="zip" value="<?php echo $checkout->getDeliveryPostalCode(); ?>" />
		<input type="hidden" name="country" value="<?php echo $checkout->getDeliveryCountry(); ?>" />
		<input type="hidden" name="first_name" value="<?php echo $checkout->getContactFirstname(); ?>" />
		<input type="hidden" name="last_name" value="<?php echo $checkout->getContactLastname(); ?>" />
		<input type="hidden" name="billing_address1" value="<?php echo $checkout->getBillingStreetAddress(); ?>" />
		<input type="hidden" name="billing_address2" value="<?php echo $checkout->getBillingPostOfficeBoxNumber();?>" />
		<input type="hidden" name="billing_city" value="<?php echo $checkout->getBillingLocality(); ?>" />
		<input type="hidden" name="billing_state" value="<?php echo $checkout->getBillingRegion(); ?>" />
		<input type="hidden" name="billing_zip" value="<?php echo $checkout->getBillingPostalCode(); ?>" />
		<input type="hidden" name="billing_country" value="<?php echo $checkout->getBillingCountry(); ?>" />
		<input type="hidden" name="billing_first_name" value="<?php echo $checkout->getContactFirstname(); ?>" />
		<input type="hidden" name="billing_last_name" value="<?php echo $checkout->getContactLastname(); ?>" />
		
		<input type="hidden" name="buyer_email" value="<?php echo $checkout->getContactEmail(); ?>" />
		
	</form>
	<script type="text/javascript">
		document.form_iframe.submit();
	</script>
	
</div>


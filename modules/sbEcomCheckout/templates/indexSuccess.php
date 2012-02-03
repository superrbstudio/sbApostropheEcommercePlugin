<?php slot('body_class') ?>sb-ecom <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav', ''); ?>

<div id="sb-ecom-main-basket" class="sb-ecom-main clearfix">
	
	<h1 class="sb-ecom-checkout-title">Checkout</h1>
	<h2 class="sb-ecom-checkout-subtitle">Step 1 of 2</h2>

<?php if($basket->getNumProducts() > 0) : ?>
	
	<?php include_component('sbEcomBasket', 'BasketSummaryExpanded'); ?>
	
	<form action="<?php echo url_for('@sb_ecom_checkout_action?action=process'); ?>" method="post">
		
		<div class="sb-ecom-checkout-form">
			<?php echo $form->renderHiddenFields(); ?>

			<?php if($form->hasErrors()): ?>
				<?php echo $form->renderGlobalErrors(); ?>
			<?php endif; ?>

			<fieldset class="sb-ecom-checkout-group">
				<legend>Your details</legend>

				<label class="sb-ecom-checkout-label"><?php echo $form['contact_title']->renderLabel(); ?></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['contact_title']->render(); ?>
					<?php if($form['contact_title']->hasError()): ?>
						<?php echo $form['contact_title']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['contact_firstname']->renderLabel(); ?><span class="required">*</span></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['contact_firstname']->render(); ?>
					<?php if($form['contact_firstname']->hasError()): ?>
						<?php echo $form['contact_firstname']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['contact_lastname']->renderLabel(); ?><span class="required">*</span></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['contact_lastname']->render(); ?>
					<?php if($form['contact_lastname']->hasError()): ?>
						<?php echo $form['contact_lastname']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['contact_email']->renderLabel(); ?><span class="required">*</span></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['contact_email']->render(); ?>
					<?php if($form['contact_email']->hasError()): ?>
						<?php echo $form['contact_email']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['contact_telephone']->renderLabel(); ?><span class="required">*</span></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['contact_telephone']->render(); ?>
					<?php if($form['contact_telephone']->hasError()): ?>
						<?php echo $form['contact_telephone']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['contact_mobile']->renderLabel(); ?></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['contact_mobile']->render(); ?>
					<?php if($form['contact_mobile']->hasError()): ?>
						<?php echo $form['contact_mobile']->renderError(); ?>
					<?php endif; ?>
				</div>

			</fieldset>

			<hr/>

			<fieldset class="sb-ecom-checkout-group">
				<legend>Delivery address</legend>

				<label class="sb-ecom-checkout-label"><?php echo $form['delivery_street_address']->renderLabel(); ?><span class="required">*</span></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['delivery_street_address']->render(); ?>
					<?php if($form['delivery_street_address']->hasError()): ?>
						<?php echo $form['delivery_street_address']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['delivery_post_office_box_number']->renderLabel(); ?></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['delivery_post_office_box_number']->render(); ?>
					<?php if($form['delivery_post_office_box_number']->hasError()): ?>
						<?php echo $form['delivery_post_office_box_number']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['delivery_locality']->renderLabel(); ?></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['delivery_locality']->render(); ?>
					<?php if($form['delivery_locality']->hasError()): ?>
						<?php echo $form['delivery_locality']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['delivery_region']->renderLabel(); ?><span class="required">*</span></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['delivery_region']->render(); ?>
					<?php if($form['delivery_region']->hasError()): ?>
						<?php echo $form['delivery_region']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['delivery_postal_code']->renderLabel(); ?><span class="required">*</span></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['delivery_postal_code']->render(); ?>
					<?php if($form['delivery_postal_code']->hasError()): ?>
						<?php echo $form['delivery_postal_code']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['delivery_country']->renderLabel(); ?><span class="required">*</span></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['delivery_country']->render(); ?>
					<?php if($form['delivery_country']->hasError()): ?>
						<?php echo $form['delivery_country']->renderError(); ?>
					<?php endif; ?>
				</div>

			</fieldset>

			<hr/>

			<fieldset class="sb-ecom-checkout-group">
				<legend>Billing address</legend>

				<label class="sb-ecom-checkout-label"><?php echo $form['billing_street_address']->renderLabel(); ?><span class="required">*</span></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['billing_street_address']->render(); ?>
					<?php if($form['billing_street_address']->hasError()): ?>
						<?php echo $form['billing_street_address']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['billing_post_office_box_number']->renderLabel(); ?></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['billing_post_office_box_number']->render(); ?>
					<?php if($form['billing_post_office_box_number']->hasError()): ?>
						<?php echo $form['billing_post_office_box_number']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['billing_locality']->renderLabel(); ?></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['billing_locality']->render(); ?>
					<?php if($form['billing_locality']->hasError()): ?>
						<?php echo $form['billing_locality']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['billing_region']->renderLabel(); ?><span class="required">*</span></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['billing_region']->render(); ?>
					<?php if($form['billing_region']->hasError()): ?>
						<?php echo $form['billing_region']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['billing_postal_code']->renderLabel(); ?><span class="required">*</span></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['billing_postal_code']->render(); ?>
					<?php if($form['billing_postal_code']->hasError()): ?>
						<?php echo $form['billing_postal_code']->renderError(); ?>
					<?php endif; ?>
				</div>

				<label class="sb-ecom-checkout-label"><?php echo $form['billing_country']->renderLabel(); ?><span class="required">*</span></label>
				<div class="sb-ecom-checkout-input">
					<?php echo $form['billing_country']->render(); ?>
					<?php if($form['billing_country']->hasError()): ?>
						<?php echo $form['billing_country']->renderError(); ?>
					<?php endif; ?>
				</div>

			</fieldset>
		
		</div>
		
		<p class="sb-ecom-checkout-link a-ui"><input class="a-btn" type="submit" value="Proceed to Payment" /></p>
	</form>
<?php else: ?>
	<p class="sb-ecom-empty-basket-message a-ui">You haven't added any products to your basket yet.</p>
<?php endif; ?>	

</div>
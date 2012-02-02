<?php slot('body_class') ?>sb-ecom <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav', ''); ?>

<?php if ($validCheckout): ?>
	<p>Checkout payment to process: <?php echo $checkout->getId(); ?></p>
<?php else: ?>
	<p>No Checkout to process</p>
<?php endif; ?>


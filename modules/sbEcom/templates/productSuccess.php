
<?php slot('body_class') ?>sb-ecom <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav') ?>
	<div class="a-ui a-subnav-wrapper ecom clearfix">
		<div class="a-subnav-inner">
	    <?php include_component('sbEcom', 'sidebar') ?>
	  </div> 
	</div>
<?php end_slot() ?>

<div id="sb-ecom-main" class="sb-ecom-main clearfix">
	
	<h3>This is the product detail page</h3>
	
</div>

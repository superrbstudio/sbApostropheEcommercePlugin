
<?php slot('body_class') ?>sb-ecom <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav') ?>
	<div class="a-ui a-subnav-wrapper ecom clearfix">
		<div class="a-subnav-inner">
	    <?php include_component('sbEcom', 'sidebar') ?>
	  </div> 
	</div>
<?php end_slot() ?>

<div id="sb-ecom-main" class="sb-ecom-main clearfix">

	<div class="sb-ecom-featured-products-group">
		<?php echo a_slot('ecom-featured-products', 'aRichText'); ?>
		<?php if(count($featuredProducts) > 0): ?>
		<?php $counter = 1; ?>
		<ul class="ecom-featured-products clearfix">
			<?php foreach($featuredProducts as $product): ?>
				<?php if(is_integer($counter / 3)) { $class = 'end'; } else { $class = 'standard'; } ?>
			<li class="<?php echo $class; ?>"><?php include_partial('sbEcom/productExcerpt', array('product' => $product)); ?></li>
			<?php $counter ++;	endforeach; ?>
		</ul>
		<?php endif; ?>
	</div>

	
	<div class="sb-ecom-product-categories-group">
		<?php echo a_slot('ecom-product-categories', 'aRichText'); ?>
		<?php if(count($categories) > 0): ?>
		<?php $counter = 1; ?>
		<ul class="ecom-product-categories clearfix"">
			<?php foreach($categories as $category): ?>
				<?php if(is_integer($counter / 2)) { $class = 'end'; } else { $class = 'standard'; } ?>
			<li class="<?php echo $class; ?>"><?php include_partial('sbEcom/categoryExcerpt', array('category' => $category)); ?></li>
			<?php $counter++;	endforeach; ?>
		</ul>
		<?php endif; ?>
	</div>

</div>
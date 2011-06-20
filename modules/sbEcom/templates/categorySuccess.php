<?php
$categories = isset($categories) ? $sf_data->getRaw('categories') : null;
$pager = isset($pager) ? $sf_data->getRaw('pager') : null;
$params = isset($params) ? $sf_data->getRaw('params') : null;
?>

<?php slot('body_class') ?>sb-ecom <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav') ?>
	<div class="a-ui a-subnav-wrapper ecom clearfix">
		<div class="a-subnav-inner">
	    <?php include_component('sbEcom', 'sidebar', array('params' => $params, 'categories' => $categories)) ?>
	  </div> 
	</div>
<?php end_slot() ?>

<div id="sb-ecom-main" class="sb-ecom-main clearfix">	
	
	<?php a_slot('ecom-category-detail', 'aRichText'); ?>
	<?php if(count($products) > 0): ?>
	<ul class="ecom-category-product-list">
		<?php foreach($products as $product): ?>
		<li><?php include_partial('sbEcom/productExcerpt', array('product' => $product)); ?></li>
		<?php endforeach; ?>
	</ul>
	<?php endif; ?>
</div>

<?php
$categories = isset($categories) ? $sf_data->getRaw('categories') : null;
$params = isset($params) ? $sf_data->getRaw('params') : null;
?>

<?php slot('body_class') ?>sb-ecom <?php echo $sf_params->get('module'); ?> <?php echo $sf_params->get('action') ?><?php end_slot() ?>

<?php slot('a-subnav', '') ?>

<div id="sb-ecom-product" class="sb-ecom-product clearfix">
	
	<h1><?php echo $product->getTitle(); ?></h1>
	<ul>
		<li>Cost: <?php echo $product->getCost(); ?></li>
		<li>Tax: <?php echo $product->getTax(); ?></li>
	</ul>
	
	<?php a_area('blog-body', array(
	  'toolbar' => 'basic', 'slug' => url_for('@sb_ecom_product?slug=' . $product['slug']),
	  'allowed_types' => array('aRichText', 'aSlideshow', 'aVideo', 'aPDF'),
	  'type_options' => array(
	    'aRichText' => array('tool' => 'Main'),   
	    'aSlideshow' => array("width" => 480, 'flexHeight' => true, 'constraints' => array('minimum-width' => 480)),
			'aVideo' => array('width' => 480, 'flexHeight' => true, 'resizeType' => 's'), 
			'aPDF' => array('width' => 480, 'flexHeight' => true, 'resizeType' => 's'),
	))) ?>
	
</div>

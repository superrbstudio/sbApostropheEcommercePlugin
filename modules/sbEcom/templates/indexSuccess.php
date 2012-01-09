<?php use_helper('a') ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','sb-ecom-index') ?>

<?php $categoryTypes = sfConfig::get('app_sbEcom_category_types', array('none' => 'No Type')); ?>

<?php slot('a-tabs', ''); ?>
<?php slot('a-breadcrumb', '') ?>
<?php slot('a-subnav', '') ?>
<?php slot('a-page-header', ''); ?>
<?php slot('a-subnav', ''); ?>

<?php foreach($categoryTypes as $key => $type): ?>
	<?php if(isset($categories[$key]) and count($categories[$key]) > 0): ?>
	<h1><?php if($key == 'none'): ?>All<?php else: echo $categoryTypes[$key]; endif; ?></h1>
	<?php include_partial('sbEcom/categoriesList', array('categories' => $categories[$key])); ?>
	<?php endif; ?>
<?php endforeach; ?>
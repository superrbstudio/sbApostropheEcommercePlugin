<?php use_helper('a') ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','sb-ecom-product') ?>

<?php include_component('a', 'standardArea', array('name' => 'body', 'width' => 480, 'toolbar' => 'Main', 'slots' => sbEcomToolkit::productAreaSlots())) ?>

<?php include_component('a', 'standardArea', array('name' => 'sidebar', 'width' => 200, 'toolbar' => 'Sidebar')) ?>

<?php slot('a-footer') ?>
<div class='a-footer-wrapper clearfix'>
	<div class='a-footer clearfix'>
	  <?php include_partial('a/footer') ?>
		<?php include_partial('aFeedback/feedbackForm'); ?>	
	</div>
</div>
<?php end_slot() ?>
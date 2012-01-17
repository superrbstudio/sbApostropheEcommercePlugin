<?php use_helper('a') ?>

<?php // Defining the <body> class ?>
<?php slot('a-body-class','sb-ecom-category') ?>

<?php // The a/standardArea component is an easy way to pull in the usual list of great content slots. ?>
<?php // You don't have to limit yourself to it, see a_area and a_slot in the documentation ?>
<?php // http://trac.apostrophenow.org/wiki/ManualDesignersGuide#areas ?>
<?php // http://trac.apostrophenow.org/wiki/ManualDesignersGuide#slots ?>

<?php include_component('a', 'standardArea', array('name' => 'body', 'width' => 480, 'toolbar' => 'Main')) ?>

<?php include_component('a', 'standardArea', array('name' => 'sidebar', 'width' => 200, 'toolbar' => 'Sidebar')) ?>


<?php slot('a-footer') ?>
<div class='a-footer-wrapper clearfix'>
	<div class='a-footer clearfix'>
	  <?php include_partial('a/footer') ?>
		<?php include_partial('aFeedback/feedbackForm'); ?>	
	</div>
</div>
<?php end_slot() ?>
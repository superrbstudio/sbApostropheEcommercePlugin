<form action="<?php echo url_for('@sb_ecom_search'); ?>" method="get">
	<?php echo $form->renderHiddenFields(); ?>
	<?php echo $form['s']->render(); ?>
	<input type="submit" value="Search" />
</form>

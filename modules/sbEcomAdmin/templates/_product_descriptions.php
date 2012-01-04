<div class="a-form-row a-admin-text a-admin-form-field-Locations">
	<div class="a-help">These are used to create sections of descriptions such as a tabbed info box on the product page.</div>
	
	<div class="a-form-field">
		<table class="sb-ecom-product-description">
			<tbody>
				<?php $i = 1; foreach($form['Descriptions'] as $description): ?>
					<?php include_partial('sbEcomAdmin/product_descriptions_tablerow', array('count' => $i, 'description' => $description, 'class' => '')); ?>
				<?php $i++; endforeach; ?>

				<?php foreach($form['newDescriptions'] as $description): ?>
					<?php include_partial('sbEcomAdmin/product_descriptions_tablerow', array('count' => $i, 'description' => $description, 'class' => 'new')); ?>
				<?php $i++; endforeach; ?>

			</tbody>
		</table>
		<a href="#" title="Add new description" class="sb-ecom-product-description-add a-btn">Add another description</a>
	</div>

</div>

<?php a_js_call('sbEcomProductSetUpDescriptions()'); ?>
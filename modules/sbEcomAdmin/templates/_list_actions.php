<li class="a-admin-action-new">
    <?php echo link_to(a_('<span class="icon"></span>New Product', array(), 'messages'), 'sbEcomAdmin/new', array(  'class' => 'a-btn big icon a-add sb-ecom-new-product',)) ?>  
		<div class="a-ui a-options sb-ecom-admin-new-ajax dropshadow">
			<?php include_component('sbEcomAdmin', 'newProduct') ?>
		</div>
</li>
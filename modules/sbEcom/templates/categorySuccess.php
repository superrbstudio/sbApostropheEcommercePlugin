<?php a_slot('ecom-category-detail', 'aRichText'); ?>
<?php if(count($products) > 0): ?>
<ul class="ecom-category-product-list">
	<?php foreach($products as $product): ?>
	<li><?php include_partial('sbEcom/productExcerpt', array('product' => $product)); ?></li>
	<?php endforeach; ?>
</ul>
<?php endif; ?>

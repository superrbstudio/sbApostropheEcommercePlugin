<?php echo a_slot('ecom-featured-products', 'aRichText'); ?>
<?php if(count($featuredProducts) > 0): ?>
<ul class="ecom-featured-products">
	<?php foreach($featuredProducts as $product): ?>
	<li><?php include_partial('sbEcom/productExcerpt', array('product' => $product)); ?></li>
	<?php	endforeach; ?>
</ul>
<?php endif; ?>


<?php echo a_slot('ecom-product-categories', 'aRichText'); ?>
<?php if(count($categories) > 0): ?>
<ul class="ecom-product-categories"">
	<?php foreach($categories as $category): ?>
	<li><?php include_partial('sbEcom/categoryExcerpt', array('category' => $category)); ?></li>
	<?php	endforeach; ?>
</ul>
<?php endif; ?>
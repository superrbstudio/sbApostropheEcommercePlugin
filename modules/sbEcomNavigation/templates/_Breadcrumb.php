<?php
  // Compatible with sf_escaping_strategy: true
  $active = isset($active) ? $sf_data->getRaw('active') : null;
  $class = isset($class) ? $sf_data->getRaw('class') : null;
  $draggable = isset($draggable) ? $sf_data->getRaw('draggable') : null;
  $name = isset($name) ? $sf_data->getRaw('name') : null;
  $nav = isset($nav) ? $sf_data->getRaw('nav') : null;
  $separator = isset($separator) ? $sf_data->getRaw('separator') : null;
	$category = isset($category) ? $sf_data->getRaw('category') : null;
	$product = isset($product) ? $sf_data->getRaw('product') : null;
?>
<?php // Some weirdness going on with the class names for the breadcrumb. I updated this to have the correct class name format .a-nav-$name 
      // But I also left in the old stuff for compat.
 ?>
<ul id="a-breadcrumb-<?php echo ($name)? $name:'component' ?>" class="a-nav a-nav-breadcrumb a-nav-<?php echo ($name)? $name:'component' ?> a-breadcrumb-<?php echo ($name)? $name:'component' ?> breadcrumb clearfix">
	<?php foreach($nav as $pos => $item): ?>
		<?php if (!$item['archived'] || $draggable): ?>
			<li class="<?php echo $class;
				if($item['slug'] == $active) echo ' a-current-page'; ?>"><?php echo link_to($item['title'], aTools::urlForPage($item['slug'])) ?>
					<?php if($pos+1 < count($nav) or !is_null($category)) echo '<span class="a-breadcrumb-separator">'.$separator.'</span>' ?>
			</li>
		<?php endif ?>		
	<?php endforeach ?>
	<?php if(!is_null($category)): ?>
			<li class="sb-ecom-product-category <?php echo $category['slug']; ?>">
				<a href="<?php echo url_for('@sb_ecom_categories?cat=' . $category['slug']); ?>"><?php echo $category['name']; ?></a>
				<?php if(!is_null($product)) { ?><span class="a-breadcrumb-separator"><?php echo $separator; ?></span><?php } ?>
			</li>
	<?php endif; ?>
	<?php if(!is_null($product)): ?>
			<li class="sb-ecom-product <?php echo $product['slug']; ?>">
				<a href="<?php echo url_for('@sb_ecom_product?slug=' . $product['slug']); ?>"><?php echo $product['title']; ?></a>
			</li>
	<?php endif; ?>
</ul>
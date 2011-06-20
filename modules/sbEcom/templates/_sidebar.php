<?php
  // Compatible with sf_escaping_strategy: true
  $categories = isset($categories) ? $sf_data->getRaw('categories') : null;
  $params = isset($params) ? $sf_data->getRaw('params') : null;
	$selected = array('icon','a-selected'); // Class names for selected filters
?>

<?php if(count($categories) > 1): ?>
<hr class="a-hr" />
<div class="a-subnav-section categories">
  <h4><?php echo a_('Categories') ?></h4>
  <div class="a-filter-options blog clearfix">
	  <?php foreach ($categories as $category): ?>
	    <div class="a-filter-option">
				<?php if ($category['slug'] == $sf_params->get('cat')) : ?>
					<?php echo a_button($category['name'], url_for(aUrl::addParams('@sb_ecom_index', array('tag' => $sf_params->get('tag'), 'q' => $sf_params->get('q')))), array_merge(array('a-link'),$selected)); ?> 
				<?php else: ?>
				  <?php echo a_button($category['name'], url_for(aUrl::addParams('@sb_ecom_categories', array('cat' => $category['slug'], 'tag' => $sf_params->get('tag'), 'q' => $sf_params->get('q')))), array('a-link')); ?> 
				<?php endif; ?>
			</div>
	  <?php endforeach ?>
  </div>	
</div>
<?php endif ?>


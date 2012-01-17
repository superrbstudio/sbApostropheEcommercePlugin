<?php use_helper('a') ?>

<?php include_partial('a/simpleEditWithVariants', array('pageid' => $pageid, 'name' => $name, 'permid' => $permid, 'slot' => $slot)) ?>
<?php if (isset($values['text'])): ?>
  <h4><?php echo htmlspecialchars($values['text']) ?></h4>
<?php endif ?>
	<div class="sb-ecom-add-to-basket">
		<?php if (isset($values['title'])): ?><h4><?php echo htmlspecialchars($values['title']); ?></h4><?php endif; ?>
		<?php if (isset($values['reference'])): ?><h5><?php echo htmlspecialchars($values['reference']); ?></h5><?php endif; ?>
		<?php if (isset($values['cost'])): ?><span class="sb-ecom-add-to-basket-cost"><?php echo sbEcomToolkit::costFormat($values['cost']); ?></span><?php endif; ?>
	</div>

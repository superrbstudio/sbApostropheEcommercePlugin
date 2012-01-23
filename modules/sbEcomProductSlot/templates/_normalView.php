<?php use_helper('a') ?>

<?php if ($editable): ?>
<?php include_partial('a/simpleEditWithVariants', array('pageid' => $pageid, 'name' => $name, 'permid' => $permid, 'slot' => $slot)) ?>
<?php endif; ?>

<?php if (!is_null($product)): ?>
  <h4><a href="<?php echo url_for($product['slug']); ?>"><?php echo htmlspecialchars($product['title']) ?></a></h4>
<?php endif ?>

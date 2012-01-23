<?php use_helper('a') ?>

<?php include_partial('a/simpleEditWithVariants', array('pageid' => $pageid, 'name' => $name, 'permid' => $permid, 'slot' => $slot)) ?>
<?php if (isset($values['text'])): ?>
  <h4><?php echo htmlspecialchars($values['text']) ?></h4>
<?php endif ?>

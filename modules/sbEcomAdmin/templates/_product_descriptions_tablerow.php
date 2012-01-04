<?php $values = $description->getValue(); ?>
<tr class="description-row row-<?php echo $count; ?> <?php echo $class; ?>">
	<td class="title"><?php echo $description['title']->render(); ?></td>
	<td class="description"><?php echo $description['description']->render(); ?></td>
	<td class="actions">
		<a class="a-btn icon no-label a-delete alt" href="#" class="sb-promotion-location-delete" data-delete-row="row-<?php echo $count; ?>" <?php if(!is_null($values['id'])): ?>data-delete-description="<?php echo $values['id']; ?>"<?php endif; ?>><span class="icon"></span>Delete</a>
	</td>
</tr>
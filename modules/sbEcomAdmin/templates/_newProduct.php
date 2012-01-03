<?php use_helper("a") ?>
<form class="sb-ecom-admin-new-form" method="post" action="<?php echo url_for('sbEcomAdmin/newWithTitle') ?>">
	<div class="a-form-row a-hidden">
		<?php echo $form->renderHiddenFields() ?>
	</div>
	<div class="a-form-row title">
		<div class="a-form-field">
			  <?php echo $form['title']->render(array('class' => 'big')) ?>
		</div>
			  <?php echo $form['title']->renderError() ?>		
	</div>
  <div class="a-form-row">
    <ul class="a-ui a-controls">
      <li><?php echo a_anchor_submit_button(a_('Create'), array('a-show-busy')) ?></li>
      <li><?php echo a_js_button(a_('Cancel'), array('icon', 'a-cancel','a-options-cancel', 'alt')) ?></li>
    </ul>
  </div>
</form>
<?php a_js_call('sbEcomAdminEnableNewForm()') ?>
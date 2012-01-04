

function sbEcomAdminEnableNewForm() {
	
	var defaultValue = 'Title';
	var titleInput   = $('#sb_ecom_new_product_title');
	var theForm      = $('.sb-ecom-admin-new-form');
	
	// overide form submit
	theForm.submit(function() {
		sbEcomAdminSubmitNewForm($(this));
		return false;
	});
	
	// capture button click
	$('.sb-ecom-new-product').click(function(){
		$('.a-options.sb-ecom-admin-new-ajax').css('display', 'block');
		titleInput.addClass('a-default-value');
		
		if(titleInput.val() == '') {
			titleInput.val(defaultValue);
		}
		
		return false;
	});
	
	// capture cancel click
	$('.sb-ecom-admin-new-ajax .a-cancel').click(function() {
		$('.sb-ecom-admin-new-ajax').css('display', 'none');
		titleInput.val('');
		return false;
	});
	
	titleInput.focus(function() {
		if(titleInput.val() == defaultValue) {
			titleInput.removeClass('a-default-value');
			titleInput.val('');
		}
	});
	
	titleInput.blur(function() {
		if(titleInput.val() == '') {
			titleInput.addClass('a-default-value');
			titleInput.val(defaultValue);
		}
	});
}

function sbEcomAdminSubmitNewForm(form) {
	$.post(form.attr('action'), form.serialize(), function(data) {
		if(data.status == true) {
			window.location = data.redirect_url;
		} else {
			form.find('.a-act-as-submit').removeClass('a-busy');
			alert('The product title can\'t be empty and must not have been used before');
		}
	});
	return false;
}

function sbEcomProductSetUpDescriptions() {
	setRowColors();
	
	$('.sb-ecom-product-description tr.description-row').each(function() {
		if($(this).hasClass('new') && $(this).find('.sb-ecom-description-title').val() == '') {
			$(this).css('display', 'none');
		}
	});
	
	// Delete Button
	$('.sb-ecom-product-description .a-delete').click(function() {
		var row = $(this).attr('data-delete-row');
		$('.' + row + ' .sb-ecom-description-title').val('');
		$('.' + row).remove();
		setRowColors();
		return false;
	});
	
	// Add Button
	$('.sb-ecom-product-description-add').click(function(){
		var hideAddButton = true;
		$('.sb-ecom-product-description tr.description-row').each(function() {
			if($(this).hasClass('new')) {
				$(this).removeClass('new');
				$(this).css('display', 'table-row');
				hideAddButton = false;
				return false;
			}
		});
		
		if(hideAddButton) {
			$(this).css('display', 'none');
		}
		setRowColors();
		return false;
	})
}

function setRowColors() {
	// Set the colors on the table
	var alternate = true;
	$('.sb-ecom-product-description tr.description-row').each(function() {
		if(alternate) {
			$(this).css('background-color', '#eeeeee');
			alternate = false;
		} else {
			$(this).css('background-color', '#ffffff');
			alternate = true;
		}
	});
}

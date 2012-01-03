

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

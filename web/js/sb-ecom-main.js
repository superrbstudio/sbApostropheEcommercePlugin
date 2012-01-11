

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
	sbEcomSetRowColors();
	sbEcomSetCallToBuySwitch();
	sbEcomSetOutOfStockSwitch();
	sbEcomSetPostageTypeSwitch();
	
	$('#sb_ecom_product_call_to_buy').change(function() {
		sbEcomSetCallToBuySwitch();
		return false;
	});
	
	$('#sb_ecom_product_is_out_of_stock').change(function() {
		sbEcomSetOutOfStockSwitch();
		return false;
	});
	
	$('#sb_ecom_product_postage_weight_or_fixed').change(function() {
		sbEcomSetPostageTypeSwitch();
		return false;
	});
	
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
		sbEcomSetRowColors();
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
		sbEcomSetRowColors();
		return false;
	})
}

function sbEcomSetRowColors() {
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

function sbEcomSetCallToBuySwitch() {
	if ($('#sb_ecom_product_call_to_buy').is(':checked')) {
		$('#sb_ecom_product_cost').val(0);
		$('#sb_ecom_product_tax').val(0);
		$('#sb_ecom_product_cost').attr('disabled', 'disabled');
		$('#sb_ecom_product_tax').attr('disabled', 'disabled');
	} else {
		$('#sb_ecom_product_cost').attr('disabled', '');
		$('#sb_ecom_product_tax').attr('disabled', '');
	}
}

function sbEcomSetOutOfStockSwitch() {
	if($('#sb_ecom_product_is_out_of_stock').is(':checked')) {
		$('#sb_ecom_product_number_in_stock').val(0);
		$('#sb_ecom_product_number_in_stock').attr('disabled', 'disabled');
	} else {
		$('#sb_ecom_product_number_in_stock').attr('disabled', '');
	}
}

function sbEcomSetPostageTypeSwitch() {
	switch($('#sb_ecom_product_postage_weight_or_fixed option:selected').val()) {
		case 'weight':
			$('#sb_ecom_product_postage_weight').attr('disabled', '');
			$('#sb_ecom_product_postage_fixed_cost').attr('disabled', 'disabled');
			$('#sb_ecom_product_postage_fixed_cost').val(0.00);
			
			break;
			
		case 'fixed':
			$('#sb_ecom_product_postage_weight').attr('disabled', 'disabled');
			$('#sb_ecom_product_postage_weight').val(0.00);
			$('#sb_ecom_product_postage_fixed_cost').attr('disabled', '');
			break;
			
		default:
			$('#sb_ecom_product_postage_weight').attr('disabled', 'disabled');
			$('#sb_ecom_product_postage_fixed_cost').attr('disabled', 'disabled');
			$('#sb_ecom_product_postage_weight').val(0.00);
			$('#sb_ecom_product_postage_fixed_cost').val(0.00);
			$('#sb_ecom_product_postage_weight_or_fixed').val('free');
	}
}

function sbEcomRegisterCategoryView() {
	$.cookie('last_category', window.location.pathname);
}

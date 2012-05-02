function sbEcommerceSetupAddToBasketEditSlot(slotId) {
	// get the first selected option
	var selectedOption = $('#' + slotId + '_postage_type option:selected').val();
	
	// if it isnt set set it to free
	if(selectedOption == '' || selectedOption == undefined) { 
		selectedOption = 'free';
		$('#' + slotId + '_postage_type').val(selectedOption);
	}
	
	// set up the form
	setPostageFields(selectedOption);
	
	$('#' + slotId + '_postage_type').change(function() {
		setPostageFields($(this).find('option:selected').val());
	});
	
	function setPostageFields(type) {
		switch(type) {
			case 'fixed':
				$('.a-form-row.' + slotId + '_weight').css('display', 'none');
				$('.a-form-row.' + slotId + '_cost_per_weight').css('display', 'none');
        $('.a-form-row.' + slotId + '_cost_per_weight_with_others').css('display', 'none');
				$('.a-form-row.' + slotId + '_fixed').css('display', 'block');
        $('.a-form-row.' + slotId + '_fixed_with_others').css('display', 'block');
				break;
				
			case 'weight':
				$('.a-form-row.' + slotId + '_weight').css('display', 'block');
				$('.a-form-row.' + slotId + '_cost_per_weight').css('display', 'block');
        $('.a-form-row.' + slotId + '_cost_per_weight_with_others').css('display', 'block');
				$('.a-form-row.' + slotId + '_fixed').css('display', 'none');
        $('.a-form-row.' + slotId + '_fixed_with_others').css('display', 'none');
				break;
				
			default:
				$('.a-form-row.' + slotId + '_weight').css('display', 'none');
				$('.a-form-row.' + slotId + '_cost_per_weight').css('display', 'none');
        $('.a-form-row.' + slotId + '_cost_per_weight_with_others').css('display', 'none');
				$('.a-form-row.' + slotId + '_fixed').css('display', 'none');
        $('.a-form-row.' + slotId + '_fixed_with_others').css('display', 'none');
		}
	}
}
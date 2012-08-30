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

function sbEcommerceSetupAddToBasketEditSlotOptions(slotId) {
  // first get the value of the hidden field and unserialize it
  var slotOptionValues = $('#' + slotId + '_option_value').val();
  var newArray = true;
  var valuesArray;
  var valueRows = new Array();
  
  function createValueRow(value, reference, cost) {
    // get the current number of value rows
    var currentRows = $('#a-' + slotId + ' .option-values-container .value-row').length;
    
    if(cost == null){ cost = 0 }
    
    // create the inputs
    var valueLabel = $('<label>').text('Option Value');
    var valueInput = $('<input>').val(value).attr('type', 'text').attr('name', 'option-value[' + currentRows + '][value]');
    var referenceLabel = $('<label>').text('Reference');
    var referenceInput = $('<input>').val(reference).attr('type', 'text').attr('name', 'option-value[' + currentRows + '][reference]');
    var costLabel = $('<label>').text('Cost Difference');
    var costInput = $('<input>').val(cost).attr('type', 'text').attr('name', 'option-value[' + currentRows + '][cost]');
    
    var valueRow = $('<div>').attr('class', 'value-row a-form-row').append($('<div>').attr('class', 'option-value-value option-value-item clearfix').append(valueLabel).append(valueInput)).append($('<div>').attr('class', 'option-value-reference option-value-item clearfix').append(referenceLabel).append(referenceInput)).append($('<div>').attr('class', 'option-value-cost option-value-item clearfix').append(costLabel).append(costInput));
    $('#a-' + slotId + ' .option-values-container').append(valueRow);
  }
  
  // find current value
  if(slotOptionValues != '') {
    valuesArray = $.parseJSON(slotOptionValues);
    if(valuesArray != null) {
      newArray = false;
    }
  }
  
  if(newArray == true) {
    createValueRow(null, null, null);
  } else {
    $.each(valuesArray, function(key, option) {
      createValueRow(option.value, option.reference, option.cost);
    });
  }
  
  // set up the add a new option value
  $('#a-' + slotId + ' .add-new-option').click(function() {
    createValueRow(null, null, null);
    return false;
  });
}

function sbEcommerceSetUpAddToBasketSlotWithOptionCosting(slotId, costs) {
  var currentCost    = Number($('#' + slotId + ' .sb-ecom-add-to-basket-cost-value .cost-value').text());
  var costsArray = $.parseJSON(costs);
  
  function updateCost() {
    $.each(costsArray, function(value, cost) {
      if($('#' + slotId + ' .sb-ecom-add-basket-option select').val() == value) {
        $('#' + slotId + ' .sb-ecom-add-to-basket-cost-value .cost-value').text(Number(currentCost) + Number(cost));
      }
    }); 
  }
  
  $('#' + slotId + ' .sb-ecom-add-basket-option select').change(function() {
    updateCost();
  });
  
  updateCost();
}
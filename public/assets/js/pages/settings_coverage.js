var settings_coverage	= new settings_coverage();

function settings_coverage()
{
	init();

	function init()
	{
		ready_document();

	}

	function ready_document()
	{
		$(document).ready(function()
		{
			
			create_coverage_plan();
			create_coverage_plan_confirm();
            	create_coverage_plan_submit();

            	coverage_plan_details();
            	coverage_add_item();
            	coverage_add_item_submit();

            	coverage_mark_new_confirm();
            	coverage_mark_new_submit();

		});

	}
	function create_coverage_plan()
	{

		$("body").on('click','.create-coverage-plan',function()
		{
			var modalName       = 'CREATE COVERAGE PLAN';
			var modalClass      = 'coverage-plan';
			var modalLink       = '/settings/coverage/create_plan';
			var modalActionName = 'CREATE PLAN';
			var modalAction     = 'create-coverage-plan-confirm';
			var modalSize       = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
    }
    function create_coverage_plan_confirm()
	{
		$('body').on('click','.create-coverage-plan-confirm',function() 
		{
			if(globals.checking_null_validation(document.getElementById('coverage_plan_name').value,"PLAN NAME")=="")
			{}	
		    	else if(globals.checking_null_validation(document.getElementById('coverage_plan_preexisting').value,"PLAN PREXISTING")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_maximum_benefit').value,"PLAN MBL")=="")
			{}	
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_annual_benefit').value,"PLAN ABL")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_case_handling').value,"PLAN CASE HANDLING")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_age_bracket').value,"PLAN AGE BRACKET")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_mbl_illness').value,"PLAN ILLNESS")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_mbl_year').value,"PLAN MBL/YEAR")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_cari_fee').value,"PLAN CARD FEE")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_hib').value,"PLAN HIB")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_processing_fee').value,"PLAN PROCESSING FEE")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_premium').value,"PLAN PREMIUM")=="")
			{}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to add this plan?';
				var confirmModalAction = 'create-coverage-plan-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);		
				
				serializeData = $('.coverage-plan-form').serialize();
			}
			
		});
	}
	
	function create_coverage_plan_submit()
	{
		$('body').on('click','.create-coverage-plan-submit',function() 
		{
			$('.confirm-modal').remove();
            	$(".coverage-plan-modal-body").html("<div class='coverage-plan-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            	$('.coverage-plan-ajax-loader').show();
            	$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/settings/coverage/create_plan_submit',
				method: "POST",
                	data:serializeData,
                	dataType: 'text',
                	success: function(data)
				{
					setTimeout(function()
					{
						$('.coverage-plan-ajax-loader').hide();
						$('.coverage-plan-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
						$('.coverage-plan-modal-body').html(data);
						$('.coverage-plan-modal-footer').html(successButton);
                    }, 1000);
				}
			});
		});
	}
	function coverage_plan_details()
	{
		$("body").on('click','.coverage-plan-details',function()
		{
			var coverage_plan_id = $(this).data('coverage_plan_id');

			var modalName        = 'COVERAGE PLAN DETAILS';
			var modalClass       = 'coverage-details';
			var modalLink        = '/settings/coverage/plan_details/'+coverage_plan_id;
			var modalActionName  = 'MARK AS NEW';
			var modalAction      = 'coverage-mark-new-confirm';
			if($(this).data('size')=='md')
			{
				var modalSize        = 'modal-md';
			}
			else
			{
				var modalSize        = 'modal-lg';
			}
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
    	}
    	function coverage_add_item()
    	{
    		$("body").on('click','.add-coverage-item',function()
		{
			ajaxData.countThis  = $(this);
			var availment_id    = $(this).data('availment_id');
			var session_name	= $(this).data('name');
			var identifier      = $(this).closest('tr').find('button.remove-row').data('number');
			var modalName 		= 'COVERAGE PLAN PROCEDURE';
			var modalClass      = 'coverage-plan-item';
			var modalLink 		= '/settings/coverage/items/'+availment_id+'/'+session_name+'/'+identifier;
			var modalActionName	= 'ADD PROCEDURE';
			var modalAction 	= 'coverage-item-submit';
			var modalSize 		= 'modal-md';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        	});
        	$(".coverage-plan-item-modal").on("hidden.bs.modal", function()
        	{
		    $(".coverage-plan-item-modal.modal-body").remove();
		});
    	
    	}
    	function coverage_add_item_submit()
    	{
    		$('body').on('click','.coverage-item-submit',function() 
		{
			var datas = new FormData();
			var dates = [];
			$('input[name="coverage_item[]"]:checked').each(function(i, num)
            	{
	            	if($(num).val()!="")
	            	{
	            		dates.push(this.value);

	            		ajaxData.availment_id 		= document.getElementById('availment_id').value;
	            		ajaxData.session_name 		= document.getElementById('session_name').value;
	            		ajaxData.identifier   		= document.getElementById('identifier').value;
	            		ajaxData.plan_charges 		= document.getElementById('plan_charges').value;
	            		ajaxData.plan_covered_amount  = document.getElementById('plan_covered_amount').value;
	            		ajaxData.plan_limit   		= document.getElementById('plan_limit').value;
	               }
            	});
            	ajaxData.countThis.closest('tr').find('input.countThis').val(dates.length+' ITEMS');
            	for (var i = 0; i < dates.length; i++) 
			{
				datas.append('procedure_id[]', 			dates[i]);
			}
			datas.append('availment_id',   		ajaxData.availment_id);
			datas.append('identifier',   	          ajaxData.identifier);
			datas.append('plan_charges', 		     ajaxData.plan_charges);
			datas.append('plan_covered_amount',	ajaxData.plan_covered_amount);
			datas.append('plan_limit',         	ajaxData.plan_limit);
			datas.append('session_name',   		ajaxData.session_name);
			
			globals.global_submit('coverage-plan-item','/settings/coverage/items_submit',datas);
        	});
    	}

    	function coverage_mark_new_confirm()
    	{
    		$("body").on('change','#coverage_plan_name',function()
		{
			$(this).attr('data-ref','new');
		});
    		$("body").on('click','.coverage-mark-new-confirm',function()
		{
			if($('#coverage_plan_name').data('ref')=="old")
			{
				toastr.error(' Please change COVERAGE PLAN NAME or some coverage information.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_name').value,"PLAN NAME")=="")
			{}	
		    	else if(globals.checking_null_validation(document.getElementById('coverage_plan_preexisting').value,"PLAN PREXISTING")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_maximum_benefit').value,"PLAN MBL")=="")
			{}	
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_annual_benefit').value,"PLAN ABL")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_case_handling').value,"PLAN CASE HANDLING")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_age_bracket').value,"PLAN AGE BRACKET")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_mbl_illness').value,"PLAN ILLNESS")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_mbl_year').value,"PLAN MBL/YEAR")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_cari_fee').value,"PLAN CARD FEE")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_hib').value,"PLAN HIB")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_processing_fee').value,"PLAN PROCESSING FEE")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('coverage_plan_premium').value,"PLAN PREMIUM")=="")
			{}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to mark this plan as new?';
				var confirmModalAction = 'coverage-mark-new-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);		
				
                    coverageData.append("coverage_plan_id",                document.getElementById('coverage_plan_id').value);
				coverageData.append("coverage_plan_name",     		document.getElementById('coverage_plan_name').value);
				coverageData.append("coverage_plan_preexisting",     	document.getElementById('coverage_plan_preexisting').value);
				coverageData.append("coverage_plan_maximum_benefit",   document.getElementById('coverage_plan_maximum_benefit').value);
				coverageData.append("coverage_plan_annual_benefit",    document.getElementById('coverage_plan_annual_benefit').value);
				coverageData.append("coverage_plan_case_handling",     document.getElementById('coverage_plan_case_handling').value);
				coverageData.append("coverage_plan_age_bracket",     	document.getElementById('coverage_plan_age_bracket').value);
				coverageData.append("coverage_plan_mbl_illness",     	document.getElementById('coverage_plan_mbl_illness').value);
				coverageData.append("coverage_plan_mbl_year",     	document.getElementById('coverage_plan_mbl_year').value);
				coverageData.append("coverage_plan_cari_fee",     	document.getElementById('coverage_plan_cari_fee').value);
				coverageData.append("coverage_plan_hib",     		document.getElementById('coverage_plan_hib').value);
				coverageData.append("coverage_plan_processing_fee",    document.getElementById('coverage_plan_processing_fee').value);
				coverageData.append("coverage_plan_premium",     		document.getElementById('coverage_plan_premium').value);
			}
		});
    	}
     function coverage_mark_new_submit()
     {
     	$('body').on('click','.coverage-mark-new-submit',function()  
		{
			globals.global_submit('coverage-details','/settings/coverage/mark_new_submit',coverageData);
        	});
     }
	
}






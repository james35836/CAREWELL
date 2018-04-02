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

		});

	}
	function create_coverage_plan()
	{

		$("body").on('click','.create-coverage-plan',function()
		{
			var modalName= 'CREATE COVERAGE PLAN';
			var modalClass='coverage-plan';
			var modalLink='/settings/coverage/create_plan';
			var modalActionName='CREATE PLAN';
			var modalAction='create-coverage-plan-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
    }
    function create_coverage_plan_confirm()
	{
		$('body').on('click','.create-coverage-plan-confirm',function() 
		{
			if(globals.checking_null_validation(document.getElementById('coverage_plan_name').value,"PLAN NAME")=="")
			{}	
		 //    else if(globals.checking_null_validation(document.getElementById('coverage_plan_preexisting').value,"PLAN PREXISTING")=="")
			// {}
			// else if(globals.checking_null_validation(document.getElementById('coverage_plan_maximum_benefit').value,"PLAN MBL")=="")
			// {}	
			// else if(globals.checking_null_validation(document.getElementById('coverage_plan_annual_benefit').value,"PLAN ABL")=="")
			// {}
			// else if(globals.checking_null_validation(document.getElementById('coverage_plan_case_handling').value,"PLAN CASE HANDLING")=="")
			// {}
			// else if(globals.checking_null_validation(document.getElementById('coverage_plan_age_bracket').value,"PLAN AGE BRACKET")=="")
			// {}
			// else if(globals.checking_null_validation(document.getElementById('coverage_plan_mbl_illness').value,"PLAN ILLNESS")=="")
			// {}
			// else if(globals.checking_null_validation(document.getElementById('coverage_plan_mbl_year').value,"PLAN MBL/YEAR")=="")
			// {}
			// else if(globals.checking_null_validation(document.getElementById('coverage_plan_cari_fee').value,"PLAN CARD FEE")=="")
			// {}
			// else if(globals.checking_null_validation(document.getElementById('coverage_plan_hib').value,"PLAN HIB")=="")
			// {}
			// else if(globals.checking_null_validation(document.getElementById('coverage_plan_processing_fee').value,"PLAN PROCESSING FEE")=="")
			// {}
			// else if(globals.checking_null_validation(document.getElementById('coverage_plan_premium').value,"PLAN PREMIUM")=="")
			// {}
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
                data:{data:data},
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
			var modalName= 'COVERAGE PLAN DETAILS';
			var modalClass='coverage-details';
			var modalLink='/settings/coverage/plan_details/'+coverage_plan_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='create-company-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
    }
    function coverage_add_item()
    {
    	$("body").on('click','.add-coverage-item',function()
		{
			var availment_id    = $(this).data('availment_id');
			var modalName 		= 'COVERAGE PLAN PROCEDURE';
			var modalClass 		= 'coverage-plan-item';
			var modalLink 		= '/settings/coverage/items/'+availment_id;
			var modalActionName	= 'ADD PROCEDURE';
			var modalAction 	= 'coverage-item-submit';
			var modalSize 		= 'modal-md';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
        $(".coverage-plan-item-modal").on("hidden.bs.modal", function(){
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
            		ajaxData.availemnt_id = document.getElementById('availment_id').value;

            	}
            });
            alert(dates);
            alert(ajaxData.availemnt_id);
            for (var i = 0; i < dates.length; i++) 
			{
				datas.append('procedure_id[]', 		dates[i]);
				datas.append('availment_id[]',   	ajaxData.availemnt_id);
				datas.append('plan_charges[]', 		document.getElementById('plan_charges').value);
				datas.append('plan_covered_amount[]',document.getElementById('plan_covered_amount').value);
				datas.append('plan_limit[]',         document.getElementById('plan_limit').value);
			}
			
			// coverageData.append('availment_id', 		document.getElementById('availment_id').value);
			// coverageData.append('plan_charges', 		document.getElementById('plan_charges').value);
			// coverageData.append('plan_covered_amount', 	document.getElementById('plan_covered_amount').value);
			// coverageData.append('plan_limit',          	document.getElementById('plan_limit').value);
			globals.global_submit('coverage-plan-item','/settings/coverage/items_submit',datas);
        });
    }
	
}






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
			var	confirmModalMessage = 'Are you sure you want to add this plan?';
			var confirmModalAction = 'create-coverage-plan-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);		
			
			serializeData = $(".coverage-plan-form").serialize();
		});
	}
	
	function create_coverage_plan_submit()
	{
		$(document).on('click','.create-coverage-plan-submit',function() 
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
						$('.coverage-plan-modal-footer').html('<button type="button" class="btn btn-default pull-left " data-dismiss="modal">Close</button>');
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
	
}






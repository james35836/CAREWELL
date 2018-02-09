var settings_coverage	= new settings_coverage();
var formData   			= new FormData();
var ajaxData 			= [];


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
			$('.coverage-plan-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top coverage-plan-modal');
			$('.global-modal-dialog').removeClass().addClass('coverage-plan-modal-dialog modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('CREATE COVERAGE PLAN');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body coverage-plan-modal-body');
			$('.coverage-plan-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            var approval_id = $(this).data('approval_id');

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/settings/coverage/create_plan',
				method: "get",
                success: function(data)
                {
					setTimeout(function()
					{

						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader coverage-plan-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer coverage-plan-modal-footer');
                    	$('.global-footer-button').html('CREATE PLAN').removeClass().addClass('btn btn-primary create-coverage-plan-confirm');
                    }, 1000);
				}
			});
		});
    }
    function create_coverage_plan_confirm()
	{
		$(document).on('click','.create-coverage-plan-confirm',function() 
		{
			$('.confirm-modal').remove();
			$('.append-modal').append(confirmModals);
            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
			$('.confirm-modal-title').html('Are you sure you want to add this plan?');
			$('.confirm-modal').modal('show');
			$('.confirm-submit').addClass('create-coverage-plan-submit');			
			
			serializeData = $(".coverage-plan-form").serialize();
		});
	}
	
	function create_coverage_plan_submit()
	{
		$(document).on('click','.create-coverage-plan-submit',function() 
		{
			$('.confirm-modal').modal('hide');
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
			$('.coverage-details-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top coverage-details-modal');
			$('.global-modal-dialog').removeClass().addClass('coverage-details-modal-dialog modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('CREATE COVERAGE PLAN');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body coverage-details-modal-body');
			$('.coverage-details-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            var coverage_plan_id = $(this).data('coverage_plan_id');

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/settings/coverage/plan_details/'+coverage_plan_id,
				method: "get",
                success: function(data)
                {
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader coverage-details-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer coverage-details-modal-footer');
                    	$('.global-footer-button').html('SAVE CHANGES').removeClass().addClass('btn btn-primary coverage-plan-details-confirm');
                    }, 1000);
				}
			});
		});
	}
	
}






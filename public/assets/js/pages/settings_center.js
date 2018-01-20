var settings_center 	= new settings_center();
var formData   		= new FormData();
var ajaxData 		= [];

function settings_center()
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
			trigger();
			create_plan();
			create_plan_confirm();
            create_plan_submit();
			availment_plan_table_action();
         });

	}
	function trigger()
	{
		
		$(document).on('click','.btn-close-lg',function()
		{
			$('.plan-modal').modal('hide');
			$('.modal-dialog').removeClass('modal-sm');
			$('.modal-dialog').addClass('modal-lg');
			$('.global-submit').removeClass('create-plan-submit');
		});
	}
	
	
	function create_plan()
	{

		$(document).on('click','.create-plan',function() 
		{
			$('.plan-modal').modal('show');
			$('.plan-ajax-loader').show();
			$('.plan-modal-body-content').hide();
			$('.plan-modal-title').html('CREATE PLAN');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/settings/plan/create_plan',
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.plan-ajax-loader').hide();
						$('.plan-modal-body-content').show();
						$('.plan-modal-body-content').html(data);
                    }, 1000);
				}
			});

		});
    }
    function create_plan_confirm()
	{
		$(document).on('click','.plan-confirm',function() 
		{
			$('.confirm-title').html('Are you sure you want to create this PLAN?');
								$('.confirm-modal').modal('show');
								$('.global-submit').addClass('create-plan-submit');					
			
			formData.availment_plan_name 	=  document.getElementById('availment_plan_name').value;
			formData.availment_plan_price 	=  document.getElementById('availment_plan_price').value;

			$('input[name="availment_type"]:checked').each(function() 
			{
				ajaxData.push(this.value);
			});
		});
	}
	
	function create_plan_submit()
	{
		$(document).on('click','.create-plan-submit',function() 
		{
			$('.confirm-modal').modal('hide');
            $(".plan-modal-body").html("<div class='plan-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.plan-ajax-loader').show();
            var availment_plan_name = formData.availment_plan_name;
            var availment_plan_price= formData.availment_plan_price;
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/settings/plan/create_plan/submit',
				method: "POST",
                data:{
	                	ajaxData:ajaxData,
	                	availment_plan_name:availment_plan_name,
	                	availment_plan_price:availment_plan_price
                	},
                dataType: 'text',
                success: function(data)
				{
					setTimeout(function()
					{
						$('.modal-dialog').removeClass('modal-lg');
						$('.modal-dialog').addClass('modal-sm');
					    $(".plan-modal-body").html(data);
					    $(".plan-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-lg' data-dismiss='modal'>Close</button>");
					}, 1000);
				}
			});
		});
	}
	function availment_plan_table_action()
	{
		$(document).on('change','.availment-plan-table-action',function() 
		{
			if($(this).val()=='view')
			{
				var modalName 	= 	'PLAN DETAILS';
				var availment_plan_id = $(this).data('availment_plan_id');
            	var link 		= 	'/settings/plan/plan_details/'+availment_plan_id;
            }
			else if($(this).val()=='edit')
			{
				var modalName 	= 	'EDIT PLAN';
				var availment_plan_id = $(this).data('availment_plan_id');
            }
			
            					$('.plan-modal').modal('show');
            					$('.plan-modal-title').html(modalName);
						        $('.plan-ajax-loader').show();
						        $('.plan-modal-body-content').hide();
						            
			$.ajax({
					type:'get',
					url:link,
					dataType:'text',
					success: function(data)
							{
								setTimeout(function()
								{
									$('.plan-modal-body-content').show();
								    $('.plan-modal-body-content').html(data);
			    					$('.plan-ajax-loader').hide();
								}, 1000);
							}
					});
			
		});
	}
}






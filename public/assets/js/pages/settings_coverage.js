// var settings_coverage	= new settings_coverage();
// var formData   		= new FormData();
// var ajaxData 		= [];

// function settings_coverage()
// {
// 	init();

// 	function init()
// 	{
// 		ready_document();

// 	}

// 	function ready_document()
// 	{
// 		$(document).ready(function()
// 		{
// 			trigger();
// 			create_coverage_plan();
// 			create_coverage_plan_confirm();
//             create_coverage_plan_submit();
// 		});

// 	}
// 	function trigger()
// 	{
		
// 		$(document).on('click','.btn-close-lg',function()
// 		{
// 			$('.plan-modal').modal('hide');
// 			$('.modal-dialog').removeClass('modal-sm');
// 			$('.modal-dialog').addClass('modal-lg');
// 			$('.global-submit').removeClass('create-plan-submit');
// 		});
// 	}
	
	
// 	function create_coverage_plan()
// 	{

// 		$(document).on('click','.create-plan',function() 
// 		{
// 			$('.coverage-plan-modal').modal('show');
// 			$('.coverage-plan-ajax-loader').show();
// 			$('.coverage-plan-modal-body-content').hide();
// 			$('.coverage-plan-modal-title').html('CREATE COVERAGE PLAN');
// 			$.ajax({
// 				headers: {
// 				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 				},
// 				url:'/settings/coverage/create_plan',
// 				method: "get",
//                 success: function(data)
// 				{
// 					setTimeout(function()
// 					{
// 						$('.coverage-plan-ajax-loader').hide();
// 						$('.coverage-plan-modal-body-content').show();
// 						$('.coverage-plan-modal-body-content').html(data);
//                     }, 1000);
// 				}
// 			});

// 		});
//     }
//     function create_coverage_plan_confirm()
// 	{
// 		$(document).on('click','.plan-confirm',function() 
// 		{
// 			$('.confirm-title').html('Are you sure you want to create this PLAN?');
// 								$('.confirm-modal').modal('show');
// 								$('.global-submit').addClass('create-plan-submit');					
			
// 			formData.availment_plan_name 	=  document.getElementById('availment_plan_name').value;
// 			formData.availment_plan_price 	=  document.getElementById('availment_plan_price').value;

// 			$('input[name="availment_type"]:checked').each(function() 
// 			{
// 				ajaxData.push(this.value);
// 			});
// 		});
// 	}
	
// 	function create_coverage_plan_submit()
// 	{
// 		$(document).on('click','.create-plan-submit',function() 
// 		{
// 			$('.confirm-modal').modal('hide');
//             $(".plan-modal-body").html("<div class='plan-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
//             $('.plan-ajax-loader').show();
//             var availment_plan_name = formData.availment_plan_name;
//             var availment_plan_price= formData.availment_plan_price;
//             $.ajax({
// 				headers: {
// 				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
// 				},
// 				url:'/settings/plan/create_plan/submit',
// 				method: "POST",
//                 data:{
// 	                	ajaxData:ajaxData,
// 	                	availment_plan_name:availment_plan_name,
// 	                	availment_plan_price:availment_plan_price
//                 	},
//                 dataType: 'text',
//                 success: function(data)
// 				{
// 					setTimeout(function()
// 					{
// 						$('.modal-dialog').removeClass('modal-lg');
// 						$('.modal-dialog').addClass('modal-sm');
// 					    $(".plan-modal-body").html(data);
// 					    $(".plan-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-lg' data-dismiss='modal'>Close</button>");
// 					}, 1000);
// 				}
// 			});
// 		});
// 	}
	
// }






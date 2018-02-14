var availment_center 	= new availment_center();



function availment_center()
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
			checking_null_validation(value,message);
            create_approval();
            create_approval_get_info();
            create_approval_confirm();
            create_approval_submit();
            availment_transaction_details();
            approval_details();
        });

	}
	
	
	function checking_null_validation(value,message)
	{
		if(value=="0")
		{
			return "null";
		}
		else if(value=="")
		{
			toastr.error(message+' cannot be null.', 'Something went wrong!', {timeOut: 3000})
			return "";
		}
    }
	
	function create_approval()
	{
		$(document).on('click','.create-approval',function() 
		{

			$('.approval-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top approval-modal');
			$('.global-modal-dialog').removeClass().addClass('approval-modal-dialog modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('CREATE APPROVAL');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body approval-modal-body');
			$('.approval-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            var approval_id = $(this).data('approval_id');

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/availment/create_approval',
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader approval-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer approval-modal-footer');
                    	$('.global-footer-button').html('CREATE APPROVAL').removeClass().addClass('btn btn-primary create-approval-confirm');
						
                    }, 1000);
				}
			});
			
		});

    }
    function create_approval_get_info()
	{
		$(document).on('change','.get-member-info',function() 
		{
			var member_id 	= $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/availment/get_member_info/'+member_id,
				method: "get",
                success: function(data)
				{
					$('#insertMember').html(data);
				}
			});
			
		});
		$(document).on('change','.get-availment-info',function() 
		{
			var availment_id 	= $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/availment/get_member_procedure/'+availment_id,
				method: "get",
                success: function(data)
				{
					$('#insertAvailed').html(data);
				}
			});
			
		});
		$(document).on('change','.get-doctor-info',function() 
		{
			var provider_id 	= $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/availment/get_provider_doctor/'+provider_id,
				method: "get",
                success: function(data)
				{
					$('#insertDoctor').html(data);
				}
			});
			
		});
		$(document).on('change','.get-procedure-amount',function() 
		{
			var procedure_id 	= $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/get/procedure_amount',
				data:{procedure_id: procedure_id},
				method: "POST",
                success: function(data)
				{
					$('#procedure_availed_amount').val(data);
				}
			});
			
		});
		$(document).on('change','.get-doctor-specialty',function() 
		{
			var doctor_id 	= $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/get/doctor_specialty',
				data:{doctor_id: doctor_id},
				method: "POST",
                success: function(data)
				{
					$('.doctor-specialty').html(data);
				}
			});
			
		});

    }
    function create_approval_confirm()
	{
		$(document).on('click','.create-approval-confirm',function() 
		{
			$('.confirm-modal').remove();
			$('.append-modal').append(confirmModals);
            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
			$('.confirm-modal-title').html('Are you sure you want to add this approval?');
			$('.confirm-submit').addClass('create-approval-submit');
			$('.confirm-modal').modal('show');

			ajaxData = $(".approval-submit-form").serialize();
			
		});
	}
	function create_approval_submit()
	{
		$(document).on('click','.create-approval-submit',function() 
	    {
	    	$('.confirm-modal').remove();
            $(".approval-modal-body").html("<div class='approval-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.approval-ajax-loader').show();
	        $.ajax({
	          	headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        	},
		        url:'/availment/create_approval/submit',
		        method: "POST",
		        data: ajaxData,
		        dataType:"text",
		        success: function(data)
		        {
		            setTimeout(function()
					{
						$('.modal-dialog').removeClass('modal-lg');
						$('.modal-dialog').addClass('modal-sm');
					    $(".approval-modal-body").html(data);
					    $(".approval-modal-footer").html("<button type='button' class='btn btn-default pull-left availment-btn-close' style='text-align:center' data-dismiss='modal'>Close</button>");
					}, 1000);
		           
		        }
	        });
	     });
	}
	function availment_transaction_details()
	{
	
		$(document).on('click','.availment-transaction-details',function()
		{
			$('.approval-transaction-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top approval-transaction-modal');
			$('.global-modal-dialog').removeClass().addClass('approval-transaction-modal-dialog modal-dialog modal-md');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('TRANSACTION DETAILS');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body approval-transaction-modal-body');
			$('.approval-transaction-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            var approval_id = $(this).data('approval_id');
            var member_id = $(this).data('member_id');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/member/transaction_details/'+member_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader approval-transaction-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer approval-transaction-modal-footer');
                    	$('.global-footer-button').html('CREATE PLAN').removeClass().addClass('btn btn-primary create-approval-transaction-confirm');
                    }, 1000);
				}
			});
		});
	
	}
	function approval_details()
	{
		$(document).on('click','.view-approval-details',function()
		{
			$('.approval-details-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top approval-details-modal');
			$('.global-modal-dialog').removeClass().addClass('approval-details-modal-dialog modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('APPROVAL DETAILS');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body approval-details-modal-body');
			$('.approval-details-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();

			
            var approval_id = $(this).data('approval_id');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/availment/approval_details/'+approval_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader approval-details-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer approval-details-modal-footer');
                    	$('.global-footer-button').html('CREATE PLAN').removeClass().addClass('btn btn-primary create-approval-details-confirm');
                    }, 1000);
				}
			});
		});
	} 
}

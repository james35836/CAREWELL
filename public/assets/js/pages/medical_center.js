var medical_center 	= new medical_center();
var formData   		= new FormData();
var value			= 0;
var message			= "";

function medical_center()
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
            create_approval();
            create_approval_get_info();
            create_approval_confirm();
            create_approval_submit();
            medical_transaction_details();
            checking_null_validation(value,message);

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

			$('.approval-modal').modal('show');
			$('.approval-action-modal-title').html('CREATE APPROVAL');
			$('.approval-ajax-loader').show();
            $('.approval-modal-body-content').hide();

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/medical/create_approval',
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.approval-modal-body-content').html(data);
						$('.approval-ajax-loader').hide();
						$('.approval-modal-body-content').show();
						
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
				url:'/medical/create_approval/member/'+member_id,
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
				url:'/medical/create_approval/availment/'+availment_id,
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
				url:'/medical/create_approval/doctor/'+provider_id,
				method: "get",
                success: function(data)
				{
					$('#insertDoctor').html(data);
				}
			});
			
		});

    }
    function create_approval_confirm()
	{
		$(document).on('click','.create-approval-confirm1',function() 
		{

			
		});
	}
	function create_approval_submit()
	{
		$(document).on('click','.create-approval-confirm',function() 
	    {
	      
	        $.ajax({
	          	headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        	},
		        url:'/medical/create_approval/submit',
		        method: "POST",
		        data: $(".member-submit-form,.procedure-availed-submit-form,.approval-submit-form").serialize(),
		        dataType:"text",
		        success: function(data)
		        {
		            
		             $('#insertDoctor').html(data);
		           
		        }
	        });
	     });
	}
	function medical_transaction_details()
	{
	
		$(document).on('click','.medical-transaction-details',function()
		{
			$('.approval-action-modal').modal('show');
			$('.approval-action-ajax-loader').show();
			$('.approval-action-modal-body-content').hide();
			$('.approval-action-modal-title').html('MEMBER TRANSACTION DETAILS');
			$(".approval-action-modal-footer").html("<button type='button' class='btn btn-default pull-left member-action-modal-close'>Close</button><button type='button' class='btn btn-primary pull-right' >Save Changes</button>");
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
						$('.approval-action-ajax-loader').hide();
						$('.approval-action-modal-body-content').show();
						$('.approval-action-modal-body-content').html(data);
                    }, 1000);
				}
			});
		});
	
	}
}

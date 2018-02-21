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
			
            create_approval();
            create_approval_get_info();
            create_approval_confirm();
            create_approval_submit();
            availment_transaction_details();
            approval_details();
        });

	}
	
	
	
	
	function create_approval()
	{
		$("body").on('click','.create-approval',function() 
		{
			var modalName= 'CREATE APPROVAL';
			var modalClass='approval';
			var modalLink='/availment/create_approval';
			var modalActionName='CREATE APPROVAL';
			var modalAction='create-approval-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	}
    function create_approval_get_info()
	{
		$('body').on('change','.get-member-info',function() 
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
		

		$('body').on('change','.get-provider-doctor',function() 
		{
			var provider_id 	= $(this).val();
			globals.get_information('/get/provider_doctor',provider_id,'.doctor-list','html')
		});

		$('body').on('change','.get-laboratory-amount',function() 
		{
			var laboratory_id 	= $(this).val();
			globals.get_information('/get/laboratory_amount',laboratory_id,'.laboratory_amount','val')
		});

		$('body').on('change','.doctor-list',function() 
		{
			var doctor_id 	= $(this).val();
			globals.get_information('/get/doctor_specialty',doctor_id,'.doctor-specialty','html')
		});

		

    }
    function create_approval_confirm()
	{
		$('body').on('click','.create-approval-confirm',function() 
		{
			var	confirmModalMessage = 'Are you sure you want to add this approval?';
			var confirmModalAction = 'create-approval-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);

			ajaxData = $(".approval-submit-form").serialize();
			
		});
	}
	function create_approval_submit()
	{
		$('body').on('click','.create-approval-submit',function() 
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
						$('.approval-ajax-loader').hide();
						$('.approval-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
						$('.approval-modal-body').html(data);
						$('.approval-modal-footer').html(successButton);
					}, 1000);
		           
		        }
	        });
	     });
	}
	function availment_transaction_details()
	{
		$("body").on('click','.availment-transaction-details',function()
		{
			var member_id = $(this).data('member_id');
			var modalName= 'TRANSACTION DETAILS';
			var modalClass='approval-transaction';
			var modalLink='/member/transaction_details/'+member_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='create-approval-confirm';
			var modalSize = 'modal-md';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
		
	
	}
	function approval_details()
	{
		$("body").on('click','.view-approval-details',function()
		{
			var approval_id = $(this).data('approval_id');
			var modalName= 'APPROVAL DETAILS';
			var modalClass='approval-details';
			var modalLink='/availment/approval_details/'+approval_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='create-approval-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	} 
}

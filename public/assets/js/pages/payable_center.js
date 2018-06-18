var payable_center = new payable_center();

function payable_center()
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
			create_payable();
			create_payable_get_approval();
			create_payable_confirm();
			create_payable_submit();
			view_payable_details();
			update_payable_confirm();
			update_payable_submit()
			search_filter_approval();

			payable_mark_as_close();
		});

	}
	function search_filter_approval()
	{
		$('body').on('click','.search-approval',function() 
		{
			var key     		= $('.search-approval-key').val();
			var provider_id     = $('#provider_id').val();
			if(key=="")
			{
				toastr.error('Input search key first.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(provider_id=="")
			{
				toastr.error('Please select provider first.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				$.ajax({
					headers: {
					      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url:'/payable/search_approval',
					method: "post",
					data  :  {key:key,provider_id:provider_id},
					success: function(data)
					{
						$('.load-member-approval').html(data);
					}
				});
			}
			
		});
	}
	function create_payable()
	{
          $('body').on('click','.create-payable',function() 
		{
			var modalName 		= 'CREATE PAYABLE';
			var modalClass 	= 'payable';
			var modalLink 		= '/payable/create_payable';
			var modalActionName = 'CREATE PAYABLE';
			var modalAction 	= 'create-payable-confirm';
			var modalSize 		= 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
     }
     function create_payable_get_approval()
     {
    		$('body').on('change','.get-all-approval',function() 
		{
			var provider_id     = $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/payable/get_approval/'+provider_id,
				method: "get",
                	success: function(data)
				{
					$('.load-member-approval').html(data);
				}
			});
		});
     }
     function create_payable_confirm()
     {
    		$('body').on('click','.create-payable-confirm',function() 
		{
			if(document.getElementById('provider_id').value=="Select Provider")
			{
				toastr.error('Please select provider first.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(globals.checking_null_validation(document.getElementById('payable_soa_number').value,"SOA NUMBER")=="")
			{}
		    	else if(globals.checking_null_validation(document.getElementById('payable_recieved').value,"RECIEVED DATE")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('payable_due').value,"DUE DATE")=="")
			{}
			else
			{
				$('input[name="approval_id[]"]:checked').each(function(i,num)
	           	{
		            	if($(num).val()!="")
		            	{
		            		approvalData.push(this.value);
		            	}
	            	});
	            	if(approvalData==null||approvalData=="")
				{
					toastr.error('Please select Approval at least one.', 'Something went wrong!', {timeOut: 3000})
				}
				else
				{
					var	confirmModalMessage = 'Are you sure you want to add this payable?';
					var confirmModalAction = 'create-payable-submit';
					globals.confirm_modals(confirmModalMessage,confirmModalAction);
					
					payableData.append("provider_id", 			document.getElementById('provider_id').value);
			          payableData.append("payable_soa_number",   	document.getElementById('payable_soa_number').value);
			          payableData.append("payable_recieved", 		document.getElementById('payable_recieved').value);
			          payableData.append("payable_due", 			document.getElementById('payable_due').value);
			          for (var i = 0; i < approvalData.length; i++) 
					{
					    payableData.append('approvalData[]', approvalData[i]);
					}
				}
			}
		});
     }
     function create_payable_submit()
     {
     	$('body').on('click','.create-payable-submit',function() 
		{
			globals.global_submit('payable','/payable/create_payable/submit',payableData);
          });
    	}
    	function view_payable_details()
    	{
    		$('body').on('click','.view-payable-details',function() 
		{
			var payable_id      = $(this).data('payable_id');
			var modalName 		= 'PAYABLE DETAILS';
			var modalClass 	= 'payable-details';
			var modalLink 		= '/payable/payable_details/'+payable_id;
			var modalActionName = 'SAVE CHANGES';
			var modalAction 	= 'update-payable-confirm';
			var modalSize 		= 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	
    	}
    	function update_payable_confirm()
    	{
    		$('body').on('click','.update-payable-confirm',function() 
		{
			if(globals.checking_null_validation(document.getElementById('payable_soa_number').value,"SOA NUMBER")=="")
			{}
		    	else if(globals.checking_null_validation(document.getElementById('payable_recieved').value,"RECIEVED DATE")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('payable_due').value,"DUE DATE")=="")
			{}
			else
			{
				
				var	confirmModalMessage = 'Are you sure you want to continue?';
				var confirmModalAction   = 'update-payable-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
				
				payableData.append("payable_soa_number",   	document.getElementById('payable_soa_number').value);
		          payableData.append("payable_recieved", 		document.getElementById('payable_recieved').value);
		          payableData.append("payable_due", 			document.getElementById('payable_due').value);
		          payableData.append("payable_id", 			document.getElementById('payable_id').value);
		     }
		});
    	}
    	function update_payable_submit()
     	{
	     	$('body').on('click','.update-payable-submit',function() 
			{
				globals.global_submit('payable-details','/payable/update_payable/submit',payableData);
          	});
    	}

    	function payable_mark_as_close()
    	{
    		$('body').on('click','.payable-mark-close',function()
    		{
    			var payable_id      = $(this).data('payable_id');
				var modalName 		= 'PAYABLE MARK AS CLOSE';
				var modalClass 		= 'payable-mark-as-close';
				var modalLink 		= '/payable/mark_close/'+payable_id;
				var modalActionName = 'SAVE CHANGES';
				var modalAction 	= 'payable-mark-close-confirm';
				var modalSize 		= 'modal-md';
				globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
    		});
    	}
    	
}






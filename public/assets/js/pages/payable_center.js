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
			checking_null_validation(value,message);
			create_payable();
			create_payable_get_approval();
			create_payable_confirm();
			create_payable_submit();
			view_payable_details();
			
			
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
	function create_payable()
	{

		$('body').on('click','.create-payable',function() 
		{
			$('.payable-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top payable-modal');
			$('.global-modal-dialog').removeClass().addClass('payable-modal-dialog modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('CREATE PAYABLE');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body payable-modal-body');
			$('.payable-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/payable/create_payable',
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader payable-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer payable-modal-footer');
                    	$('.global-footer-button').html('CREATE PAYABLE').removeClass().addClass('btn btn-primary create-payable-confirm');
                    }, 1000);
				}
			});

		});
    }
    function create_payable_get_approval()
    {
    	$('body').on('change','.get-all-approval',function() 
		{
			var provider_id = $(this).val();
			var close 		= this.options[this.selectedIndex].innerHTML;
			// var sample = close.find('.get-all-approval option:selected').text();
			
			// alert(close+" "+provider_id);
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/payable/get_approval/'+provider_id,
				method: "get",
                success: function(data)
				{
					$('.payable-create-table').html(data);
				}
			});

		});
    	
    }
    function create_payable_confirm()
    {
    	$('body').on('click','.create-payable-confirm',function() 
		{
			
            $('input[name="approval_id"]:checked').each(function(i, num)
            {
            	if($(num).val()!="")
            	{
            		approvalData.push(this.value);
            	}
            	
            });
            if(document.getElementById('provider_id').value=="Select Provider")
			{
				toastr.error('Please select provider first.', 'Something went wrong!', {timeOut: 3000})
			}
  	 		else if(checking_null_validation(document.getElementById('payable_soa_number').value,"SOA NUMBER")=="")
			{}	
		    else if(checking_null_validation(document.getElementById('payable_recieved').value,"RECIEVED DATE")=="")
			{}
			else if(checking_null_validation(document.getElementById('payable_due').value,"DUE DATE")=="")
			{}	
			else if(approvalData==null||approvalData=="")
			{
				toastr.error('Please select Approval at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				
				$('.confirm-modal').remove();
				$('.append-modal').append(confirmModals);
	            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
				$('.confirm-modal-title').html('Are you sure you want to add this payable?');
				$('.confirm-submit').addClass('create-payable-submit');
				$('.confirm-modal').modal('show');

				formData.append("provider_id", 			document.getElementById('provider_id').value);
	            formData.append("payable_soa_number",   document.getElementById('payable_soa_number').value);
	            formData.append("payable_recieved", 	document.getElementById('payable_recieved').value);
	            formData.append("payable_due", 			document.getElementById('payable_due').value);
	            for (var i = 0; i < approvalData.length; i++) 
				{
				    formData.append('approvalData[]', approvalData[i]);
				}
				
			}
		});
    }
    function create_payable_submit()
    {
    	$('body').on('click','.create-payable-submit',function() 
		{
			
            $('.confirm-modal').remove();
            $(".payable-modal-body").html("<div class='payable-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.payable-ajax-loader').show();
            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/payable/create_payable/submit',
				method: "POST",
                data: formData,
                contentType:false,
                cache:false,
                processData:false,
                success: function(data)
				{
					setTimeout(function()
					{
						$('.payable-ajax-loader').hide();
						$('.payable-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
						$('.payable-modal-body').html(data);
						$('.payable-modal-footer').html('<button type="button" class="btn btn-default pull-left " data-dismiss="modal">Close</button>');

					}, 1000);
				}
			});
		});
    }
    function view_payable_details()
    {

		$('body').on('click','.view-payable-details',function() 
		{

			$('.payable-details-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top payable-details-modal');
			$('.global-modal-dialog').removeClass().addClass('payable-details-modal-dialog modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('PAYABLE DETAILS');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body payable-details-modal-body');
			$('.payable-details-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            var payable_id = $(this).data('payable_id');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/payable/payable_details/'+payable_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader payable-details-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer payable-details-modal-footer');
                    	$('.global-footer-button').html('SAVE CHANGES').removeClass().addClass('btn btn-primary payable-details-confirm');
                    }, 1000);
				}
			});

		});
	
    }
}






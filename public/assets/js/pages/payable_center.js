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
    	$(document).on('click','.create-payable-confirm',function() 
		{
			
            $('input[name="approval_id"]:checked').each(function(i, num)
            {
            	if($(num).val()!="")
            	{
            		approvalData.push(this.value);
            	}
            	
            });

  	 		
            
            if(checking_null_validation(document.getElementById('company_name').value,"COMPANY NAME")=="")
			{}	
		    else if(checking_null_validation(document.getElementById('company_contact_person').value,"COMPANY CONTACT PERSON")=="")
			{}
			else if(checking_null_validation(document.getElementById('company_email_address').value,"COMPANY EMAIL ADDRESS")=="")
			{}	
			else if(checking_null_validation(document.getElementById('company_address').value,"COMPANY ADDRESS")=="")
			{}
			else if(approvalData==null||approvalData=="")
			{
				toastr.error('Please add Contact Number at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				
				$('.confirm-modal').remove();
				$('.append-modal').append(confirmModals);
	            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
				$('.confirm-modal-title').html('Are you sure you want to add this company?');
				$('.confirm-submit').addClass('create-company-submit');
				$('.confirm-modal').modal('show');

				formData.append("company_name", 			document.getElementById('company_name').value);
	            formData.append("company_email_address", 	document.getElementById('company_email_address').value);
	            formData.append("company_contact_person", 	document.getElementById('company_contact_person').value);
	            formData.append("company_address", 			document.getElementById('company_address').value);

	            formData.append("payment_mode_id", 			document.getElementById('payment_mode_id').value);
	            for (var i = 0; i < contactData.length; i++) 
				{
				    formData.append('contactData[]', contactData[i]);
				}
				for (var i = 0; i < countContract; i++) 
				{
				    formData.append('contractData[]', document.getElementById('contract_image_name').files[i]);
				}
				for (var i = 0; i < countBenefits; i++) 
				{
				    formData.append('benefitsData[]', document.getElementById('contract_benefits_name').files[i]);
				}
				for (var i = 0; i < coveragePlanData.length; i++) 
				{
				    formData.append('coveragePlanData[]', coveragePlanData[i]);
				}
				
				for (var i = 0; i < deploymentData.length; i++) 
				{
				    formData.append('deploymentData[]', deploymentData[i]);
				}
			}
		});
    }
    function create_payable_submit()
    {

    }
}






var company_center 	= new company_center();
var formData   		= new FormData();
var ajaxData 		= [];
var availmentData 	= [];
var check_null 		= [];
var trunkData		= [];
var benefitsData	= [];
var contractData	= [];
var contactData 	= [];
var coveragePlanData= [];
var deploymentData	= [];
var value="0";
var message="";



function company_center()
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
            create_company();
            create_company_confirm();
            create_company_submit();
            action_view_company_details();
			trigger();
			checking_null_validation(value,message);


         });

	}

	function trigger()
	{
		$(document).on('click','.btn-close-lg',function()
		{
			$('.company-modal').modal('hide');
			$(".company-modal-body").html('<center>RELOAD PAGE</center>');
			
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

	function create_company()
	{
		$("body").on('click','.create-company',function()
		{
			$('.company-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top company-modal');
			$('.global-modal-dialog').removeClass().addClass('company-modal-dialog modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('CREATE COMPANY');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body company-modal-body');
			$('.company-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            var approval_id = $(this).data('approval_id');

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/company/create_company',
				method: "get",
                success: function(data)
                {
					setTimeout(function()
					{

						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader company-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer company-modal-footer');
                    	$('.global-footer-button').html('CREATE COMPANY').removeClass().addClass('btn btn-primary create-company-confirm');
                    }, 1000);
				}
			});
		});
		
	}
	function create_company_confirm()
	{
		$(document).on('click','.create-company-confirm',function() 
		{
			
            $('input[name="company_number[]"]').each(function()
            {
            	contactData.push(this.value);
            });

            var countContract = document.getElementById('contract_image_name').files.length;
            var countBenefits = document.getElementById('contract_image_name').files.length;

            $('input[name="contract_benefits_name[]"]').each(function()
            {
            	benefitsData.push(this.value);
            });
            $('.coverage_plan_name :selected').each(function()
            {
            	coveragePlanData.push(this.value);
            });
            $('input[name="deployment_name[]"]').each(function()
            {
            	deploymentData.push(this.value);
            });
  	 		
            
            if(checking_null_validation(document.getElementById('company_name').value,"COMPANY NAME")=="")
			{}	
		    else if(checking_null_validation(document.getElementById('company_contact_person').value,"COMPANY CONTACT PERSON")=="")
			{}
			else if(checking_null_validation(document.getElementById('company_email_address').value,"COMPANY EMAIL ADDRESS")=="")
			{}	
			else if(checking_null_validation(document.getElementById('company_address').value,"COMPANY ADDRESS")=="")
			{}
			else if(contactData.length == 0)
			{
				toastr.error('Please add Contact Number at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(countContract == 0)
			{
				toastr.error('Please add CONTRACT IMAGE at least one.', 'Something went wrong!', {timeOut: 3000})
			}

			else if(countBenefits == 0)
			{
				toastr.error('Please add BENIFITS IMAGE at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(deploymentData.length == 0)
			{
				toastr.error('Please add DEPLOYMENT at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(coveragePlanData.length == 0)
			{
				toastr.error('Please add COVERAGE PLAN at least one.', 'Something went wrong!', {timeOut: 3000})
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
	
    function create_company_submit()
	{
		$(document).on('click','.create-company-submit',function() 
		{
			
            $('.confirm-modal').modal('hide');
            $(".company-modal-body").html("<div class='company-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.company-ajax-loader').show();
            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/company/create_company/submit',
				method: "POST",
                data: formData,
                contentType:false,
                cache:false,
                processData:false,
                success: function(data)
				{
					setTimeout(function()
					{
						$('.modal-dialog').removeClass('modal-lg');
						$('.modal-dialog').addClass('modal-sm');
					    $(".company-modal-body").html(data);
					    $(".company-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-lg' style='text-align:center' data-dismiss='modal'>Close</button>");
					}, 1000);
				}
			});
		});
	}
	function action_view_company_details()
	{
		$(document).on('click','.view-company-details',function() 
		{

			$('.company-modal').modal('show');
			$('.company-modal-title').html('COMPANY DETAILS');
			$('.company-ajax-loader').show();
			$('.company-modal-body-content').hide();
			var company_id = $(this).data('id');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/company/company_details/'+company_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.company-ajax-loader').hide();
						$('.company-modal-body-content').show();
						$('.company-modal-body-content').html(data);
                    }, 1000);
				}
			});

		});
	}
}

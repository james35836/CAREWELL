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
			var company_id = $(this).data('company_id');
			var modalName= 'CREATE COMPANY';
			var modalClass='company';
			var modalLink='/company/create_company';
			var modalActionName='CREATE COMPANY';
			var modalAction='create-company-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
		
	}
	function create_company_confirm()
	{
		$(document).on('click','.create-company-confirm',function() 
		{
			
            $('input[name="company_number[]"]').each(function(i, num)
            {
            	if($(num).val()!="")
            	{
            		contactData.push(this.value);
            	}
            	
            });

            var countContract = document.getElementById('contract_image_name').files.length;
            var countBenefits = document.getElementById('contract_benefits_name').files.length;

            
            $("select.coverage_plan_name").each(function(i, sel)
            {
            	var selectedPlan = $(sel).val();
            	if(selectedPlan!="SELECT COVERAGE PLAN")
            	{
            		coveragePlanData.push(selectedPlan);
            	}
            });
            $('input[name="deployment_name[]"]').each(function(i, dep)
            {
            	if($(dep).val()!="")
            	{
            		deploymentData.push(this.value);
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
			else if(contactData==null||contactData=="")
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
			else if(deploymentData==null||deploymentData=="")
			{
				toastr.error('Please add DEPLOYMENT at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(coveragePlanData==null||coveragePlanData=="")
			{
				toastr.error('Please add COVERAGE PLAN at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			
			else
			{
				var	confirmModalMessage = 'Are you sure you want to add this company?';
				var confirmModalAction = 'create-company-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
				

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
			
            $('.confirm-modal').remove();
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
			var company_id = $(this).data('company_id');
			var modalName= 'COMPANY DETAILS';
			var modalClass='company-details';
			var modalLink='/company/company_details/'+company_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='create-company-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	}
}

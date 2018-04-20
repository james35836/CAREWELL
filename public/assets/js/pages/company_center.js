var company_center 	= new company_center();

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
		});

	}

	function create_company()
	{
		$('body').on('click','.prompt-modal',function()
		{
			$('.alert-modal').modal('show');
        });
		$("body").on('click','.create-company',function()
		{
			$('.alert-modal').remove();
			var company_id     = $(this).data('company_id');
			var modalName      = 'CREATE COMPANY';
			var modalClass     = 'company';
			var modalLink      = '/company/create_company';
			var modalActionName= 'CREATE COMPANY';
			var modalAction    = 'create-company-confirm';
			var modalSize      = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
		
	}
	function create_company_confirm()
	{
		$(document).on('click','.create-company-confirm',function() 
		{
			
            

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
  	 		
            
            if(globals.checking_null_validation(document.getElementById('company_name').value,"COMPANY NAME")=="")
			{}	
		    else if(globals.checking_null_validation(document.getElementById('company_contact_number').value,"COMPANY CONTACT PERSON")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('company_email_address').value,"COMPANY EMAIL ADDRESS")=="")
			{}	
			else if(globals.checking_null_validation(document.getElementById('company_address').value,"COMPANY ADDRESS")=="")
			{}
			
			else if(countContract == 0)
			{
				globals.global_tostr('CONTACT IMAGE');
			}
			else if(countBenefits == 0)
			{
				globals.global_tostr('BENEFITS  IMAGE');
			}
			else if(deploymentData==null||deploymentData=="")
			{
				globals.global_tostr('DEPLOYMENT');
			}
			else if(coveragePlanData==null||coveragePlanData=="")
			{
				globals.global_tostr('COVERAGE PLAN');
			}
			
			else
			{
				var	confirmModalMessage  = 'Are you sure you want to add this company?';
				var confirmModalAction   = 'create-company-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
				
				companyData.append("company_name", 				document.getElementById('company_name').value);
	            companyData.append("company_email_address", 	document.getElementById('company_email_address').value);
	            companyData.append("company_contact_number", 	document.getElementById('company_contact_number').value);
	            companyData.append("company_address", 			document.getElementById('company_address').value);
                
                companyData.append("contact_person_name", 		document.getElementById('contact_person_name').value);
	            companyData.append("contact_person_position", 	document.getElementById('contact_person_position').value);
	            companyData.append("contact_person_number", 	document.getElementById('contact_person_number').value);

	            companyData.append("contact_person_names", 		document.getElementById('contact_person_names').value);
	            companyData.append("contact_person_positions", 	document.getElementById('contact_person_positions').value);
	            companyData.append("contact_person_numbers", 	document.getElementById('contact_person_numbers').value);

	            for (var i = 0; i < contactData.length; i++) 
				{
				    companyData.append('contactData[]', contactData[i]);
				}
				for (var i = 0; i < countContract; i++) 
				{
				    companyData.append('contractData[]', document.getElementById('contract_image_name').files[i]);
				}
				for (var i = 0; i < countBenefits; i++) 
				{
				    companyData.append('benefitsData[]', document.getElementById('contract_benefits_name').files[i]);
				}
				for (var i = 0; i < coveragePlanData.length; i++) 
				{
				    companyData.append('coveragePlanData[]', coveragePlanData[i]);
				}
				
				for (var i = 0; i < deploymentData.length; i++) 
				{
				    companyData.append('deploymentData[]', deploymentData[i]);
				}
			}
		});
	}
	
    function create_company_submit()
	{
		$('body').on('click','.create-company-submit',function() 
		{
			globals.global_submit('company','/company/create_company/submit',companyData);
        });
	}
	function action_view_company_details()
	{
		$('body').on('click','.view-company-details',function() 
		{
			var company_id      = $(this).data('company_id');
			var modalName       = 'COMPANY DETAILS';
			var modalClass      ='company-details';
			var modalLink       ='/company/company_details/'+company_id;
			var modalActionName ='SAVE CHANGES';
			var modalAction     ='create-company-confirm';
			var modalSize       = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	}
}

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
            update_company_confirm();
            update_company_submit();

            add_company_plan();
            add_company_plan_confirm();
            add_company_plan_submit();

            add_company_deployment();
            add_company_deployment_confirm();
            add_company_deployment_submit();
		});

	}

	function create_company()
	{
		$('body').on('click','.prompt-modal',function()
		{
			var	confirmModalMessage  = 'PLEASE MAKE SURE THAT THE COVERAGE PLAN YOU NEED ARE ALREADY CREATED FOR THIS COMPANY!<br><br>ARE YOU SURE YOU WANT TO PROCEED?';
			var confirmModalAction   = 'create-company';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);
        });
		$("body").on('click','.create-company',function()
		{
			$('.confirm-modal').remove();
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
		$('body').on('click','.create-company-confirm',function() 
		{
			$('body').find('div.alert-div').css('visibility','visible');
			$('body').find('div.alert-div-message').html("james");
			alert("james");
			var countContract 	= document.getElementById('contract_image_name').files.length;
            	var countBenefits 	= document.getElementById('contract_benefits_name').files.length;
            	var check 		= globals.checkArrayValues($("select.coverage_plan_name"));
            	if(check=="Exist")
               	{
               		toastr.error('Duplicated entry, Please check provider.', 'Something went wrong!', {timeOut: 3000});
               	}
               	else if(globals.checking_null_validation(document.getElementById('company_code').value,"COMPANY CODE")=="")
				{

				}	
               	else if(globals.checking_null_validation(document.getElementById('company_name').value,"COMPANY NAME")=="")
				{

				}	
		    	else if(globals.checking_null_validation(document.getElementById('company_contact_number').value,"COMPANY CONTACT PERSON")=="")
				{

				}
				else if(globals.checking_null_validation(document.getElementById('company_email_address').value,"COMPANY EMAIL ADDRESS")=="")
				{

				}	
		   		else if(globals.global_input_email($('#company_email_address'))=="error")
		    	{
		    		toastr.error('Email is in a wrong format.', 'Something went wrong!', {timeOut: 3000})
		    	}
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
				else
				{
					$('input[name="deployment_name[]"]').each(function(i, dep)
	            	{
		            	if($(dep).val()!="")
		            	{
		            		deploymentData.push(this.value);
		            	}
	            	});
	            	if(deploymentData==null||deploymentData=="")
					{
						globals.global_tostr('DEPLOYMENT');
					}
					else
					{
						$("select.coverage_plan_name").each(function(i, sel)
		            	{
			            	var selectedPlan = $(sel).val();
			        		if(selectedPlan!="SELECT COVERAGE PLAN")
			            	{
			            		coveragePlanData.push(selectedPlan);
			            	}
		            	});
		            	if(coveragePlanData==null||coveragePlanData=="")
						{
							globals.global_tostr('COVERAGE PLAN');
						}
						else
						{
							var	confirmModalMessage  = 'Are you sure you want to add this company?';
							var confirmModalAction    = 'create-company-submit';
							globals.confirm_modals(confirmModalMessage,confirmModalAction);

							companyData.append("company_code", 			document.getElementById('company_code').value);
							companyData.append("company_name", 			document.getElementById('company_name').value);
			            	companyData.append("company_email_address", 		document.getElementById('company_email_address').value);
			            	companyData.append("company_contact_number", 	document.getElementById('company_contact_number').value);
			            	companyData.append("company_address", 			document.getElementById('company_address').value);
		                
		                	companyData.append("contact_person_name", 		document.getElementById('contact_person_name').value);
			            	companyData.append("contact_person_position", 	document.getElementById('contact_person_position').value);
			            	companyData.append("contact_person_number", 		document.getElementById('contact_person_number').value);

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
			var modalClass      = 'company-details';
			var modalLink       = '/company/company_details/'+company_id;
			var modalActionName = 'SAVE CHANGES';
			var modalAction     = 'update-company-confirm';
			var modalSize       = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	}
	

	function update_company_confirm()
	{
		$('body').on('click','.update-company-confirm',function() 
		{
			if(globals.checking_null_validation(document.getElementById('company_name').value,"COMPANY NAME")=="")
			{}	
		    else if(globals.checking_null_validation(document.getElementById('company_contact_number').value,"COMPANY CONTACT PERSON")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('company_email_address').value,"COMPANY EMAIL ADDRESS")=="")
			{}	
		    else if(globals.global_input_email($('#company_email_address'))=="error")
		    {
		    	toastr.error('Email is in a wrong format.', 'Something went wrong!', {timeOut: 3000})
		    }
			else if(globals.checking_null_validation(document.getElementById('company_address').value,"COMPANY ADDRESS")=="")
			{}
		    else
		    {
		    	var	confirmModalMessage  = 'Are you sure you want to update this company?';
				var confirmModalAction   = 'update-company-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);

				companyData.append("company_id", 				document.getElementById('company_id').value);

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
		    }
		});
	}

	function update_company_submit()
	{
		$('body').on('click','.update-company-submit',function()  
		{
			globals.global_submit('company-details','/company/update_company/submit',companyData);
        });
	}
	function add_company_plan()
	{
		$('body').on('click','.add-company-plan',function()
		{
			var company_id      = $(this).data('company_id');
			var modalName       = 'ADD COVERAGE PLAN';
			var modalClass      = 'company-add-plan';
			var modalLink       = '/company/add_coverage_plan/'+company_id;
			var modalActionName = 'ADD PLAN';
			var modalAction     = 'add-company-plan-confirm';
			var modalSize       = 'modal-md';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	}
	function add_company_plan_confirm()
	{
		$('body').on('click','.add-company-plan-confirm',function()
		{
			$("select.coverage_plan_name").each(function(i, sel)
            {
            	var selectedPlan = $(sel).val();
        		if(selectedPlan!="SELECT COVERAGE PLAN")
            	{
            		coveragePlanData.push(selectedPlan);
            	}
            });
            if(coveragePlanData==null||coveragePlanData=="")
			{
				globals.global_tostr('COVERAGE PLAN');
			}
			else
			{
				var	confirmModalMessage  = 'Are you sure you want to add this coverage plan?';
				var confirmModalAction   = 'add-company-plan-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
                
                coverageData.append('company_id',      $('#company_id').val());
				for (var i = 0; i < coveragePlanData.length; i++) 
				{
				    coverageData.append('coveragePlanData[]', coveragePlanData[i]);
				}
			}
		});
	}
	function add_company_plan_submit()
	{
		$('body').on('click','.add-company-plan-submit',function()  
		{
			globals.global_submit('company-add-plan','/company/add_coverage_plan/submit',coverageData);
        });
	}
	function add_company_deployment()
	{
		$('body').on('click','.add-company-deployment',function()
		{
			var company_id      = $(this).data('company_id');
			var modalName       = 'ADD DEPLOYMENT';
			var modalClass      = 'company-add-deployment';
			var modalLink       = '/company/add_deployment/'+company_id;
			var modalActionName = 'ADD DEPLOYMENT';
			var modalAction     = 'add-company-deployment-confirm';
			var modalSize       = 'modal-md';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	}
    function add_company_deployment_confirm()
    {
    	$('body').on('click','.add-company-deployment-confirm',function()
		{
			$('input[name="deployment_name[]"]').each(function(i, dep)
            {
            	if($(dep).val()!="")
            	{
            		deploymentData.push(this.value);
            	}
            });
            if(deploymentData==null||deploymentData=="")
			{
				globals.global_tostr('DEPLOYMENT');
			}
			else
			{
				var	confirmModalMessage  = 'Are you sure you want to add this DEPLOYMENT?';
				var confirmModalAction   = 'add-company-deployment-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
                
                companyData.append('company_id',      $('#company_id').val());
				for (var i = 0; i < deploymentData.length; i++) 
				{
				    companyData.append('deploymentData[]', deploymentData[i]);
				}

			}
		});
    }
    function add_company_deployment_submit()
    {
    	$('body').on('click','.add-company-deployment-submit',function()  
		{
			globals.global_submit('company-add-deployment','/company/add_deployment/submit',companyData);
        });
    }
}

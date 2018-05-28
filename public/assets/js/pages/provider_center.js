var provider_center 	= new provider_center();


function provider_center()
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
            create_provider();
            create_provider_confirm();
            create_provider_submit();
            import_provider();
            import_provider_confirm();
            import_provider_submit();
            view_provider_details();
            update_provider_confirm();
            update_provider_submit();
		});

	}
	function create_provider()
	{
		$("body").on('click','.create-provider',function() 
		{
			var modalName= 'CREATE PROVIDER';
			var modalClass='provider';
			var modalLink='/provider/create_provider';
			var modalActionName='CREATE PROVIDER';
			var modalAction='create-provider-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
		
	}
	function create_provider_confirm()
	{
		$('body').on('click','.create-provider-confirm',function() 
		{ 
			$('input[name="doctor_full_name[]"]').each(function(i, doctor)
            {
            	if($(doctor).val()!="")
            	{
            		doctorProviderData.push(this.value);
            	}
            	
            });
			
			if(globals.checking_null_validation(document.getElementById('provider_name').value,"PROVIDER NAME")=="")
			{}	
			else if(globals.checking_null_validation(document.getElementById('provider_contact_person').value,"PROVIDER CONTACT PERSON")=="")
			{}	
			else if(globals.checking_null_validation(document.getElementById('provider_telephone_number').value,"PROVIDER PHONE NUMBER")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('provider_mobile_number').value,"PROVIDER MOBILE NUMBER")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('provider_contact_email').value,"PROVIDER EMAIL ADDRESS")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('provider_address').value,"PROVIDER ADDRESS")=="")
			{}
		    else if(doctorProviderData==null||doctorProviderData=="")
			{
				toastr.error('Please add PAYEE at least one.', 'Something went wrong!', {timeOut: 3000})
			}
            else
			{
				var	confirmModalMessage = 'Are you sure you want to add this provider?';
				var confirmModalAction = 'create-provider-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);

				providerData.append("provider_name", 			document.getElementById('provider_name').value);
				providerData.append("provider_rvs", 			document.getElementById('provider_rvs').value);
	            providerData.append("provider_contact_person", 	document.getElementById('provider_contact_person').value);
	            providerData.append("provider_telephone_number",document.getElementById('provider_telephone_number').value);
	            providerData.append("provider_mobile_number", 	document.getElementById('provider_mobile_number').value);
	            providerData.append("provider_contact_email", 	document.getElementById('provider_contact_email').value);
	            providerData.append("provider_address", 	    document.getElementById('provider_address').value);
	            
	            for (var i = 0; i < doctorProviderData.length; i++) 
				{
				    providerData.append('doctorProviderData[]', doctorProviderData[i]);
				}
	            
			}
		});
	}
	
    function create_provider_submit()
	{
		$('body').on('click','.create-provider-submit',function() 
		{
			globals.global_submit('provider','/provider/create_provider/submit',providerData);
        });
		
	}
	function import_provider()
	{
		$("body").on('click','.import-provider',function() 
		{
			var provider_id = $(this).data('provider_id');
			var modalName= 'IMPORT PROVIDER';
			var modalClass='provider-import';
			var modalLink='/provider/import_provider';
			var modalActionName='SAVE CHANGES';
			var modalAction='create-approval-confirm';
			var modalSize = 'modal-import';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	}
	function import_provider_confirm()
	{
		$('body').on('click','.import-provider-confirm',function()
		{
			if(document.getElementById('importProviderFile').files.length!=0)
			{
				var	confirmModalMessage = 'Are you sure you want to import this file?';
				var confirmModalAction = 'import-provider-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
				providerFileData.append("importProviderFile", 	document.getElementById('importProviderFile').files[0]);
			}
			
		});
	}
	function import_provider_submit()
	{
		$('body').on('click','.import-provider-submit',function() 
		{
			globals.global_submit('provider-import','/provider/import_provider/submit',providerFileData);
        });
	}
	
	function view_provider_details()
	{
		$('body').on('click','.view-provider-details',function()
		{
			var provider_id 		= $(this).data('provider_id');
			var modalName 			= 'PROVIDER DETAILS';
			var modalClass 			= 'provider-details';
			var modalLink 			= '/provider/provider_details/'+provider_id;
			var modalActionName 	= 'SAVE CHANGES';
			var modalAction 		= 'update-provider-confirm';
			if($(this).data('size')=='md')
			{
				var modalSize        = 'modal-md';
			}
			else
			{
				var modalSize        = 'modal-lg';
			}
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
		
	}

	//edrich
	function update_provider_confirm()
	{
		$('body').on('click','.update-provider-confirm',function() 
		{
			var	confirmModalMessage  = 'Are you sure you want to update this provider?';
			var confirmModalAction   = 'update-provider-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);

			providerData.append("provider_id", 				document.getElementById('provider_id').value);
			providerData.append("provider_name", 			document.getElementById('provider_name').value);
			providerData.append("provider_rvs", 			document.getElementById('provider_rvs').value);
			providerData.append("provider_contact_person", 	document.getElementById('provider_contact_person').value);
			providerData.append("provider_contact_email", 	document.getElementById('provider_contact_email').value);
			providerData.append("provider_telephone_number",document.getElementById('provider_telephone_number').value);
			providerData.append("provider_mobile_number", 	document.getElementById('provider_mobile_number').value);
			providerData.append("provider_address", 		document.getElementById('provider_address').value);
		});
	}

	function update_provider_submit()
	{
		$('body').on('click','.update-provider-submit',function()  
		{
			globals.global_submit('provider-details','/provider/update_provider/submit',providerData);
        });
		
	}
	//edrich
	
}

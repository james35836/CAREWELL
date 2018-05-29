var doctor_center 	= new doctor_center();


function doctor_center()
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
			add_doctor();
            	add_doctor_confirm();
            	add_doctor_submit();
            	export_doctor_template();
            	import_doctor();
            	import_doctor_confirm();
			import_doctor_submit();
			view_doctor_details();
			save_doctor_confirm();
			update_doctor_submit();

			add_doctor_provider();
			add_doctor_provider_confirm();
			add_doctor_provider_submit();
		});
	}
	function add_doctor_provider()
	{
		$("body").on('click','.add-doctor-provider',function()
		{
			var doctor_id       = $(this).data('doctor_id');
			var modalName 		= 'ADD DOCTOR PROVIDER';
			var modalClass 		= 'add-doctor-provider-modal';
			var modalLink 		= '/doctor/add_doctor_provider/'+doctor_id;
			var modalActionName = 'ADD DOCTOR PROVIDER';
			var modalAction 	= 'add-doctor-provider-confirm';
			var modalSize  		= 'modal-md';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	}
	function add_doctor_provider_confirm()
	{
		$('body').on('click','.add-doctor-provider-confirm',function()
		{
			$("select.provider_name").each(function(i, sel)
            	{
	            	var selectedProvider = $(sel).val();
	        		if(selectedProvider!="SELECT PROVIDER")
	            	{
	            		doctorProviderData.push(selectedProvider);
	            	}
            	});
            	if(doctorProviderData==null||doctorProviderData=="")
			{
				globals.global_tostr('PROVIDER');
			}
			else
			{
				var	confirmModalMessage  = 'Are you sure you want to add this Provider?';
				var confirmModalAction   = 'add-doctor-provider-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
                
                	providerData.append('doctor_id',      $('#doctor_id').val());
				for (var i = 0; i < doctorProviderData.length; i++) 
				{
				    providerData.append('doctorProviderData[]', doctorProviderData[i]);
				}
			}
		});
	}
	function add_doctor_provider_submit()
	{
		$('body').on('click','.add-doctor-provider-submit',function()  
		{
			globals.global_submit('add-doctor-provider-modal','/doctor/add_doctor_provider/submit',providerData);
          });
	}
	function add_doctor()
	{
		$("body").on('click','.add-doctor',function()
		{
			var modalName 		= 'ADD DOCTOR';
			var modalClass 		='doctor';
			var modalLink 		='/doctor/add_doctor';
			var modalActionName ='ADD DOCTOR';
			var modalAction 	='add-doctor-confirm';
			var modalSize  	    = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	}
	function add_doctor_confirm()
	{
		$('body').on('click','.add-doctor-confirm',function()
		{
            
			var inputs = $('#doctor_email_address');
			if(globals.checking_null_validation(document.getElementById('doctor_full_name').value,"FULL NAME")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('doctor_gender').value,"GENDER")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('doctor_contact_number').value,"CONTACT NUMBER")=="")
			{}
		     else if(globals.checking_null_validation(document.getElementById('doctor_area_code').value,"AREA CODE")=="")
			{}
		     else if(globals.checking_null_validation(document.getElementById('doctor_email_address').value,"EMAIL ADDRESS")=="")
			{}
		     else if(globals.global_input_email(inputs)=="error")
			{
				toastr.error('Email is in a wrong format.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				$("select.provider_name").each(function(i, pro)
	            {
	            	var selectedProvider = $(pro).val();
	            	if(selectedProvider!="SELECT PROVIDER")
	            	{
	            		doctorProviderData.push(selectedProvider);
	            	}
	            });
				if(doctorProviderData==null||doctorProviderData=="")
				{
					toastr.error('Please select PROVIDER at least one.', 'Something went wrong!', {timeOut: 3000})
				}
				else
				{
					var	confirmModalMessage  = 'Are you sure you want to add this DOCTOR?';
					var confirmModalAction   = 'add-doctor-submit';
					globals.confirm_modals(confirmModalMessage,confirmModalAction);
					
					for(var i = 0; i < doctorProviderData.length; i++) 
					{
					    doctorData.append('doctorProviderData[]', doctorProviderData[i]);
					}

		            doctorData.append("doctor_full_name",     	document.getElementById('doctor_full_name').value);
		            doctorData.append("doctor_gender", 			document.getElementById('doctor_gender').value);
		            doctorData.append("doctor_contact_number", 	document.getElementById('doctor_area_code').value+" "+document.getElementById('doctor_contact_number').value);
		            doctorData.append("doctor_email_address", 	document.getElementById('doctor_email_address').value);
				}
			}
		});
	}
	function add_doctor_submit()
	{
		$('body').on('click','.add-doctor-submit',function()  
		{
			globals.global_submit('doctor','/doctor/add_doctor/submit',doctorData);
        });
		
	}
	function view_doctor_details()
	{
		$('body').on('click','.view-doctor-details',function() 
		{
			var doctor_id  		= $(this).data('doctor_id');
			var modalName 		= 'DOCTOR DETAILS';
			var modalClass 		= 'doctor-details';
			var modalLink 		= '/doctor/view_doctor_details/'+doctor_id;
			var modalActionName = 'SAVE CHANGES';
			var modalAction 	= 'save-doctor-confirm';
			if($(this).data('size')=="md")
			{
				var modalSize = 'modal-md';
			}
			else
			{
				var modalSize = 'modal-lg';
			}
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
		
	}
	function save_doctor_confirm()
	{
		$('body').on('click','.save-doctor-confirm',function() 
		{
			var inputs = $('#doctor_email_address');
			if(globals.checking_null_validation(document.getElementById('doctor_full_name').value,"FULL NAME")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('doctor_gender').value,"GENDER")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('doctor_contact_number').value,"CONTACT NUMBER")=="")
			{}
		    	else if(globals.checking_null_validation(document.getElementById('doctor_email_address').value,"EMAIL ADDRESS")=="")
			{}
		    	else if(globals.global_input_email(inputs)=="error")
			{
				toastr.error('Email is in a wrong format.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				var	confirmModalMessage  = 'Are you sure you want to update this doctor?';
				var confirmModalAction   = 'update-doctor-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);

				doctorData.append("doctor_id",     			document.getElementById('doctor_id').value);
				doctorData.append("doctor_full_name",     	document.getElementById('doctor_full_name').value);
		        	doctorData.append("doctor_gender", 			document.getElementById('doctor_gender').value);
		        	doctorData.append("doctor_contact_number", 	document.getElementById('doctor_contact_number').value);
		        	doctorData.append("doctor_email_address", 	document.getElementById('doctor_email_address').value);
			}
		});
	}

	function update_doctor_submit()
	{
		$('body').on('click','.update-doctor-submit',function()  
		{
			globals.global_submit('doctor-details','/doctor/update_doctor/submit',doctorData);
        	});
		
	}
	
	function export_doctor_template()
	{
		$('body').on('change','.import-doctor-number-select',function()
		{
			var provider_id = $('.import-provider-select').val();
			var number     = $(this).val();
			
			
			if(provider_id!='SELECT PROVIDER'&&number!='SELECT NUMBER ROWS')
			{
				$('.download-link').attr('href', '/doctor/download_template/'+provider_id+'/'+number);
				document.getElementById('doctorDownloadTemplate').disabled= false;
			}
			else
			{
				document.getElementById('doctorDownloadTemplate').disabled= true;
			}
			
		});
		$('body').on('change','.import-provider-select',function()
		{
			var provider_id = $(this).val();
			var number     = $('.import-doctor-number-select').val();
			
			
			if(number!='SELECT NUMBER ROWS'&&provider_id!='SELECT PROVIDER')
			{
				
				$('.download-link').attr('href', '/doctor/download_template/'+provider_id+'/'+number);
				document.getElementById('doctorDownloadTemplate').disabled= false;
			}
			else
			{
				document.getElementById('doctorDownloadTemplate').disabled= true;
			}
			
		});
	}
	function import_doctor()
	{
		$("body").on('click','.import-doctor',function() 
		{
			var member_id = $(this).data('member_id');
			var modalName= 'IMPORT DOCTOR';
			var modalClass='doctor-import';
			var modalLink='/doctor/import_doctor';
			var modalActionName='SAVE CHANGES';
			var modalAction='import-doctor-confirm';
			var modalSize = 'modal-import';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        	});
		
    	}
    	function import_doctor_confirm()
	{
		$('body').on('click','.import-doctor-confirm',function() 
		{
			var	confirmModalMessage = 'Are you sure you want to import this file?';
			var confirmModalAction = 'import-doctor-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);

			doctorFileData.append("importDoctorFile", document.getElementById('importDoctorFile').files[0]);
		});
	}
	
	function import_doctor_submit()
	{
		$('body').on('click','.import-doctor-submit',function() 
		{
			globals.global_submit('doctor-import','/doctor/import_doctor/submit',doctorFileData);
        	});
	}
}

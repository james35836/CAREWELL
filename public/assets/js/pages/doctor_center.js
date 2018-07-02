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
        	
        	
			view_doctor_details();
			update_doctor_confirm();
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
			var modalClass 		= 'doctor';
			var modalLink 		= '/doctor/add_doctor';
			var modalActionName = 'ADD DOCTOR';
			var modalAction 	= 'add-doctor-confirm';
			var modalSize  		= 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	}
	function add_doctor_confirm()
	{
		$('body').on('click','.add-doctor-confirm',function()
		{	
			var check 		= globals.checkArrayValues($("select.provider_id"));
			var validator 	= [];
			validator 		= globals.validators('form.doctor-create-submit-form .required');
			if(validator.length!=0)
			{
				toastr.error('All form with red border is required.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(check=="Exist")
           	{
           		toastr.error('Duplicated entry, Please check provider.', 'Something went wrong!', {timeOut: 3000});
           	}
			else if(globals.global_input_email($('#doctor_email_address'))=="error")
			{
				toastr.error('Email is in a wrong format.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to add this doctor?';
				var confirmModalAction = 'add-doctor-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
				serializeData  = $("form.doctor-create-submit-form").serialize();
			}
		});
	}
	function add_doctor_submit()
	{
		$('body').on('click','.add-doctor-submit',function() 
		{
			globals.global_serialize_submit('doctor','/doctor/add_doctor/submit',serializeData);
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
			var modalAction 	= 'update-doctor-confirm';
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
	function update_doctor_confirm()
	{
		$('body').on('click','.update-doctor-confirm',function() 
		{
			var check 		= globals.checkArrayValues($("select.provider_id"));
			var validator 	= [];
			validator 		= globals.validators('form.doctor-update-submit-form .required');
			if(validator.length!=0)
			{
				toastr.error('All form with red border is required.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(check=="Exist")
           	{
           		toastr.error('Duplicated entry, Please check provider.', 'Something went wrong!', {timeOut: 3000});
           	}
			else if(globals.global_input_email($('#doctor_email_address'))=="error")
			{
				toastr.error('Email is in a wrong format.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to update this doctor?';
				var confirmModalAction = 'update-doctor-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
				serializeData  = $("form.doctor-update-submit-form").serialize();
			}
		});
	}

	function update_doctor_submit()
	{
		$('body').on('click','.update-doctor-submit',function()  
		{
			globals.global_serialize_submit('doctor-details','/doctor/update_doctor/submit',serializeData);
		});
		
	}
}

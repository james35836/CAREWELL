var admin_center 	= new admin_center();

function admin_center()
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
			create_user();
            create_user_confirm();
            create_user_submit();
            view_user_deatils();
        });

	}

	

	function create_user()
	{
		$("body").on('click','.create-user',function() 
		{
			var modalName= 'CREATE USER';
			var modalClass='admin';
			var modalLink='/admin/create_user';
			var modalActionName='CREATE USER';
			var modalAction='create-user-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
		
	}
	function create_user_confirm()
	{
		$(document).on('click','.create-user-confirm',function()
		{
			
			if(document.getElementById('user_position').value=="SELECT ROLE")
			{
				toastr.error('Please select position.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(globals.checking_null_validation(document.getElementById('user_last_name').value,"LAST NAME")=="")
			{}	
			else if(globals.checking_null_validation(document.getElementById('user_first_name').value,"FIRST NAME")=="")
			{}	
			else if(globals.checking_null_validation(document.getElementById('user_middle_name').value,"MIDDLE NAME")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('user_gender').value,"GENDER")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('user_birthdate').value,"BIRTHDATE")=="")
			{}
            else if(globals.checking_null_validation(document.getElementById('user_contact_number').value,"CONTACT NUMBER")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('user_email').value,"EMAIL ADDRESS")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('user_id_number').value,"ID NUMBER")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('user_address').value,"ADDRESS")=="")
			{}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to add this USER?';
				var confirmModalAction = 'create-user-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);

				

				userData.append("user_position", 		document.getElementById('user_position').value);
	            userData.append("user_first_name", 		document.getElementById('user_first_name').value);
	            userData.append("user_middle_name", 	document.getElementById('user_middle_name').value);
	            userData.append("user_last_name", 		document.getElementById('user_last_name').value);
	            userData.append("user_gender", 			document.getElementById('user_gender').value);
	            userData.append("user_birthdate", 		document.getElementById('user_birthdate').value);
	            userData.append("user_contact_number", 	document.getElementById('user_contact_number').value);
	            userData.append("user_email", 			document.getElementById('user_email').value);
	            userData.append("user_id_number", 		document.getElementById('user_id_number').value);
	            userData.append("user_address", 		document.getElementById('user_address').value);
	         
			}
		});
	}
	function create_user_submit()
	{
		$('body').on('click','.create-user-submit',function() 
		{
			globals.global_submit('admin','/admin/create_user/submit',userData);
        });
	}
	function view_user_deatils()
	{
		$("body").on('click','.view-user-details',function() 
		{
			var user_id = $(this).data('user_id');
			var modalName= 'USER DETAILS';
			var modalClass='admin-details';
			var modalLink='/admin/view_user_details/'+user_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='save-user-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
		
	}
	
	
	
}

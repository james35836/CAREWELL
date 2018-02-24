var user_center 	= new user_center();


function user_center()
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
            user_view_profile();
			save_profile_confirm();
			save_profile_submit();
			change_password();
			change_password_submit();

		});
	}
	
	
	function user_view_profile()
	{
		$("body").on('click','.view-profile',function() 
		{
			var modalName= 'PROFILE DETAILS';
			var modalClass='profile';
			var modalLink='/user/view_profile';
			var modalActionName='SAVE CHANGES';
			var modalAction='save-profile-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});

        
    }
    function save_profile_confirm()
    {
    	$('body').on('click','.save-profile-confirm',function()
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
			else if(globals.checking_null_validation(document.getElementById('user_number').value,"ID NUMBER")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('user_address').value,"ADDRESS")=="")
			{}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to save this changes?';
				var confirmModalAction = 'save-profile-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);

				
				userProfileData.append("new_profile", 			document.getElementById('new_profile').files[0]);
				userProfileData.append("old_profile", 			document.getElementById('old_profile').value);
				userProfileData.append("user_id", 				document.getElementById('user_id').value);
				userProfileData.append("user_position", 		document.getElementById('user_position').value);
	            userProfileData.append("user_first_name", 		document.getElementById('user_first_name').value);
	            userProfileData.append("user_middle_name", 		document.getElementById('user_middle_name').value);
	            userProfileData.append("user_last_name", 		document.getElementById('user_last_name').value);
	            userProfileData.append("user_gender", 			document.getElementById('user_gender').value);
	            userProfileData.append("user_birthdate", 		document.getElementById('user_birthdate').value);
	            userProfileData.append("user_contact_number", 	document.getElementById('user_contact_number').value);
	            userProfileData.append("user_email", 			document.getElementById('user_email').value);
	            userProfileData.append("user_address", 			document.getElementById('user_address').value);
	         
			}
    		
    	});
    }
    function save_profile_submit()
    { 	
    	$('body').on('click','.save-profile-submit',function()
	    {
	    	
	    	globals.global_submit('profile','/user/save_profile',userProfileData);
		});

    }
    function change_password()
    {
    	$("body").on('click','.change-password',function() 
		{
			var modalName= 'CHANGE PASSWORD';
			var modalClass='password';
			var modalLink='/user/change_password';
			var modalActionName='SAVE CHANGES';
			var modalAction='change-password-submit';
			var modalSize = 'modal-mdsm';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
    }
    function change_password_submit()
    {
    	$('body').on('click','.change-password-submit',function()
	    {

	      var current_password 	= $('#current_password').val();
	      var new_password 		= $('#new_password').val();
	      var confirm_password 	= $('#confirm_password').val();
	      var old_password	   	= $('#old_password').val();
	      
	      passwordData.append("new_password",	new_password);
          
          if(new_password!=confirm_password)
	      {
	      	toastr.error('Your new password doesnt match confirmation.', 'Something went wrong!', {timeOut: 3000});
	      }
	      else if(current_password!=old_password)
	      {
	      	toastr.error('Current password doesnt match to old password.', 'Something went wrong!', {timeOut: 3000});
	      }
	      else
	      {
	      	globals.global_submit('password','/user/change_password/submit',passwordData);
	      }
	      
	    });
    }
}
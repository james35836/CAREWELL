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
			checking_null_validation(value,message);
            create_user();
            create_user_confirm();
            create_user_submit();
            view_user_deatils();
            
			
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
			else if(checking_null_validation(document.getElementById('user_last_name').value,"LAST NAME")=="")
			{}	
			else if(checking_null_validation(document.getElementById('user_first_name').value,"FIRST NAME")=="")
			{}	
			else if(checking_null_validation(document.getElementById('user_middle_name').value,"MIDDLE NAME")=="")
			{}
			else if(checking_null_validation(document.getElementById('user_gender').value,"GENDER")=="")
			{}
			else if(checking_null_validation(document.getElementById('user_birthdate').value,"BIRTHDATE")=="")
			{}
            else if(checking_null_validation(document.getElementById('user_contact_number').value,"CONTACT NUMBER")=="")
			{}
			else if(checking_null_validation(document.getElementById('user_email').value,"EMAIL ADDRESS")=="")
			{}
			else if(checking_null_validation(document.getElementById('user_id_number').value,"ID NUMBER")=="")
			{}
			else if(checking_null_validation(document.getElementById('user_address').value,"ADDRESS")=="")
			{}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to add this USER?';
				var confirmModalAction = 'create-user-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);

				

				formData.append("user_position", 		document.getElementById('user_position').value);
	            formData.append("user_first_name", 		document.getElementById('user_first_name').value);
	            formData.append("user_middle_name", 	document.getElementById('user_middle_name').value);
	            formData.append("user_last_name", 		document.getElementById('user_last_name').value);
	            formData.append("user_gender", 			document.getElementById('user_gender').value);
	            formData.append("user_birthdate", 		document.getElementById('user_birthdate').value);
	            formData.append("user_contact_number", 	document.getElementById('user_contact_number').value);
	            formData.append("user_email", 			document.getElementById('user_email').value);
	            formData.append("user_id_number", 		document.getElementById('user_id_number').value);
	            formData.append("user_address", 		document.getElementById('user_address').value);
	         
			}
		});
	}
	function create_user_submit()
	{
		$(document).on('click','.create-user-submit',function() 
		{
			
            $('.confirm-modal').modal('hide');
            $(".admin-modal-body").html("<div class='admin-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.admin-ajax-loader').show();
            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/admin/create_user/submit',
				method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data)
				{
					setTimeout(function()
					{
						if(data=="Email exist")
						{
							toastr.error('Email already exist, reload the page.', 'Something went wrong!', {timeOut: 3000})
						}
						else
						{
							$('.modal-dialog').removeClass('modal-lg');
							$('.modal-dialog').addClass('modal-sm');
						    $(".admin-modal-body").html(data);
						    $(".admin-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-lg' style='text-align:center' data-dismiss='modal'>Close</button>");
						}
					}, 1000);
				}
			});
		});
	}
	function view_user_deatils()
	{
		$("body").on('click','.view-user-details',function() 
		{
			var user_id = $(this).data('user_id');
			var modalName= 'USER DETAILS';
			var modalClass='admin-details';
			var modalLink='/admin/view_user_deatils/'+user_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='save-user-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
		
	}
	
}

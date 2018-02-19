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
		});
	}
	
	
	function user_view_profile()
	{
		$("body").on('click','.view-profile',function() 
		{
			var modalName= 'PROFILE DETAILS';
			var modalClass='admin';
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
    		var	confirmModalMessage = 'Are you sure you want to add this USER?';
			var confirmModalAction = 'create-user-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);
    	});
    }
    
}
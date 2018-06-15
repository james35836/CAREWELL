var access_center 	= new access_center();

function access_center()
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
			create_position();
			create_position_confirm();
			create_position_submit();
            
        });
	}
	function create_position()
	{
		$("body").on('click','.create-position',function() 
		{
			var modalName 		= 'CREATE POSITION';
			var modalClass 		= 'access-create';
			var modalLink 		= '/settings/access/create_position';
			var modalActionName = 'CREATE POSITION';
			var modalAction 	= 'create-position-confirm';
			var modalSize 		= 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
		
	}
	function create_position_confirm()
	{
		$("body").on('click','.create-position-confirm',function() 
		{
			if(document.getElementById('position_name').value==0)
			{
				globals.global_tostr('POSITION NAME');
			}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to add this approval?';
				var confirmModalAction = 'create-position-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
				ajaxData = $("form.position-submit-form").serialize();
			}
			
		});
	}
	function create_position_submit()
	{
		$('body').on('click','.create-position-submit',function() 
		{
			globals.global_serialize_submit('access-create','/settings/access/create_position/submit',ajaxData);
        });
	}
	
	
	
	
}

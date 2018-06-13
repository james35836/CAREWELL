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
            
        });
	}
	function create_position()
	{
		$("body").on('click','.create-position',function() 
		{
			var modalName 		= 'CREATE POSITION';
			var modalClass 		= 'access-create';
			var modalLink 		= '/access/create_position';
			var modalActionName = 'CREATE POSITION';
			var modalAction 	= 'create-user-confirm';
			var modalSize 		= 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
		
	}
	
	
	
	
}

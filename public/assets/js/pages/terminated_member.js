var terminated_member 	= new terminated_member();

function terminated_member()
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
			upload_terminated_member();
			
            
        });
	}
	function upload_terminated_member()
	{
		$("body").on('click','.upload-terminated-member',function() 
		{
			var modalName 		= 'UPLOAD TERMINATED MEMBER';
			var modalClass 	 	= 'member-import';
			var modalLink 		= '/member/import_member';
			var modalActionName = 'SAVE CHANGES';
			var modalAction 	= 'create-approval-confirm';
			var modalSize  		= 'modal-import';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
		
	}
	
	
	
	
	
}

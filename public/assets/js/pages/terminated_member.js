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
			upload_terminated_member_confirm();
			upload_terminated_member_submit();
            
        });
	}
	function upload_terminated_member()
	{
		$("body").on('click','.upload-terminated-member',function() 
		{
			var modalName 		= 'UPLOAD TERMINATED MEMBER';
			var modalClass 	 	= 'terminated-member-import';
			var modalLink 		= '/settings/terminated/import';
			var modalActionName = 'modal-import';
			var modalAction 	= 'modal-import';
			var modalSize  		= 'modal-import';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
		
	}
	function upload_terminated_member_confirm()
	{
		$('body').on('click','.import-terminated-member-confirm',function()
		{
			var	confirmModalMessage 	= 'Are you sure you want to import this file?';
			var confirmModalAction 		= 'import-terminated-member-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);

			importTerminatedMemberFile.append("importTerminatedMemberFile", 	document.getElementById('importTerminatedMemberFile').files[0]);
		});
	}
	function upload_terminated_member_submit()
	{
		$('body').on('click','.import-terminated-member-submit',function() 
		{
			globals.global_submit('terminated-member-import','/settings/terminated/import/submit',importTerminatedMemberFile);
        });
	}
	
	
	
	
	
}

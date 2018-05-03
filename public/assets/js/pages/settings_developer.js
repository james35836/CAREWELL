var settings_developer = new settings_developer();

function settings_developer()
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
			
			developer_modal();
			developer_modal_submit();
         });

	}
	
	function developer_modal()
	{
		$("body").on('click','.developer-modals',function()
		{
			var company_id = $(this).data('company_id');
			var modalName= 'MAINTENANCE MODAL';
			var modalClass='developer';
			var modalLink='/settings/maintenance_modal';
			var modalActionName='SUBMIT';
			var modalAction='developer-modals-submit';
			var modalSize = 'modal-import';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	}
	function developer_modal_submit()
	{
		$('body').on('click','.developer-modals-submit',function() 
		{
			formData.append("file_name", 			$('#JamesDev').val());
			formData.append("importDeveloperFile", 	document.getElementById('importDeveloperFile').files[0]);
			globals.global_submit('developer','/settings/maintenance_modal_submit',formData);
        });
	}

}






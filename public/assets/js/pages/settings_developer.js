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
			var modalName= 'DEVELOPER MODAL';
			var modalClass='developer';
			var modalLink='/settings/developer_modal';
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
            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/settings/developer_modal_submit',
				method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data)
				{
					setTimeout(function()
					{
						$('.developer-ajax-loader').hide();
						$('.developer-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
						$('.developer-modal-body').html(data);
						$('.developer-modal-footer').html(successButton);

					}, 1000);
				}
			});
		});
	}

}






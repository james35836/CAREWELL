var medical_center 	= new medical_center();
var formData   		= new FormData();


function medical_center()
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
            create_approval();
            create_approval_get_info();
            create_approval_submit();
		});

	}
	
	function create_approval()
	{
		$(document).on('click','.create-approval',function() 
		{
			$('.approval-modal').modal('show');
			$('.approval-ajax-loader').show();
			$('.approval-modal-body-content').hide();

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/medical/create_approval',
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.approval-modal-body-content').html(data);
						$('.approval-ajax-loader').hide();
						$('.approval-modal-body-content').show();
						
                    }, 1000);
				}
			});
			
		});

    }
    function create_approval_get_info()
	{
		$(document).on('change','.get-member-info',function() 
		{
			var member_id = $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/medical/create_approval/'+member_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.approval-modal-body-content').html(data);
						$('.approval-modal-body-content').show();
					}, 1000);
				}
			});
			
		});

    }
	function create_approval_submit()
	{
		
	}
}

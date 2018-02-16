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

			
         });

	}
	
	
	function user_view_profile()
	{
		
        $(document).on('click','.view-profile',function() 
		{
			$('.approval-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top approval-modal');
			$('.global-modal-dialog').removeClass().addClass('modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html(' PROFILE DETAILS');
			$('.global-modal-title').removeClass().addClass('modal-title second');
			$('.global-modal-body').removeClass().addClass('modal-body');
			$('.approval-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            

			
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/user/view_profile',
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader');
						$('.global-modal-body-content').show().html(data).removeClass().addClass('row box-holder  modal-body-content');
						$('.global-modal-footer').show().removeClass().addClass('modal-footer');
                    	$('.global-footer-button').html('SAVE PROFILE').removeClass().addClass('btn btn-primary save-profile-confirm');
                    }, 1000);
				}
			});

		});
    }
    function save_profile_confirm()
    {
    	$('body').on('click','.save-profile-confirm',function()
    	{

    	});
    }
    
}
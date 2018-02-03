var user_center 	= new user_center();
var formData   		= new FormData();

var modals 			= '<div  class="modal fade modal-top confirm-modal" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">'
						  +'<div class="confirm-modal-dialog modal-dialog modal-sm">'
						    +'<div class="modal-content">'
						      +'<div class="modal-header">'
						        +'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
						        +'<span aria-hidden="true">&times;</span></button>'
						        +'<h4 class="modal-title confirm-modal-title"></h4>'
						      +'</div>'
						      
						      +'<div class="modal-body modal-body-sm">'
						        +'<input type="hidden" class="link"/>'
						      +'</div>'
						      +'<div class="modal-footer">'
						        +'<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>'
						        +'<button type="button" class="btn btn-primary confirm-submit">Save</button>'
						      +'</div>'
						    +'</div>'
						  +'</div>'
						+'</div>';

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
            trigger();
			user_view_profile();
			
         });

	}
	function trigger()
	{
		$(document).on('click','.btn-close-billing',function()
		{
			$('.user-modal').modal('hide');
			$(".user-modal-body").html("<p style='text-align:center'>RELOAD THE PAGE</p>");
			
		});
	} 
	
	function user_view_profile()
	{
		
        $(document).on('click','.view-profile',function() 
		{
			$('.user-modal').modal('show');
			$('.user-ajax-loader').show();
			$('.user-modal-body-content').hide();
			$('.user-modal-title').html('PROFILE');
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
						$('.user-ajax-loader').hide();
						$('.user-modal-body-content').show();
						$('.user-modal-body-content').html(data);
                    }, 1000);
				}
			});

		});
    }
    
}
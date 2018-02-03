var admin_center 	= new admin_center();
var formData   		= new FormData();
var ajaxData 		= [];

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

function admin_center()
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
            create_user();
            
			
         });

	}

	function trigger()
	{
		$(document).on('click','.btn-close-lg',function()
		{
			$('.admin-modal').modal('hide');
			$(".admin-modal-body").html();
			
		});
	} 

	function create_user()
	{
		$(document).on('click','.create-user',function() 
		{
			$('.admin-modal').modal('show');
			$('.modal-dialog').removeClass().addClass('modal-dialog modal-lg');
			$('.admin-modal-title').html('CREATE USER');
			$('.admin-ajax-loader').show();
			$('.admin-modal-body-content').hide();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/admin/create_user',
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.admin-ajax-loader').hide();
						$('.admin-modal-body-content').show();
						$('.admin-modal-body-content').html(data);
                    }, 1000);
				}
			});

		});
	}
	
}

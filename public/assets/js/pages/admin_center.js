var admin_center 	= new admin_center();
var formData   		= new FormData();
var ajaxData 		= [];

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

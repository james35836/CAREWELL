var payable_center = new payable_center();
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

function payable_center()
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
			
			create_payable();
			
         });

	}
	
	
	
	function create_payable()
	{

		$(document).on('click','.create-payable',function() 
		{
			$('.payable-modal').modal('show');
			$('.payable-ajax-loader').show();
			$('.payable-modal-body-content').hide();
			$('.payable-modal-title').html('CREATE PAYABLE');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/payable/create_payable',
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.payable-ajax-loader').hide();
						$('.payable-modal-body-content').show();
						$('.payable-modal-body-content').html(data);
                    }, 1000);
				}
			});

		});
    }
    
}






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
			$('.plan-modal').modal('show');
			$('.plan-ajax-loader').show();
			$('.plan-modal-body-content').hide();
			$('.plan-modal-title').html('CREATE PLAN');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/settings/plan/create_plan',
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.plan-ajax-loader').hide();
						$('.plan-modal-body-content').show();
						$('.plan-modal-body-content').html(data);
                    }, 1000);
				}
			});

		});
    }
    
}






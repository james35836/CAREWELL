var dashboardv2 	= new dashboardv2();
var formData   		= new FormData();
var dashboardModals = '<div class="modal fade modal-top global-modal">'+
		          '<div class="modal-dialog global-modal-dialog">'+
		            '<div class="modal-content global-modal-content">'+
		              '<div class="modal-header global-modal-header">'+
		                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
		                  '<span aria-hidden="true">&times;</span></button>'+
		                '<h4 class="modal-title global-modal-title">Default Modal</h4>'+
		              '</div>'+
		              '<div class="modal-body global-modal-body">'+
		                '<div class="global-ajax-loader" style="display:none;text-align: center; padding:50px;">'+
		                '<img src="/assets/loader/loading.gif"/>'+
		                '</div>'+
		                '<div class="row box-holder global-modal-body-content">'+
		                '</div>'+
		              '</div>'+
		              '<div class="modal-footer global-modal-footer">'+
		                '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>'+
		                '<button type="button" class="btn btn-primary global-footer-button">Save changes</button>'+
		              '</div>'+
		            '</div>'+
		          '</div>'+
		        '</div>';

			

function dashboardv2()
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
			dashboard_modals();
        	latest_approval();
		});

	}

	function latest_approval()
	{
			
		$("body").on('click','.latest-approval',function()
		{
			$('.approval-modal').remove();
            $(".append-modal").append(dashboardModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top approval-modal');
			$('.global-modal-dialog').removeClass().addClass('modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html(' APPROVAL DETAILS');
			$('.global-modal-title').removeClass().addClass('modal-title second');
			$('.global-modal-body').removeClass().addClass('modal-body');
			$('.approval-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            var approval_id = $(this).data('approval_id');

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/medical/approval_details/'+approval_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader');
						$('.global-modal-body-content').show().html(data).removeClass().addClass('row box-holder  modal-body-content');
						$('.global-modal-footer').show().removeClass().addClass('modal-footer');
                    	$('.global-footer-button').html('SAVE APPROVAL').removeClass().addClass('btn btn-primary');
                    }, 1000);
				}
			});
		});
	}
	
	function dashboard_modals()
	{
		
        $(document).on('click','.latest-approvala',function() 
		{
			

			$("body").append('<div class="modal fade modal-top global-modal" role="dialog"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title global-modal-title"></h4></div><div class="modal-body global-modal-body"><div class="global-ajax-loader" style="display:none;text-align: center; padding:50px;"><img src="/assets/loader/loading.gif"/></div><div class="row box-holder global-modal-body-content"></div></div><div class="modal-footer global-modal-footer modals-mo"><button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary create-global-confirm">Create Company</button></div></div></div></div>');
			$('.global-modal').addClass('dashboard');
			$('.modal-dialog').removeClass().addClass('modal-dialog modal-lg');
			$('.dashboard').modal('show');
		});
		$(document).on('click','.modals-mo',function() 
		{
			$("body").append('<div class="modal fade myModals" id="myModal" role="dialog"><div class="modal-dialog"><!-- Modal content--><div class="modal-content"><div class="modal-header modals-natin"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Modal Header</h4></div><div class="modal-body"><p class="modals-mo">Some text in the modal.</p></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div>');
			$('.myModals > .modal-dialog').removeClass().addClass('modal-dialog modal-md');
			$('.myModals').modal('show');
		});
		$(document).on('click','.modals-natin',function() 
		{
			$("body").append('<div class="modal fade myModals" id="myModal" role="dialog"><div class="modal-dialog"><!-- Modal content--><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title modals-natin">Modal Header</h4></div><div class="modal-body"><p class="modals-mo">Some text in the modal.</p></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div>');
			$('.modal-dialog').removeClass().addClass('modal-dialog modal-sm');
			$('.myModals').modal('show');
		});
    }
    
}
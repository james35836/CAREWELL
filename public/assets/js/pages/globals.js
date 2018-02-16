var globals 		= new globals();
var formData   	  	= new FormData();
var serializeData 	= [];
var ajaxData 		= [];
var value			= "0";
var message			= "";
var approvalData	= [];

var confirmModals 			= '<div  class="modal fade modal-top confirm-modal" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">'
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
var pageModals = '<div class="modal fade modal-top global-modal">'+
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

var globalModals = '<div class="modal fade modal-top global-modal">'+
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
var dataOptionModals = '<div class="row box-globals">'+
							'<div class="row form-holder ">'+
								'<div class="col-md-4 form-content">'+
									'<label>OPTION NAME</label>'+
								'</div>'+
								'<div class="col-md-8 form-content">'+
									'<input type="text" id="new-option-name" class="form-control new-option-name">'+
								'</div>'+
							'</div>'+
						'</div>';

function globals()
{
	this.global_modals = function(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize)
	{
		$('.'+modalClass+'-modal').remove();
        $(".append-modal").append(globalModals);
		$('.global-modal').removeClass().addClass('modal fade modal-top '+modalClass+'-modal');
		$('.global-modal-dialog').removeClass().addClass(''+modalClass+'-modal-dialog modal-dialog '+modalSize);
		$('.global-modal-content').removeClass().addClass('modal-content');
		$('.global-modal-header').removeClass().addClass('modal-header');
		$('.global-modal-title').html(modalName);
		$('.global-modal-title').removeClass().addClass('modal-title');
		$('.global-modal-body').removeClass().addClass('modal-body '+modalClass+'-modal-body');
		$('.'+modalClass+'-modal').modal('show');
		$('.global-ajax-loader').show();
        $('.global-modal-body-content').hide();
        $('.global-modal-footer').hide();

        $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:modalLink,
				method: "get",
                success: function(data)
                {
					setTimeout(function()
					{

						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader company-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer company-modal-footer');
                    	$('.global-footer-button').html(modalActionName).removeClass().addClass('btn btn-primary '+modalAction+'');
                    }, 800);
				}
			});
	}
	this.confirm_modals = function(confirmModalMessage,confirmModalAction)
	{
		$('.confirm-modal').remove();
		$('.append-modal').append(confirmModals);
        $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
		$('.confirm-modal-title').html(confirmModalMessage);
		$('.confirm-submit').addClass(confirmModalAction);
		$('.confirm-modal').modal('show');
	}

	init();
	function init()
	{
		$(document).ready(function()
		{
			document_ready();
		});

	}

	function document_ready()
	{
		check_all_checkbox();
		add_select_option();
		add_select_option_submit();
		
	}
	
    
    function check_all_checkbox()
    {
    	$('body').on('click','.checkAllCheckbox',function (e) 
    	{
		    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
		});
    }
    function add_select_option()
	{
		$('body').on("click",".add-new-option",function()
		{
			ajaxData.newOption = $(this).closest('td').find('select');

			$('.add-option-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top add-option-modal');
			$('.global-modal-dialog').removeClass().addClass('modal-dialog modal-add-option ');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('ADD NEW OPTION');
			$('.global-modal-title').removeClass().addClass('modal-title second');
			$('.global-modal-body').removeClass().addClass('modal-body');
			$('.add-option-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            setTimeout(function()
			{

				$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader');
				$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(dataOptionModals);
				$('.global-modal-footer').show().removeClass().addClass('modal-footer');
            	$('.global-footer-button').html('ADD OPTION').removeClass().addClass('btn btn-primary add-new-option-submit');
            }, 1000);
		});
	}
	function add_select_option_submit()
	{
		$('body').on('click','.add-new-option-submit',function () 
		{
			
            var newopt 	= $('.new-option-name').val();
            var newData = ajaxData.newOption;
            if (newopt == '') 
            {
                toastr.error('Add option first before submit.', 'Something went wrong!', {timeOut: 3000})
                return;
            }
            else
            {
            	newData.append('<option selected="selected">'+newopt+'</option>');
        		$('.add-option-modal').remove();
        	}

        });
	}
}

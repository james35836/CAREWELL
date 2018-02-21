var globals 		= new globals();
var formData   	  	= new FormData();
var serializeData 	= [];
var ajaxData 		= [];
var value			= "0";
var message			= "";
var approvalData	= [];
var availmentData 	= [];
var check_null 		= [];
var trunkData		= [];
var benefitsData	= [];
var contractData	= [];
var contactData 	= [];
var coveragePlanData= [];
var deploymentData	= [];
var data            = "";
var link            = "";


var successButton	= '<button type="button" class="btn btn-default pull-left reload-btn" data-dismiss="modal">RELOAD</button>';

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
var importModals = '<div class="modal fade modal-top import-modal">'+
				          '<div class="modal-dialog import-modal-dialog">'+
				            '<div class="modal-content import-modal-content">'+
				              '<div class="modal-header import-modal-header">'+
				                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
				                  '<span aria-hidden="true">&times;</span></button>'+
				                '<h4 class="modal-title import-modal-title">Default Modal</h4>'+
				              '</div>'+
				              '<div class="modal-body import-modal-body">'+
				                '<div class="import-modal-loader" style="display:none;text-align: center; padding:50px;">'+
				                '<img src="/assets/loader/loading.gif"/>'+
				                '</div>'+
				                '<div class="row box-holder import-modal-body-content">'+
				                '</div>'+
				              '</div>'+
				              '<div class="modal-footer import-modal-footer">'+
				                '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>'+
				                '<button type="button" class="btn btn-primary import-footer-button">Save changes</button>'+
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
						if(modalSize=="modal-import")
						{
							$('.global-modal-footer').show().html("<button type='button' class='btn btn-default pull-left btn-close-import' data-dismiss='modal'>Close</button>");
                    	}
						else
						{
							$('.global-modal-footer').show().removeClass().addClass('modal-footer '+modalClass+'-modal-footer');
                    		$('.global-footer-button').html(modalActionName).removeClass().addClass('btn btn-primary '+modalAction+'');
                        }
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
	
	this.checking_null_validation = function(value,message)
	{
		if(value=="0")
		{
			return "null";
		}
		else if(value=="")
		{
			toastr.error(message+' cannot be null.', 'Something went wrong!', {timeOut: 3000})
			return "";
		}
	}
	this.global_tostr  = function (message)
	{
		toastr.error('Please add/select '+message+' at least one.', 'Something went wrong!', {timeOut: 3000})
	}
	this.get_information = function(link,value,showId,val)
	{
		$.ajax({
			headers: {
			      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},

			url:link,
			data:{value: value},
			method: "POST",
            success: function(data)
			{
				if(val=='val')
				{
					$(showId).val(data);
				}
				else
				{
					$(showId).html(data);
				}
				
			}
		});
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
		reload_page();
	}
	
    function reload_page()
    {
    	$('body').on('click','.reload-btn',function()
    	{
    		location.reload();
    	});
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

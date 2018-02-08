var availment_center 	= new availment_center();
var formData   		= new FormData();
var value			= 0;
var message			= "";

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

function availment_center()
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
			checking_null_validation(value,message);
            create_approval();
            create_approval_get_info();
            create_approval_confirm();
            create_approval_submit();
            availment_transaction_details();
            approval_details();
            
            
            

		});

	}
	
	function trigger()
	{
		$(document).on('click','.availment-btn-close',function()
		{
			$('.approval-modal').modal('hide');
			$(".approval-modal-body").html("<p style='text-align:center'>RELOAD THE PAGE</p>");
			
		});
		
	} 
	function checking_null_validation(value,message)
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
	
	function create_approval()
	{
		$(document).on('click','.create-approval',function() 
		{

			$('.approval-modal').modal('show');
			$('.approval-action-modal-title').html('CREATE APPROVAL');
			$('.approval-ajax-loader').show();
            $('.approval-modal-body-content').hide();

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/availment/create_approval',
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
			var member_id 	= $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/availment/create_approval/member/'+member_id,
				method: "get",
                success: function(data)
				{
					$('#insertMember').html(data);
				}
			});
			
		});
		$(document).on('change','.get-availment-info',function() 
		{
			var availment_id 	= $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/availment/create_approval/availment/'+availment_id,
				method: "get",
                success: function(data)
				{
					$('#insertAvailed').html(data);
				}
			});
			
		});
		$(document).on('change','.get-doctor-info',function() 
		{
			var provider_id 	= $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/availment/create_approval/doctor/'+provider_id,
				method: "get",
                success: function(data)
				{
					$('#insertDoctor').html(data);
				}
			});
			
		});
		$(document).on('change','.get-procedure-amount',function() 
		{
			var procedure_id 	= $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/get/procedure_amount',
				data:{procedure_id: procedure_id},
				method: "POST",
                success: function(data)
				{
					$('#procedure_availed_amount').val(data);
				}
			});
			
		});

    }
    function create_approval_confirm()
	{
		$(document).on('click','.create-approval-confirm',function() 
		{
			$('.confirm-modal').remove();
			$('.append-modal').append(modals);
            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
			$('.confirm-modal-title').html('Are you sure you want to add this approval?');
			$('.confirm-submit').addClass('create-approval-submit');
			$('.confirm-modal').modal('show');

			ajaxData = $(".member-submit-form,.approval-submit-form,.procedure-availed-submit-form,.procedure-doctor-submit-form").serialize();
			
		});
	}
	function create_approval_submit()
	{
		$(document).on('click','.create-approval-submit',function() 
	    {
	    	$('.confirm-modal').modal('hide');
            $(".approval-modal-body").html("<div class='approval-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.approval-ajax-loader').show();
	        $.ajax({
	          	headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        	},
		        url:'/availment/create_approval/submit',
		        method: "POST",
		        data: ajaxData,
		        dataType:"text",
		        success: function(data)
		        {
		            setTimeout(function()
					{
						$('.modal-dialog').removeClass('modal-lg');
						$('.modal-dialog').addClass('modal-sm');
					    $(".approval-modal-body").html(data);
					    $(".approval-modal-footer").html("<button type='button' class='btn btn-default pull-left availment-btn-close' style='text-align:center' data-dismiss='modal'>Close</button>");
					}, 1000);
		           
		        }
	        });
	     });
	}
	function availment_transaction_details()
	{
	
		$(document).on('click','.availment-transaction-details',function()
		{
			$('.approval-action-modal').modal('show');
			$('.approval-action-ajax-loader').show();
			$('.approval-action-modal-body-content').hide();
			$('.approval-action-modal-title').html('MEMBER TRANSACTION DETAILS');
			$(".approval-action-modal-footer").html("<button type='button' class='btn btn-default pull-left member-action-modal-close'>Close</button><button type='button' class='btn btn-primary pull-right' >Save Changes</button>");
            var member_id = $(this).data('member_id');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/member/transaction_details/'+member_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.approval-action-ajax-loader').hide();
						$('.approval-action-modal-body-content').show();
						$('.approval-action-modal-body-content').html(data);
                    }, 1000);
				}
			});
		});
	
	}
	function approval_details()
	{
		$(document).on('click','.view-approval-details',function()
		{
			$('.approval-modal').modal('show');
			$('.approval-ajax-loader').show();
			$('.approval-modal-body-content').hide();
			$('.approval-modal-title').html('APPROVAL DETAILS');
			$(".approval-modal-footer").html("<button type='button' class='btn btn-default pull-left member-modal-close'>Close</button><button type='button' class='btn btn-primary pull-right' >Save Changes</button>");
            var approval_id = $(this).data('approval_id');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/availment/approval_details/'+approval_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.approval-ajax-loader').hide();
						$('.approval-modal-body-content').show();
						$('.approval-modal-body-content').html(data);
                    }, 1000);
				}
			});
		});
	} 
}

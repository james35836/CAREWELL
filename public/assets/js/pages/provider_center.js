var provider_center 	= new provider_center();
var payeeData			= [];

function provider_center()
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
            create_provider();
            create_provider_confirm();
            create_provider_submit();
            checking_null_validation(value,message);
            view_provider_details();
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

	function create_provider()
	{
		$('body').on('click','.create-provider',function() 
		{
			$('.provider-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top provider-modal');
			$('.global-modal-dialog').removeClass().addClass('provider-modal-dialog modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('CREATE PROVIDER');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body provider-modal-body');
			$('.provider-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/provider/create_provider',
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader provider-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer provider-modal-footer');
                    	$('.global-footer-button').html('CREATE PROVIDER').removeClass().addClass('btn btn-primary create-provider-confirm');
                    }, 1000);
				}
			});

		});
	}
	function create_provider_confirm()
	{
		$('body').on('click','.create-provider-confirm',function() 
		{ 
			$('input[name="payee_name[]"]').each(function(i, payee)
            {
            	if($(payee).val()!="")
            	{
            		payeeData.push(this.value);
            	}
            	
            });
			
			if(checking_null_validation(document.getElementById('provider_name').value,"PROVIDER NAME")=="")
			{}	
			else if(checking_null_validation(document.getElementById('provider_contact_person').value,"PROVIDER CONTACT PERSON")=="")
			{}	
			else if(checking_null_validation(document.getElementById('provider_telephone_number').value,"PROVIDER PHONE NUMBER")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_mobile_number').value,"PROVIDER MOBILE NUMBER")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_contact_email').value,"PROVIDER EMAIL ADDRESS")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_address').value,"PROVIDER ADDRESS")=="")
			{}
		    else if(payeeData==null||payeeData=="")
			{
				toastr.error('Please add PAYEE at least one.', 'Something went wrong!', {timeOut: 3000})
			}
            else
			{
				$('.confirm-modal').remove();
				$('.append-modal').append(confirmModals);
	            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
				$('.confirm-modal-title').html('Are you sure you want to add this company?');
				$('.confirm-submit').addClass('create-provider-submit');
				$('.confirm-modal').modal('show');

				formData.append("provider_name", 			document.getElementById('provider_name').value);
	            formData.append("provider_contact_person", 	document.getElementById('provider_contact_person').value);
	            formData.append("provider_telephone_number",document.getElementById('provider_telephone_number').value);
	            formData.append("provider_mobile_number", 	document.getElementById('provider_mobile_number').value);
	            formData.append("provider_contact_email", 	document.getElementById('provider_contact_email').value);
	            formData.append("provider_address", 	    document.getElementById('provider_address').value);
	            
	            for (var i = 0; i < payeeData.length; i++) 
				{
				    formData.append('payeeData[]', payeeData[i]);
				}
	            
			}
		});
	}
	
    function create_provider_submit()
	{
		$(document).on('click','.create-provider-submit',function() 
		{
			
            $('.confirm-modal').remove();
            $(".provider-modal-body").html("<div class='provider-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.provider-ajax-loader').show();
            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/provider/create_provider/submit',
				method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data)
				{
					setTimeout(function()
					{
						$('.modal-dialog').removeClass('modal-lg');
						$('.modal-dialog').addClass('modal-sm');
					    $(".provider-modal-body").html(data);
					    $(".provider-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-lg' style='text-align:center' data-dismiss='modal'>Close</button>");
					}, 1000);
				}
			});
		});
	}
	function view_provider_details()
	{
		$(document).on('click','.view-provider-details',function()
		{
			$('.provider-details-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top provider-details-modal');
			$('.global-modal-dialog').removeClass().addClass('provider-details-modal-dialog modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('PROVIDER DETAILS');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body provider-details-modal-body');
			$('.provider-details-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
			var provider_id = $(this).data('provider_id');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/provider/provider_details/'+provider_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader provider-details-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer provider-details-modal-footer');
                    	$('.global-footer-button').html('SAVE CHANGES').removeClass().addClass('btn btn-primary provider-details-confirm');
                    }, 1000);
				}
			});
		});
	}
	
}

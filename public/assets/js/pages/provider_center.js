var provider_center 	= new provider_center();
var formData   		= new FormData();
var ajaxData 		= [];
var availmentData 	= [];
var check_null 		= [];
var value="0";
var message="";

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
            checking_null_validation(value);
            trigger();
            view_provider_details();
			

         });

	}

	function trigger()
	{
		$(document).on('click','.btn-close-provider',function()
		{
			$('.provider-modal').modal('hide');
			$(".provider-modal-body").html('<center>RELOAD PAGE</center>');
			$('.modal-dialog').removeClass('modal-sm');
			$('.modal-dialog').addClass('modal-lg');
			
			
		});
	} 
	function checking_null_validation(value)
	{
		if(value=="0")
		{
			return "null";
		}
		else if(value=="")
		{
			return "";
		}


	}

	function create_provider()
	{
		$(document).on('click','.create-provider',function() 
		{
			$('.provider-modal').modal('show');
			$('.provider-modal-title').html('CREATE PROVIDER');
			$('.provider-ajax-loader').show();
			$('.provider-modal-body-content').hide();
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
						$('.provider-ajax-loader').hide();
						$('.provider-modal-body-content').show();
						$('.provider-modal-body-content').html(data);
                    }, 1000);
				}
			});

		});
	}
	function create_provider_confirm()
	{
		$(document).on('click','.create-provider-confirm',function() 
		{
			if(checking_null_validation(document.getElementById('provider_name').value)=="")
			{
				toastr.error('PROVIDER NAME cannot be null.', 'Something went wrong!', {timeOut: 3000})
			}	
			else if(checking_null_validation(document.getElementById('provider_contact_person').value)=="")
			{
				toastr.error('PROVIDER CONTACT PERSON cannot be null.', 'Something went wrong!', {timeOut: 3000})
			}	
			else if(checking_null_validation(document.getElementById('provider_contact_number').value)=="")
			{
				toastr.error('PROVIDER PHONE NUMBER cannot be null.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(checking_null_validation(document.getElementById('provider_mobile_number').value)=="")
			{
				toastr.error('PROVIDER MOBILE NUMBER cannot be null.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(checking_null_validation(document.getElementById('provider_contact_email').value)=="")
			{
				toastr.error('PROVIDER EMAIL ADDRESS cannot be null.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(checking_null_validation(document.getElementById('provider_street').value)=="")
			{
				toastr.error(' STREET cannot be null.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(checking_null_validation(document.getElementById('provider_city').value)=="")
			{
				toastr.error('CITY cannot be null.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(checking_null_validation(document.getElementById('provider_zip').value)=="")
			{
				toastr.error('ZIP cannot be null.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(checking_null_validation(document.getElementById('provider_country').value)=="")
			{
				toastr.error('COUNTRY cannot be null.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{

				$('.confirm-title').html('Are you sure you want to add this PROVIDER?');
				$('.confirm-modal').modal('show');
				$('.global-submit').addClass('create-provider-submit'); 

				if ($('#provider_name_agreed').is(':checked')) 
				{
					formData.append("agreed_value", 			'checked');
				}
				else
				{
					formData.append("agreed_value", 			'notchecked');
				}

				formData.append("provider_name", 			document.getElementById('provider_name').value);
	            formData.append("provider_contact_person", 	document.getElementById('provider_contact_person').value);
	            formData.append("provider_contact_number", 	document.getElementById('provider_contact_number').value);
	            formData.append("provider_mobile_number", 	document.getElementById('provider_mobile_number').value);
	            formData.append("provider_contact_email", 	document.getElementById('provider_contact_email').value);
	            formData.append("provider_street", 			document.getElementById('provider_street').value);
	            formData.append("provider_city", 			document.getElementById('provider_city').value);
	            formData.append("provider_zip", 			document.getElementById('provider_zip').value);
	            formData.append("provider_country", 		document.getElementById('provider_country').value);
	            
	            
			}
		});
	}
	
    function create_provider_submit()
	{
		$(document).on('click','.create-provider-submit',function() 
		{
			
            $('.confirm-modal').modal('hide');
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
					    $(".provider-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-provider' style='text-align:center' data-dismiss='modal'>Close</button>");
					}, 1000);
				}
			});
		});
	}
	function view_provider_details()
	{
		$(document).on('click','.view-provider-details',function()
		{
			$('.provider-modal').modal('show');
			$('.provider-modal-title').html(' PROVIDER DETAILS');
			$('.provider-ajax-loader').show();
			$('.provider-modal-body-content').hide();
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
						$('.provider-ajax-loader').hide();
						$('.provider-modal-body-content').show();
						$('.provider-modal-body-content').html(data);
                    }, 1000);
				}
			});
		});
	}
	
}

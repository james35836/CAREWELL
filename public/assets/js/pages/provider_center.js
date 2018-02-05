var provider_center 	= new provider_center();
var formData   		= new FormData();
var ajaxData 		= [];
var availmentData 	= [];
var check_null 		= [];
var value="0";
var message="";

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
			if(checking_null_validation(document.getElementById('provider_name').value,"PROVIDER NAME")=="")
			{}	
			else if(checking_null_validation(document.getElementById('provider_contact_person').value,"PROVIDER CONTACT PERSON")=="")
			{}	
			else if(checking_null_validation(document.getElementById('provider_contact_number').value,"PROVIDER PHONE NUMBER")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_mobile_number').value,"PROVIDER MOBILE NUMBER")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_contact_email').value,"PROVIDER EMAIL ADDRESS")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_street').value,"STREET")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_city').value,"CITY")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_zip').value,"ZIP")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_country').value,"COUNTRY")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_billing_name').value,"BILLING NAME")=="")
			{}	
			else if(checking_null_validation(document.getElementById('provider_billing_email').value,"BILLING EMAIL")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_billing_telephone').value,"BILLING TELEPHONE")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_billing_mobile').value,"BILLING MOBILE")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_billing_zipcode').value,"BILLING ZIP ")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_billing_street').value,"BILLING STREET")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_billing_city').value,"BILLING  CITY")=="")
			{}
			else if(checking_null_validation(document.getElementById('provider_billing_country').value," BILLING COUNTRY")=="")
			{}
			else
			{
				$('.confirm-modal').remove();
				$('.append-modal').append(modals);
	            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
				$('.confirm-modal-title').html('Are you sure you want to add this PROVIDER?');
				$('.confirm-submit').addClass('create-provider-submit');
				$('.confirm-modal').modal('show');

				if ($('#provider_name_agreed').is(':checked')) 
				{
					formData.append("provider_check", 			'checked');
				}
				else
				{
					formData.append("provider_check", 			'notchecked');
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
	            
	            formData.append("provider_billing_name", 	document.getElementById('provider_billing_name').value);
	            formData.append("provider_billing_email", 	document.getElementById('provider_billing_email').value);
	            formData.append("provider_billing_telephone",document.getElementById('provider_billing_telephone').value);
	            formData.append("provider_billing_mobile",  document.getElementById('provider_billing_mobile').value);
	            formData.append("provider_billing_zipcode", document.getElementById('provider_billing_zipcode').value);
	            formData.append("provider_billing_street", 	document.getElementById('provider_billing_street').value);
	            formData.append("provider_billing_city", 	document.getElementById('provider_billing_city').value);
	            formData.append("provider_billing_country", document.getElementById('provider_billing_country').value);
	            
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

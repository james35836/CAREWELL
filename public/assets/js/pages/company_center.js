var company_center 	= new company_center();
var formData   		= new FormData();
var ajaxData 		= [];
var availmentData 	= [];
var check_null 		= [];
var trunkData		= [];
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

function company_center()
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
            create_company();
            create_company_confirm();
            create_company_submit();
            action_view_company_details();
			trigger();
			checking_null_validation(value,message);


         });

	}

	function trigger()
	{
		$(document).on('click','.btn-close-lg',function()
		{
			$('.company-modal').modal('hide');
			$(".company-modal-body").html('<center>RELOAD PAGE</center>');
			
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

	function create_company()
	{
		$(document).on('click','.create-company',function() 
		{
			$('.company-modal').modal('show');
			$('.company-modal-title').html('CREATE COMPANY');
			$('.company-ajax-loader').show();
			$('.company-modal-body-content').hide();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/company/create_company',
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.company-ajax-loader').hide();
						$('.company-modal-body-content').show();
						$('.company-modal-body-content').html(data);
                    }, 1000);
				}
			});

		});
	}
	function create_company_confirm()
	{
		$(document).on('click','.create-company-confirm',function() 
		{
			$('select[name="coverage_plan"] option:selected').each(function() 
			{
				availmentData.push(this.value);

			});
			$('input[name="jobsite[]"]').each(function()
            {
            	ajaxData.push(this.value);
            });
            $('input[name="trunk[]"]').each(function()
            {
            	trunkData.push(this.value);
            });
            if(checking_null_validation(document.getElementById('company_name').value,"COMPANY NAME")=="")
			{}	
		    else if(checking_null_validation(document.getElementById('company_email_address').value,"COMPANY EMAIL ADDRESS")=="")
			{}
			else if(checking_null_validation(document.getElementById('company_contact_person').value,"COMPANY CONTACT PERSON")=="")
			{}	
			else if(checking_null_validation(document.getElementById('company_phone_number').value,"PHONE NUMBER")=="")
			{}
			else if(checking_null_validation(document.getElementById('company_zipcode').value,"COMPANY ZIPCODE")=="")
			{}
			else if(checking_null_validation(document.getElementById('company_street').value,"COMPANY STREET")=="")
			{}
		    else if(checking_null_validation(document.getElementById('company_city').value,"COMPANY CITY")=="")
			{}
		    else if(checking_null_validation(document.getElementById('company_country').value,"COMPANY COUNTRY")=="")
			{}
			else if(checking_null_validation(document.getElementById('contract_mode_of_payment').value,"MODE OF PAYMENT")=="")
			{}
			else if(document.getElementById('contract_image').files.length == 0)
			{
				toastr.error(' cannot be null.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(document.getElementById('contract_schedule_of_benifits_image').files.length == 0)
			{
				toastr.error('BENIFITS IMAGE cannot be null.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(ajaxData.length == 0)
			{
				toastr.error('Please add JOBSITE at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(availmentData.length == 0)
			{
				toastr.error('Please select PLAN at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(trunkData.length == 0)
			{
				toastr.error('Please add TRUNKLINE at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				$('.confirm-modal').remove();
				$('.append-modal').append(modals);
	            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
				$('.confirm-modal-title').html('Are you sure you want to add this company?');
				$('.confirm-submit').addClass('create-company-submit');
				$('.confirm-modal').modal('show');

				formData.append("company_name", 			document.getElementById('company_name').value);
	            formData.append("company_email_address", 	document.getElementById('company_email_address').value);
	            formData.append("company_contact_person", 	document.getElementById('company_contact_person').value);
	            formData.append("company_phone_number", 	document.getElementById('company_phone_number').value);
	            formData.append("company_zipcode", 			document.getElementById('company_zipcode').value);
	            formData.append("company_street", 			document.getElementById('company_street').value);
	            formData.append("company_city", 			document.getElementById('company_city').value);
	            formData.append("company_country", 			document.getElementById('company_country').value);
	            
	            formData.append("contract_mode_of_payment", document.getElementById('contract_mode_of_payment').value);
	            formData.append("contract", 				document.getElementById('contract_image').files[0]);
	            formData.append("schedule", 				document.getElementById('contract_schedule_of_benifits_image').files[0]);

	            for (var i = 0; i < ajaxData.length; i++) 
				{
				    formData.append('ajaxData[]', ajaxData[i]);
				}
				for (var i = 0; i < trunkData.length; i++) 
				{
				    formData.append('trunkData[]', trunkData[i]);
				}

				for (var j = 0; j < availmentData.length; j++) 
				{
				    formData.append('availmentData[]', availmentData[j]);
				}
			}
		});
	}
	
    function create_company_submit()
	{
		$(document).on('click','.create-company-submit',function() 
		{
			
            $('.confirm-modal').modal('hide');
            $(".company-modal-body").html("<div class='company-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.company-ajax-loader').show();
            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/company/create_company/submit',
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
					    $(".company-modal-body").html(data);
					    $(".company-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-lg' style='text-align:center' data-dismiss='modal'>Close</button>");
					}, 1000);
				}
			});
		});
	}
	function action_view_company_details()
	{
		$(document).on('click','.view-company-details',function() 
		{

			$('.company-modal').modal('show');
			$('.company-modal-title').html('COMPANY DETAILS');
			$('.company-ajax-loader').show();
			$('.company-modal-body-content').hide();
			var company_id = $(this).data('id');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/company/company_details/'+company_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.company-ajax-loader').hide();
						$('.company-modal-body-content').show();
						$('.company-modal-body-content').html(data);
                    }, 1000);
				}
			});

		});
	}
}

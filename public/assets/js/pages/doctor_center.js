var doctor_center 	= new doctor_center();
var formData   		= new FormData();
var ajaxData 		= [];
var value			= 0;
var message			= "";
var specialData 	= [];
var providerData	= [];

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

function doctor_center()
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
			checking_null_validation(value,message);
            export_doctor_template();
            
            add_doctor();
            add_doctor_confirm();
            add_doctor_submit();
            import_doctor();
            import_doctor_confirm();
			import_doctor_submit();
			view_doctor_details();
			view_doctor_transaction_details();
			trigger();
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

	function add_doctor()
	{
		$("body").on('click','.add-doctor',function()
		{
			$('.doctor-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top doctor-modal');
			$('.global-modal-dialog').removeClass().addClass('modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('ADD DOCTOR');
			$('.global-modal-title').removeClass().addClass('modal-title second');
			$('.global-modal-body').removeClass().addClass('modal-body');
			$('.doctor-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            var approval_id = $(this).data('approval_id');

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/doctor/add_doctor',
				method: "get",
                success: function(data)
                {
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader');
						$('.global-modal-body-content').show().html(data).removeClass().addClass('row box-holder  modal-body-content');
						$('.global-modal-footer').show().removeClass().addClass('modal-footer');
                    	$('.global-footer-button').html('CREATE PLAN').removeClass().addClass('btn btn-primary');
                    }, 1000);
				}
			});
		});

		
	}
	function add_doctor_confirm()
	{
		$(document).on('click','.add-doctor-confirm',function()
		{
			
			$('input[name="provider_id"]:checked').each(function() 
			{
				providerData.push(this.value);
			});
			$('input[name="specialization_id"]:checked').each(function() 
			{
				specialData.push(this.value);
			});
			if(checking_null_validation(document.getElementById('doctor_first_name').value,"FIRST NAME")=="")
			{}	
			else if(checking_null_validation(document.getElementById('doctor_middle_name').value,"MIDDLE NAME")=="")
			{}
			else if(checking_null_validation(document.getElementById('doctor_last_name').value,"LAST NAME")=="")
			{}
			else if(checking_null_validation(document.getElementById('doctor_gender').value,"GENDER")=="")
			{}
			else if(checking_null_validation(document.getElementById('doctor_birthdate').value,"BIRTHDATE")=="")
			{}
			else if(checking_null_validation(document.getElementById('doctor_contact_number').value,"CONTACT NUMBER")=="")
			{}
			else if(checking_null_validation(document.getElementById('doctor_email_address').value,"EMAIL ADDRESS")=="")
			{}
			else if(checking_null_validation(document.getElementById('doctor_address').value,"ADDRESS")=="")
			{}
			else if(providerData.length==0)
			{
				toastr.error('Please select PROVIDER at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(specialData.length==0)
			{
				toastr.error('Please select SPECIALIZATION at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				$('.confirm-modal').remove();
				$('.append-modal').append(modals);
	            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
				$('.confirm-modal-title').html('Are you sure you want to add this DOCTOR?');
				$('.confirm-submit').addClass('add-doctor-submit'); 
				$('.confirm-modal').modal('show');

				for(var i = 0; i < providerData.length; i++) 
				{
				    formData.append('providerData[]', providerData[i]);
				}
				for(var i = 0; i < specialData.length; i++) 
				{
				    formData.append('specialData[]', specialData[i]);
				}
				formData.append("doctor_first_name", 		document.getElementById('doctor_first_name').value);
	            formData.append("doctor_middle_name", 		document.getElementById('doctor_middle_name').value);
	            formData.append("doctor_last_name", 		document.getElementById('doctor_last_name').value);
	            formData.append("doctor_gender", 			document.getElementById('doctor_gender').value);
	            formData.append("doctor_birthdate", 		document.getElementById('doctor_birthdate').value);
	            formData.append("doctor_contact_number", 	document.getElementById('doctor_contact_number').value);
	            formData.append("doctor_email_address", 	document.getElementById('doctor_email_address').value);
	            formData.append("doctor_address", 			document.getElementById('doctor_address').value);
	            
			}
		});
	}
	function add_doctor_submit()
	{
		$(document).on('click','.add-doctor-submit',function() 
		{
			
            $('.confirm-modal').modal('hide');
            $(".doctor-modal-body").html("<div class='doctor-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.doctor-ajax-loader').show();
            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/doctor/add_doctor/submit',
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
					    $(".doctor-modal-body").html(data);
					    $(".doctor-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-lg' style='text-align:center' data-dismiss='modal'>Close</button>");
					}, 1000);
				}
			});
		});
	}
	function view_doctor_details()
	{
		$(document).on('click','.view-doctor-details',function()
		{
			$('.doctor-modal').modal('show');
			$('.doctor-ajax-loader').show();
			$('.doctor-modal-body-content').hide();
			$('.doctor-modal-title').html('DOCTOR DETAILS');
			$(".doctor-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-import' data-dismiss='modal'>Close</button><button type='button' class='btn btn-primary pull-right' >Save Changes</button>");
			var doctor_id = $(this).data('doctor_id');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/doctor/view_doctor_details/'+doctor_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.doctor-ajax-loader').hide();
						$('.doctor-modal-body-content').show();
						$('.doctor-modal-body-content').html(data);
                    }, 1000);
				}
			});
		});
	}
	function view_doctor_transaction_details()
	{
		$(document).on('click','.transaction-details',function()
		{
			var member_id = $(this).data('transaction_member_id');
			$('.member-action-modal').modal('show');
			$('.member-action-ajax-loader').show();
			$('.member-action-modal-body-content').hide();
			$('.member-action-modal-title').html('MEMBER TRANSACTION DETAILS');
			$(".member-action-modal-footer").html("<button type='button' class='btn btn-default pull-left member-action-modal-close'>Close</button><button type='button' class='btn btn-primary pull-right' >Save Changes</button>");

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
						$('.member-action-ajax-loader').hide();
						$('.member-action-modal-body-content').show();
						$('.member-action-modal-body-content').html(data);
                    }, 1000);
				}
			});
		});
	}
	
	function trigger()
	{

		$(document).on('click','.btn-close-import',function()
		{
			$('.member-modal').modal('hide');
			$('.modal-dialog').removeClass().addClass('modal-dialog modal-md');
			$('.confirm-modal-import').removeClass('import-member-submit');
		});
		$(document).on('click','.member-action-modal-close',function()
		{
			$('.member-action-modal').modal('hide');
		});

		
	}
	function export_doctor_template()
	{
		$(document).on('change','.import-doctor-number-select',function()
		{
			var provider_id = $('.import-provider-select').val();
			var number     = $(this).val();
			
			
			if(provider_id!='SELECT PROVIDER'&&number!='SELECT NUMBER ROWS')
			{
				$('.download-link').attr('href', '/doctor/download_template/'+provider_id+'/'+number);
				document.getElementById('doctorDownloadTemplate').disabled= false;
			}
			else
			{
				document.getElementById('doctorDownloadTemplate').disabled= true;
			}
			
		});
		$(document).on('change','.import-provider-select',function()
		{
			var provider_id = $(this).val();
			var number     = $('.import-doctor-number-select').val();
			
			
			if(number!='SELECT NUMBER ROWS'&&provider_id!='SELECT PROVIDER')
			{
				
				$('.download-link').attr('href', '/doctor/download_template/'+provider_id+'/'+number);
				document.getElementById('doctorDownloadTemplate').disabled= false;
			}
			else
			{
				document.getElementById('doctorDownloadTemplate').disabled= true;
			}
			
		});
	}
	function import_doctor()
	{
		$("body").on('click','.import-doctor',function()
		{
			$('.doctor-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top doctor-modal');
			$('.global-modal-dialog').removeClass().addClass('modal-dialog modal-import');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('IMPORT DOCTOR');
			$('.global-modal-title').removeClass().addClass('modal-title second');
			$('.global-modal-body').removeClass().addClass('modal-body');
			$('.doctor-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            var approval_id = $(this).data('approval_id');

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/doctor/import_doctor',
				method: "get",
                success: function(data)
                {
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader');
						$('.global-modal-body-content').show().html(data).removeClass().addClass('row box-holder  modal-body-content');
						$('.global-modal-footer').show().removeClass().addClass('modal-footer');
                    	$('.global-footer-button').remove();
                    }, 1000);
				}
			});
		});
    }
    function import_doctor_confirm()
	{
		$(document).on('click','.import-doctor-confirm',function() 
		{
			$('.confirm-modal').remove();
			$('.append-modal').append(modals);
            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
			$('.confirm-modal-title').html('Are you sure you want to import this file?');
			$('.confirm-submit').addClass('import-doctor-submit');
			$('.confirm-modal').modal('show');

			formData.append("importDoctorFile", document.getElementById('importDoctorFile').files[0]);
		});
	}
	
	function import_doctor_submit()
	{
		$(document).on('click','.import-doctor-submit',function() 
		{
			$('.confirm-modal').modal('hide');
            $('.doctor-ajax-loader').show();
            $('.import-doctor-action').hide();
            $('.doctor-modal-body-content').hide();
            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/doctor/import_doctor/submit',
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
						$('.doctor-ajax-loader').hide();
						$('.doctor-modal-body-content').show();
					    $(".doctor-modal-body-content").html(data);
					    $(".doctor-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-import' data-dismiss='modal'>Close</button>");
					}, 1000);
				}
			});
		});
	}
}

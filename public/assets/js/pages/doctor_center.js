var doctor_center 	= new doctor_center();
var formData   		= new FormData();
var ajaxData 		= [];
var value			= 0;
var message			= "";

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
            
            create_doctor();
            create_doctor_confirm();
            create_doctor_submit();
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

	function create_doctor()
	{
		$(document).on('click','.create-doctor',function()
		{
			$('.doctor-modal').modal('show');
			$('.doctor-ajax-loader').show();
			$('.doctor-modal-body-content').hide();
			$('.doctor-modal-title').html('CREATE DOCTOR');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/doctor/create_doctor',
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
	function create_doctor_confirm()
	{
		$(document).on('click','.create-doctor-confirm',function()
		{
			$('select[name="specialization_name"] option:selected').each(function() 
			{
				ajaxData.push(this.value);

			});
			if(document.getElementById('provider_id').value=="Select Provider")
			{
				toastr.error('Please select provider.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(checking_null_validation(document.getElementById('doctor_number').value,"DOCTOR NUMBER")=="")
			{}	
			else if(checking_null_validation(document.getElementById('doctor_first_name').value,"FIRST NAME")=="")
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
			else if(ajaxData.length==0)
			{
				toastr.error('Please select specialization at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				$('.confirm-title').html('Are you sure you want to add this DOCTOR?');
				$('.confirm-modal').modal('show');
				$('.global-submit').addClass('create-doctor-submit'); 
				for(var i = 0; i < ajaxData.length; i++) 
				{
				    formData.append('ajaxData[]', ajaxData[i]);
				}
				formData.append("doctor_number", 			document.getElementById('doctor_number').value);
	            formData.append("doctor_first_name", 		document.getElementById('doctor_first_name').value);
	            formData.append("doctor_middle_name", 		document.getElementById('doctor_middle_name').value);
	            formData.append("doctor_last_name", 		document.getElementById('doctor_last_name').value);
	            formData.append("doctor_gender", 			document.getElementById('doctor_gender').value);
	            formData.append("doctor_birthdate", 		document.getElementById('doctor_birthdate').value);
	            formData.append("doctor_contact_number", 	document.getElementById('doctor_contact_number').value);
	            formData.append("doctor_email_address", 	document.getElementById('doctor_email_address').value);
	            formData.append("doctor_address", 			document.getElementById('doctor_address').value);
	            formData.append("provider_id", 				document.getElementById('provider_id').value);
	         
			}
		});
	}
	function create_doctor_submit()
	{
		$(document).on('click','.create-doctor-submit',function() 
		{
			
            $('.confirm-modal').modal('hide');
            $(".doctor-modal-body").html("<div class='doctor-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.doctor-ajax-loader').show();
            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/doctor/create_doctor/submit',
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
			$('.modal-dialog').removeClass('modal-sm');
			$('.modal-dialog').addClass('modal-md');
			$('.confirm-modal-import').removeClass('import-member-submit');
		});
		$(document).on('click','.member-action-modal-close',function()
		{
			$('.member-action-modal').modal('hide');
		});

		
	}
	function export_doctor_template()
	{
		$(document).on('change','.import-company-select',function()
		{
			var company_id = $(this).val();
			$('.download-link').attr('href', '/member/download_template/'+company_id);
			
		});
	}
	function import_doctor()
	{
		$(document).on('click','.import-doctor',function() 
		{
			$('.doctor-modal').modal('show');
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-import-sm');
			$('.doctor-ajax-loader').show();
			$('.doctor-modal-body-content').hide();
			$('.doctor-modal-title').html('IMPORT DOCTOR');
			$(".doctor-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-import' data-dismiss='modal'>Close</button>");
			
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
						$('.doctor-ajax-loader').hide();
						$('.doctor-modal-body-content').show();
						$('.doctor-modal-body-content').html(data);
                    }, 1000);
				}
			});

		});
    }
    function import_doctor_confirm()
	{
		$(document).on('click','.import-member-confirm',function() 
		{
			$('.confirm-title').html('Are you sure you want to import this file?');
			$('.confirm-modal').modal('show');
			$('.global-submit').addClass('import-member-submit');
			formData.append("company_id", 			document.getElementById('companyID').value);
			formData.append("importMemberFile", document.getElementById('importMemberFile').files[0]);
		});
	}
	
	function import_doctor_submit()
	{
		$(document).on('click','.import-member-submit',function() 
		{
			$('.confirm-modal').modal('hide');
            $('.member-ajax-loader').show();
            $('.import-member-action').hide();
            $('.member-modal-body-content').hide();
            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/member/import_member/submit',
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
						$('.member-ajax-loader').hide();
						$('.member-modal-body-content').show();
					    $(".member-modal-body-content").html(data);
					    $(".member-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-import' data-dismiss='modal'>Close</button>");
					}, 1000);
				}
			});
		});
	}
}

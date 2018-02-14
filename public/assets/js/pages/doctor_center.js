var doctor_center 	= new doctor_center();
var formData   		= new FormData();
var ajaxData 		= [];
var value			= 0;
var message			= "";
var specialData 	= [];
var providerData	= [];

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
            add_doctor();
            add_doctor_confirm();
            add_doctor_submit();
            export_doctor_template();
            import_doctor();
            import_doctor_confirm();
			import_doctor_submit();
			view_doctor_details();
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
			$('.global-modal-dialog').removeClass().addClass('modal-dialog modal-lg doctor-modal-dialog');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('ADD DOCTOR');
			$('.global-modal-title').removeClass().addClass('modal-title second');
			$('.global-modal-body').removeClass().addClass('modal-body doctor-modal-body');
			$('.doctor-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            
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
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader doctor-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer doctor-modal-footer');
                    	$('.global-footer-button').html('ADD DOCTOR').removeClass().addClass('btn btn-primary add-doctor-confirm');

					}, 1000);
				}
			});
		});

		
	}
	function add_doctor_confirm()
	{
		$(document).on('click','.add-doctor-confirm',function()
		{
			
			$("select.specialization_name").each(function(i, spe)
            {
            	var selectedSpecial = $(spe).val();
            	if(selectedSpecial!="SELECT SPECIALIZATION")
            	{
            		specialData.push(selectedSpecial);
            	}
            });
            $("select.provider_name").each(function(i, pro)
            {
            	var selectedProvider = $(pro).val();
            	if(selectedProvider!="SELECT PROVIDER")
            	{
            		providerData.push(selectedProvider);
            	}
            });
			
			if(checking_null_validation(document.getElementById('doctor_first_name').value,"FIRST NAME")=="")
			{}	
			else if(checking_null_validation(document.getElementById('doctor_middle_name').value,"MIDDLE NAME")=="")
			{}
			else if(checking_null_validation(document.getElementById('doctor_last_name').value,"LAST NAME")=="")
			{}
			else if(checking_null_validation(document.getElementById('doctor_gender').value,"GENDER")=="")
			{}
			else if(checking_null_validation(document.getElementById('doctor_contact_number').value,"CONTACT NUMBER")=="")
			{}
			else if(checking_null_validation(document.getElementById('doctor_email_address').value,"EMAIL ADDRESS")=="")
			{}
			else if(providerData==null||providerData=="")
			{
				toastr.error('Please select PROVIDER at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(specialData==null||specialData=="")
			{
				toastr.error('Please select SPECIALIZATION at least one.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{

				$('.confirm-modal').remove();
				$('.append-modal').append(confirmModals);
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
	            formData.append("doctor_contact_number", 	document.getElementById('doctor_contact_number').value);
	            formData.append("doctor_email_address", 	document.getElementById('doctor_email_address').value);
	        }
		});
	}
	function add_doctor_submit()
	{
		$(document).on('click','.add-doctor-submit',function() 
		{
			
            $('.confirm-modal').remove();
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
						$('.doctor-ajax-loader').hide();
						$('.doctor-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
						$('.doctor-modal-body').html(data);
						$('.doctor-modal-footer').html('<button type="button" class="btn btn-default pull-left " data-dismiss="modal">Close</button>');

					}, 1000);
				}
			});
		});
	}
	function view_doctor_details()
	{
		$(document).on('click','.view-doctor-details',function() 
		{

			$('.doctor-details-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top doctor-details-modal');
			$('.global-modal-dialog').removeClass().addClass('doctor-details-modal-dialog modal-dialog modal-lg');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('DOCTOR DETAILS');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body doctor-details-modal-body');
			$('.doctor-details-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
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
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader doctor-details-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer doctor-details-modal-footer');
                    	$('.global-footer-button').html('SAVE CHANGES').removeClass().addClass('btn btn-primary doctor-details-confirm');
                    }, 1000);
				}
			});

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
			$('.doctor-import-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top doctor-import-modal');
			$('.global-modal-dialog').removeClass().addClass('modal-dialog modal-import');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('IMPORT DOCTOR');
			$('.global-modal-title').removeClass().addClass('modal-title second');
			$('.global-modal-body').removeClass().addClass('modal-body doctor-import-modal-body');
			$('.doctor-import-modal').modal('show');
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
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader doctor-import-loader');
						$('.global-modal-body-content').show().html(data).removeClass().addClass('row box-holder  modal-body-content');
						$('.global-modal-footer').show().removeClass().addClass('modal-footer doctor-import-modal-footer');
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
			$('.append-modal').append(confirmModals);
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
			$('.confirm-modal').remove();
            $(".doctor-import-modal-body").html("<div class='doctor-import-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.doctor-import-ajax-loader').show();

			
            
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
						$('.doctor-import-ajax-loader').hide();
						$('.doctor-import-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
						$('.doctor-import-modal-body').html(data);
						$('.doctor-import-modal-footer').html('<button type="button" class="btn btn-default pull-left " data-dismiss="modal">Close</button>');

					}, 1000);
				}
			});
		});
	}
}

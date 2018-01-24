var doctor_center 	= new doctor_center();
var formData   		= new FormData();
var ajaxData 		= [];

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
            export_doctor_template();
            import_doctor();
            create_doctor();
            import_doctor_confirm();
			import_doctor_submit();
			view_doctor_details();
			view_doctor_transaction_details();
			trigger();
         });

	}
	function create_doctor()
	{
		$(document).on('click','.create-doctor',function()
		{
			$('.doctor-modal').modal('show');
			$('.doctor-ajax-loader').show();
			$('.doctor-modal-body-content').hide();
			$('.doctor-modal-title').html('CREATE MEMBER');
			$(".doctor-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-import' data-dismiss='modal'>Close</button><button type='button' class='btn btn-primary pull-right' >Save Changes</button>");
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
	function view_doctor_details()
	{
		$(document).on('click','.view-member-details',function()
		{
			$('.member-modal').modal('show');
			$('.member-ajax-loader').show();
			$('.member-modal-body-content').hide();
			$('.member-modal-title').html('MEMBER DETAILS');
			$(".member-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-import' data-dismiss='modal'>Close</button><button type='button' class='btn btn-primary pull-right' >Save Changes</button>");
			var member_id = $(this).data('id');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/member/view_member_details/'+member_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.member-ajax-loader').hide();
						$('.member-modal-body-content').show();
						$('.member-modal-body-content').html(data);
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
		$(document).on('click','.import-member',function() 
		{
			$('.member-modal').modal('show');
			$('.member-ajax-loader').show();
			$('.member-modal-body-content').hide();
			$('.member-modal-title').html('IMPORT MEMBER');
			$(".member-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-import' data-dismiss='modal'>Close</button>");
			
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/member/import_member',
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.member-ajax-loader').hide();
						$('.member-modal-body-content').show();
						$('.member-modal-body-content').html(data);
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

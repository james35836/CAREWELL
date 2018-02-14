var billing_center 	= new billing_center();
var formData   		= new FormData();
function billing_center()
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
            create_cal();
			create_cal_confirm();
			create_cal_submit();
			cal_view_details();
			download_cal_template();
			import_cal_members();
			import_cal_member_confirm();
			import_cal_member_submit();

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
	function create_cal()
	{
		$("body").on('click','.create-cal',function()
		{
			$('.cal-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top cal-modal');
			$('.global-modal-dialog').removeClass().addClass('modal-dialog modal-lg cal-modal-dialog');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('CREATE CAL');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body cal-modal-body');
			$('.cal-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/billing/create_cal',
				method: "get",
                success: function(data)
                {
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader cal-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer cal-modal-footer');
                    	$('.global-footer-button').html('CREATE CAL').removeClass().addClass('btn btn-primary create-cal-confirm');

					}, 1000);
				}
			});
		});
    }
    function create_cal_confirm()
	{
		$(document).on('click','.create-cal-confirm',function() 
		{
			if(document.getElementById('cal_company_id').value=="SELECT COMPANY")
			{
				toastr.error('Please select COMPANY.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(checking_null_validation(document.getElementById('cal_payment_date').value,"PAYMENT DATE")=="")
			{}
			else if(checking_null_validation(document.getElementById('cal_company_period_start').value,"PERIOD START")=="")
			{}
			else if(checking_null_validation(document.getElementById('cal_company_period_end').value,"PERIOD END")=="")
			{}
			else
			{
				$('.confirm-modal').remove();
				$('.append-modal').append(confirmModals);
	            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
				$('.confirm-modal-title').html('Are you sure you want to add this CAL?');
				$('.confirm-submit').addClass('create-cal-submit');
				$('.confirm-modal').modal('show');

				formData.append("cal_company_id", 			document.getElementById('cal_company_id').value);
	            formData.append("cal_reveneu_period_month", document.getElementById('cal_reveneu_period_month').value);
	            formData.append("cal_reveneu_period_year", 	document.getElementById('cal_reveneu_period_year').value);
	            formData.append("cal_reveneu_period", 		document.getElementById('cal_reveneu_period').value);
	            formData.append("cal_reveneu_period_count", document.getElementById('cal_reveneu_period_count').value);
	            formData.append("cal_company_period_start", document.getElementById('cal_company_period_start').value);
	            formData.append("cal_company_period_end", 	document.getElementById('cal_company_period_end').value);
	            formData.append("cal_payment_date", 		document.getElementById('cal_payment_date').value);
            }
			
        });
	}
	
	function create_cal_submit()
	{
		$(document).on('click','.create-cal-submit',function() 
		{

			$('.confirm-modal').remove();
            $(".cal-modal-body").html("<div class='cal-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.cal-ajax-loader').show();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/billing/create_cal/sumbit',
				method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data)
				{
					setTimeout(function()
					{
						$('.cal-ajax-loader').hide();
						$('.cal-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
						$('.cal-modal-body').html(data);
						$('.cal-modal-footer').html('<button type="button" class="btn btn-default pull-left " data-dismiss="modal">Close</button>');
                    }, 1000);
				}
			});
		});
	}
	function cal_view_details()
	{
		
		$("body").on('click','.cal-view-details',function()
		{
			$('.cal-details-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top cal-details-modal');
			$('.global-modal-dialog').removeClass().addClass('modal-dialog modal-lg cal-details-modal-dialog');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('CAL DETAILS');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body cal-details-modal-body');
			$('.cal-details-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();
            var cal_id = $(this).data('cal_id');
			var company_id = $(this).data('company_id');
            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/billing/cal_details/'+cal_id,
				method: "get",
                success: function(data)
                {
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader cal-details-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer cal-details-modal-footer');
                    	$('.global-footer-button').html('CREATE CAL').removeClass().addClass('btn btn-primary create-cal-confirm');

					}, 1000);
				}
			});
		});
	}
	function download_cal_template()
	{
		$(document).on('change','.download-cal-select',function()
		{
			var company_id = $(this).val();
			$('.download-link').attr('href', '/member/download_template/'+company_id);
			
		});
	}
	function import_cal_members()
	{

		$(document).on('click','.import-cal-memberss',function() 
		{
			$('.cal-member-modal').remove();
            $(".append-modal").append(globalModals);
			$('.global-modal').removeClass().addClass('modal fade modal-top cal-member-modal');
			$('.global-modal-dialog').removeClass().addClass('modal-dialog modal-import cal-member-modal-dialog');
			$('.global-modal-content').removeClass().addClass('modal-content');
			$('.global-modal-header').removeClass().addClass('modal-header');
			$('.global-modal-title').html('IMPORT CAL MEMBERS');
			$('.global-modal-title').removeClass().addClass('modal-title');
			$('.global-modal-body').removeClass().addClass('modal-body cal-member-modal-body');
			$('.cal-member-modal').modal('show');
			$('.global-ajax-loader').show();
            $('.global-modal-body-content').hide();
            $('.global-modal-footer').hide();

			var company_id 	= $(this).data('member_company_id');
			var cal_id 		= $(this).data('member_cal_id');
			
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/billing/import_cal_members/'+cal_id+'/'+company_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader cal-member-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						$('.global-modal-footer').show().removeClass().addClass('modal-footer cal-member-modal-footer');
                    	$('.global-footer-button').remove();
						
                    }, 1000);
				}
			});

		});
	}
	function import_cal_member_confirm()
	{
		$(document).on('click','.import-cal-member-confirm',function() 
		{
			$('.confirm-modal').remove();
			$('.append-modal').append(confirmModals);
            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
			$('.confirm-modal-title').html('Are you sure you want to import this FILE?');
			$('.confirm-submit').addClass('import-cal-member-submit');
			$('.confirm-modal').modal('show');

			
			formData.append("company_id", 			$(this).data('company_id'));
			formData.append("cal_id", 				$(this).data('cal_id'));
			formData.append("importCalMemberFile", 	document.getElementById('importCalMemberFile').files[0]);
            
        });
	}
	function import_cal_member_submit()
	{
		$(document).on('click','.import-cal-member-submit',function() 
		{
			$('.confirm-modal').modal('hide');
            $('.billing-action-ajax-loader').show();
            $('.billing-action-modal-body-content').hide();

            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/billing/cal_import_template_submit',
				method: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data)
				{
					setTimeout(function()
					{
						$('.modal-dialog').removeClass().addClass('modal-dialog modal-sm');
						$('.billing-action-ajax-loader').hide();
						$('.billing-action-modal-body-content').show();
					    $(".billing-action-modal-body-content").html(data);
					    $(".billing-action-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-import' data-dismiss='modal'>Close</button>");
					}, 1000);
				}
			});
		});
	}
}
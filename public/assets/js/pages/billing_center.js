var billing_center 	= new billing_center();

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
	function create_cal()
	{
		$("body").on('click','.create-cal',function()
		{
			var company_id = $(this).data('company_id');
			var modalName= 'CREATE CAL';
			var modalClass='cal';
			var modalLink='/billing/create_cal';
			var modalActionName='CREATE CAL';
			var modalAction='create-cal-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});

    }
    function create_cal_confirm()
	{
		$('body').on('click','.create-cal-confirm',function() 
		{
			if(document.getElementById('cal_company_id').value=="SELECT COMPANY")
			{
				globals.global_tostr('COMPANY');
			}
			else if(globals.checking_null_validation(document.getElementById('cal_payment_date').value,"PAYMENT DATE")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('cal_company_period_start').value,"PERIOD START")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('cal_company_period_end').value,"PERIOD END")=="")
			{}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to add this CAL?';
				var confirmModalAction = 'create-cal-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);

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
		$('body').on('click','.create-cal-submit',function() 
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
			var cal_id = $(this).data('cal_id');
			var modalName= 'CAL DETAILS';
			var modalClass='company';
			var modalLink='/billing/cal_details/'+cal_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
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
		$("body").on('click','.import-cal-members',function() 
		{
			var company_id 	= $(this).data('member_company_id');
			var cal_id 		= $(this).data('member_cal_id');

			var modalName= 'IMPORT MEMBER';
			var modalClass='cal-member';
			var modalLink='/billing/import_cal_members/'+cal_id+'/'+company_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='confirm';
			var modalSize = 'modal-import';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });

		
	}
	function import_cal_member_confirm()
	{
		$('body').on('click','.import-cal-member-confirm',function() 
		{
			var	confirmModalMessage = 'Are you sure you want to IMPORT this file?';
			var confirmModalAction = 'import-cal-member-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);
			
			formData.append("company_id", 			$(this).data('company_id'));
			formData.append("cal_id", 				$(this).data('cal_id'));
			formData.append("importCalMemberFile", 	document.getElementById('importCalMemberFile').files[0]);
            
        });
	}
	function import_cal_member_submit()
	{
		$(document).on('click','.import-cal-member-submit',function() 
		{
			$('.confirm-modal').remove();
            $(".cal-member-modal-body").html("<div class='cal-member-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.cal-member-ajax-loader').show();

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
						$('.cal-member-ajax-loader').hide();
						$('.cal-member-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
						$('.cal-member-modal-body').html(data);
						$('.cal-member-modal-footer').html(successButton);
					}, 1000);
				}
			});
		});
	}
}
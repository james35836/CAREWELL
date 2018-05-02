var billing_center 	= new billing_center();
var billingMemberData = new FormData();
var calPendingData    = new FormData();
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
			remove_cal_member();
			remove_cal_member_submit();
			cal_close();
			cal_close_confirm();
			cal_close_submit();
			cal_pending_confirm();
			cal_pending_submit();
			payment_breakdown();
			payment_breakdown_update();
			last_ten_payments();
		});

	}
	function last_ten_payments()
	{
		
		$("body").on('click','.last-ten-payments',function()
		{
			
			var member_id 	    = $(this).data('member_id');
			var modalName     	= 'LAST TEN PAYMENT';
			var modalClass    	= 'ten-payments';
			var modalLink     	= '/billing/last_ten_payments/'+member_id;
			var modalActionName	= 'OK';
			var modalAction   	=  '';
			var modalSize     	= 'modal-mdsm';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	}
	function payment_breakdown_update()
	{
		$("body").on('click','.update-payment-date',function()
		{
			var updatePayment = new FormData();

			updatePayment.append("cal_payment_id", 	 	$(this).data('cal_payment_id'));
			updatePayment.append("cal_payment_start",	$(this).closest('tr').find('.cal_payment_start').val());
			updatePayment.append("cal_payment_end",  	$(this).closest('tr').find('.cal_payment_end').val());
			updatePayment.append("cal_new_member_id",	$(this).data('cal_new_member_id'));
			updatePayment.append("ref", 	 			$(this).data('ref'));
			
            ajaxData.this = $(this);
			$(this).html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');

            
            $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/billing/payment_breakdown/update_payment_date',
				method: "POST",
	            data: updatePayment,
	            contentType:false,
	            cache:false,
	            processData:false,
	            success: function(data)
				{
					setTimeout(function()
					{
					   ajaxData.this.html('<i class="fa fa-'+data+' "></i>');
					}, 1000);
				}
			});
		});
	}
	function payment_breakdown()
	{
		
		$("body").on('click','.payment-breakdown',function()
		{
			var ref           = $(this).data('ref');
			var cal_member_id = $(this).data('cal_member_id');
			var modalName= 'PAYMENT BREAKDOWN';
			var modalClass='payment';
			var modalLink='/billing/payment_breakdown/'+cal_member_id+'/'+ref;
			var modalActionName='OK';
			var modalAction='';
			var modalSize = 'modal-mdsm';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});

	}
	function cal_pending_confirm()
	{
		$('body').on('click','.cal-pending-confirm',function() 
		{
			var	confirmModalMessage = 'Are you sure you want to mark this CAL as pending?';
			var confirmModalAction = 'cal-pending-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);
            calPendingData.append("cal_id", 					$(this).data('cal_id'));
            ajaxData.tdCloser = $(this).closest('tr');
	    });
	}
	function cal_pending_submit()
	{
		$('body').on('click','.cal-pending-submit',function() 
		{
			globals.global_single_submit('/billing/cal_pending_submit',calPendingData,ajaxData.tdCloser);
        });
	}
	function cal_close()
	{
		$("body").on('click','.close-cal',function()
		{
			var cal_id = $(this).data('cal_id');
			var modalName= 'COLLECTION DETAILS';
			var modalClass='cal-close';
			var modalLink='/billing/cal_close/'+cal_id;
			var modalActionName='MARK AS CLOSE';
			var modalAction='cal-close-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	}
	function cal_close_confirm()
	{
		$('body').on('click','.cal-close-confirm',function() 
		{
			var cal_file = document.getElementById('cal_info_attached_file').files.length;

            if(cal_file==0)
			{
				globals.global_tostr('ATTACHED FILE');
			}
			else if(globals.checking_null_validation(document.getElementById('cal_info_check_number').value,"CHECK NUMBER")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('cal_info_collection_date').value,"COLLECTION DATE")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('cal_info_check_date').value,"CHECK DATE")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('cal_info_or_number').value,"O.R NUMBER")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('cal_info_amount').value,"AMOUNT")=="")
			{}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to close this CAL?';
				var confirmModalAction = 'cal-close-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);

				calCloseData.append("cal_info_check_number", 	document.getElementById('cal_info_check_number').value);
	            calCloseData.append("cal_info_collection_date", document.getElementById('cal_info_collection_date').value);
	            calCloseData.append("cal_info_check_date", 		document.getElementById('cal_info_check_date').value);
	            calCloseData.append("cal_info_or_number", 		document.getElementById('cal_info_or_number').value);
	            calCloseData.append("cal_info_amount", 			document.getElementById('cal_info_amount').value);
	            calCloseData.append("cal_file", 				document.getElementById('cal_info_attached_file').files[0]);
	            calCloseData.append("cal_id", 					document.getElementById('cal_id').value);
	        }
			
        });
	}
	function cal_close_submit()
	{
		$('body').on('click','.cal-close-submit',function()
		{
			globals.global_submit('cal-close','/billing/cal_close/sumbit',calCloseData);
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
			var modalSize = 'modal-md';
            globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	}
    function create_cal_confirm()
	{
		$('body').on('click','.create-cal-confirm',function() 
		{
			if(document.getElementById('company_id').value=="0")
			{
				globals.global_tostr('COMPANY');
			}
			else if(globals.checking_null_validation(document.getElementById('cal_reveneu_period_year').value,"REVENUE YEAR")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('cal_payment_mode').value,"MODE OF PAYMENT")=="")
			{}
			
			else
			{
				var	confirmModalMessage = 'Are you sure you want to add this CAL?';
				var confirmModalAction = 'create-cal-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
		 
				calData.append("company_id", 				document.getElementById('company_id').value);
	            calData.append("cal_reveneu_period_year", 	document.getElementById('cal_reveneu_period_year').value);
	            calData.append("cal_payment_mode", 			document.getElementById('cal_payment_mode').value);
	            calData.append("cal_payment_start", 		document.getElementById('cal_payment_start').value);
	            calData.append("cal_payment_end", 			document.getElementById('cal_payment_end').value);
	            
            }
			
        });
	}
	
	function create_cal_submit()
	{
		$('body').on('click','.create-cal-submit',function()
		{
			globals.global_submit('cal','/billing/create_cal/sumbit',calData);
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
			
			calFileData.append("company_id", 			$(this).data('company_id'));
			calFileData.append("cal_id", 				$(this).data('cal_id'));
			calFileData.append("importCalMemberFile", 	document.getElementById('importCalMemberFile').files[0]);
            
        });
	}
	function import_cal_member_submit()
	{
		$('body').on('click','.import-cal-member-submit',function() 
		{
			globals.global_submit('cal-member','/billing/cal_import_template_submit',calFileData);
        });
	}
	function remove_cal_member()
	{
		$('body').on('click','.remove-cal-member',function() 
		{
			var	confirmModalMessage = 'Are you sure you want to remove this member?';
			var confirmModalAction = 'remove-cal-member-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);

			billingMemberData.append("cal_member_id", 	$(this).data('cal_member_id'));
			ajaxData.tdCloser  = $(this).closest('tr');
		});
	}
	function remove_cal_member_submit()
	{
		$('body').on('click','.remove-cal-member-submit',function() 
		{
			globals.global_single_submit('/billing/cal_member/remove',billingMemberData,ajaxData.tdCloser);

		});
	}
}
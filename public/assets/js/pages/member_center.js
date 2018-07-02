var member_center 	= new member_center();

function member_center()
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
			export_template();

			create_member();
            create_member_confirm();
           	create_member_submit();

 			import_member();
            import_member_confirm();
			import_member_submit();

			view_member_details();
			view_member_transaction_details();

			member_adjustment();
			member_adjustment_confirm();
			member_adjustment_submit();
			update_member_confirm();
			update_member_submit();

			
		});

	}
	
	function create_member()
	{
		$("body").on('click','.create-member',function()
		{
			var modalName 		= 'CREATE MEMBER';
			var modalClass      = 'member';
			var modalLink 		= '/member/create_member';
			var modalActionName = 'CREATE MEMBER';
			var modalAction 	= 'create-member-confirm';
			var modalSize 		= 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });

		$('body').on('change','.select_company',function() 
		{
			var company_id 	= $(this).val();
			globals.get_dual_information('/get/company_info',company_id,'.deploymentList','.coverageList');
		});

		
	}
	function create_member_confirm()
	{
		$('body').on('click','.create-member-confirm',function()
		{
			var validator 	= [];
			validator 		= globals.validators('form.member-submit-form .required');
			if(validator.length!=0)
			{
				toastr.error('All form with red border is required.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to add this MEMBER?';
				var confirmModalAction = 'create-member-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);

				ajaxData = $("form.member-submit-form").serialize(); 
	   		}
		});

	}
    function create_member_submit()
    { 	
    	$('body').on('click','.create-member-submit',function() 
		{
			globals.global_serialize_submit('member','/member/create_member/submit',ajaxData);
        });

    }
	function view_member_details()
	{
		$('body').on('click','.view-member-details',function()
		{
			var member_id 		= $(this).data('member_id');
			var modalName 		= 'MEMBER DETAILS';
			var modalClass 		= 'member-details';
			var modalLink 		= '/member/view_member_details/'+member_id;
			var modalActionName = 'SAVE CHANGES';
			var modalAction 	= 'update-member-confirm';
			var modalSize  		= 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	}
	function view_member_transaction_details()
	{
		$('body').on('click','.transaction-details',function()
		{
			var member_id 		= $(this).data('member_id');
			var modalName 		= 'MEMBER TRANSACTION DETAILS';
			var modalClass 		= 'member-transaction-details';
			var modalLink 		= '/member/transaction_details/'+member_id;
			var modalActionName = 'none';
			var modalAction 	= 'confirm';
			var modalSize 		= 'modal-md';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	}

	//edrich
	function update_member_confirm()
	{
		$('body').on('click','.update-member-confirm',function() 
		{
			var	confirmModalMessage  = 'Are you sure you want to update this member?';
			var confirmModalAction   = 'update-member-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);

			memberData.append("member_id", 				document.getElementById('member_id').value);
			memberData.append("member_first_name", 	    document.getElementById('member_first_name').value);
			memberData.append("member_middle_name", 	document.getElementById('member_middle_name').value);
			memberData.append("member_last_name", 	    document.getElementById('member_last_name').value);
			memberData.append("member_birthdate", 	    document.getElementById('member_birthdate').value);               
		   	memberData.append("member_gender", 		    document.getElementById('member_gender').value);
			memberData.append("member_marital_status", 	document.getElementById('member_marital_status').value);
			memberData.append("member_mother_maiden_name", 	document.getElementById('member_mother_maiden_name').value);
			memberData.append("member_contact_number", 		document.getElementById('member_contact_number').value);
			memberData.append("member_email_address", 	document.getElementById('member_email_address').value);
			memberData.append("member_permanet_address", 	document.getElementById('member_permanet_address').value);		
			memberData.append("member_present_address", 	document.getElementById('member_present_address').value);

			memberData.append("government_card_philhealth", 	document.getElementById('government_card_philhealth').value);
			memberData.append("government_card_sss", 	document.getElementById('government_card_sss').value);
			memberData.append("government_card_tin", 	document.getElementById('government_card_tin').value);
			memberData.append("government_card_hdmf", 	document.getElementById('government_card_hdmf').value);
		});
	}

	function update_member_submit()
	{
		$('body').on('click','.update-member-submit',function()  
		{
			globals.global_submit('member-details','/member/update_member/submit',memberData);
        });
		
	}
	//edrich
	
	
	function export_template()
	{
		$('body').on('change','.import-member-number-select',function()
		{
			var company_id = $('.import-member-company-select').val();
			var number     = $(this).val();
			if(company_id!='SELECT COMPANY'&&number!='SELECT NUMBER ROWS')
			{
				
				$('.download-link').attr('href', '/member/download_template/'+company_id+'/'+number);
				document.getElementById('memberDownloadTemplate').disabled= false;
			}
			else
			{
				document.getElementById('memberDownloadTemplate').disabled= true;
			}
		});
		$('body').on('change','.import-member-company-select',function()
		{	
			var company_id = $(this).val();
			var number     = $('.import-member-number-select').val();
			if(number!='SELECT NUMBER ROWS'&&company_id!='SELECT COMPANY')
			{
				$('.download-link').attr('href', '/member/download_template/'+company_id+'/'+number);
				document.getElementById('memberDownloadTemplate').disabled= false;
			}
			else
			{
				document.getElementById('memberDownloadTemplate').disabled= true;
			}
		});
	}
	function import_member()
	{
		$("body").on('click','.import-member',function() 
		{
			var member_id 		= $(this).data('member_id');
			var modalName 		= 'IMPORT MEMBER';
			var modalClass 	 	= 'member-import';
			var modalLink 		= '/member/import_member';
			var modalActionName = 'SAVE CHANGES';
			var modalAction 	= 'create-approval-confirm';
			var modalSize  		= 'modal-import';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	}
    function import_member_confirm()
	{
		$('body').on('click','.import-member-confirm',function()
		{
			var	confirmModalMessage 	= 'Are you sure you want to import this file?';
			var confirmModalAction 		= 'import-member-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);

			memberFileData.append("importMemberFile", 	document.getElementById('importMemberFile').files[0]);
		});
	}
	function import_member_submit()
	{
		$('body').on('click','.import-member-submit',function() 
		{
			globals.global_submit('member-import','/member/import_member/submit',memberFileData);
        });
	}
	function member_adjustment()
	{
		$("body").on('click','.member-adjustment',function() 
		{
			var member_id 		= $(this).data('member_id');
			var modalName 		= 'CHANGE COMPANY ';
			var modalClass      = 'member-adjustment';
			var modalLink 		= '/member/member_adjustment/'+member_id;
			var modalActionName = 'SAVE CHANGES';
			var modalAction 	= 'member-adjustment-confirm';
			var modalSize 		= 'modal-md';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
        $('body').on('change','#company_id_adjustment',function() 
		{
			var company_id 	= $(this).val();
			globals.get_dual_information('/get/company_info',company_id,'#deployment_id_adjustment','#coverage_plan_id_adjustment');
		});
	}
	function member_adjustment_confirm()
	{
		$('body').on('click','.member-adjustment-confirm',function() 
		{
			var validator 	= [];
			validator 		= globals.validators('form.member-adjustment-form-submit .required');
			if(validator.length!=0)
			{
				toastr.error('All form with red border is required.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to proceed with this adjustment?';
				var confirmModalAction = 'member-adjustment-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);

				serializeData = $("form.member-adjustment-form-submit").serialize(); 
	   		}
	   	});
	}
	function member_adjustment_submit()
	{
		$('body').on('click','.member-adjustment-submit',function() 
		{
			globals.global_serialize_submit('member-adjustment','/member/member_adjustment/submit',serializeData);
        });
	}
}

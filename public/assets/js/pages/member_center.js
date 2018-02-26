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
            import_member();
            create_member();
            create_member_confirm();
            create_member_submit();
            import_member_confirm();
			import_member_submit();
			view_member_details();
			view_member_transaction_details();
			member_adjustment();
			member_adjustment_confirm();
			member_adjustment_submit();
		});

	}
	
	function create_member()
	{
		$("body").on('click','.create-member',function()
		{
			var modalName= 'CREATE MEMBER';
			var modalClass='member';
			var modalLink='/member/create_member';
			var modalActionName='CREATE MEMBER';
			var modalAction='create-member-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });

		$('body').on('change','.select_company',function() 
		{
			var company_id 	= $(this).val();
			globals.get_dual_information('/get/company_info',company_id,'.coverageList','.deploymentList');
		});

		
	}
	function create_member_confirm()
	{
		$('body').on('click','.create-member-confirm',function()
		{
			
			if(globals.checking_null_validation(document.getElementById('member_first_name').value,"FIRST NAME")=="")
			{}
		    else if(globals.checking_null_validation(document.getElementById('member_middle_name').value,"MIDDLE NAME")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('member_last_name').value,"LAST NAME")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('member_birthdate').value,"BIRTHDATE")=="")
			{}
			else if(document.getElementById('member_gender').value=="SELECT GENDER")
			{
				globals.global_tostr('GENDER');
			}
		    else if(document.getElementById('member_marital_status').value=="SELECT STATUS")
			{
				globals.global_tostr('STATUS');
			}
			else if(globals.checking_null_validation(document.getElementById('member_mother_maiden_name').value,"MOTHER MAIDEN NAME")=="")
			{}
		    else if(globals.checking_null_validation(document.getElementById('member_contact_number').value,"CONTACT NUMBER")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('member_email_address').value,"EMAIL ADDRESS")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('member_permanet_address').value,"PERMANENT ADDRESS")=="")
			{}
		    else if(globals.checking_null_validation(document.getElementById('member_present_address').value,"PRESENT ADDRESS")=="")
			{}
			else if(globals.checking_null_validation(document.getElementById('member_employee_number').value,"EMPLOYEE NUMBER")=="")
			{}
			else if(document.getElementById('company_id').value=="0")
			{
				globals.global_tostr('COMPANY');
			}
			else if(document.getElementById('coverage_plan_id').value=="0")
			{
				globals.global_tostr('COVERAGE PLAN');
			}
			else if(document.getElementById('deployment_id').value=="0")
			{
				globals.global_tostr('DEPLOYMENT');
			}
		
			else
			{
				var	confirmModalMessage = 'Are you sure you want to add this MEMBER?';
				var confirmModalAction = 'create-member-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);

				ajaxData = $(".member-company-form,.member-dependent-form,.member-information-form,.member-government-form").serialize(); 
	   		}
		});

	}
    function create_member_submit()
    { 	
    	$('body').on('click','.create-member-submit',function() 
	    {
	    	$('.confirm-modal').remove();
            $(".member-modal-body").html("<div class='member-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.member-ajax-loader').show();
	        $.ajax({
	          	headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        	},
		        url:'/member/create_member/submit',
		        method: "POST",
		        data: ajaxData,
		        dataType:"text",
		        success: function(data)
		        {
		            setTimeout(function()
					{
						$('.member-ajax-loader').hide();
						$('.member-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
						$('.member-modal-body').html(data);
						$('.member-modal-footer').html(successButton);
					}, 1000);
		           
		        }
	        });
	     });

    }
	function view_member_details()
	{
		$('body').on('click','.view-member-details',function()
		{
			var member_id = $(this).data('member_id');
			var modalName= 'MEMBER DETAILS';
			var modalClass='member-details';
			var modalLink='/member/view_member_details/'+member_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});
	}
	function view_member_transaction_details()
	{
		$('body').on('click','.transaction-details',function()
		{
			var member_id = $(this).data('transaction_member_id');
			var modalName= 'MEMBER TRANSACTION DETAILS';
			var modalClass='member-transaction-details';
			var modalLink='/member/transaction_details/'+member_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='confirm';
			var modalSize = 'modal-md';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
		});

		
	}
	
	
	function export_template()
	{

		$('body').on('change','.import-number-select',function()
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
			var number     = $('.import-number-select').val();
			
			
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
			var member_id = $(this).data('member_id');
			var modalName= 'IMPORT MEMBER';
			var modalClass='member-import';
			var modalLink='/member/import_member';
			var modalActionName='SAVE CHANGES';
			var modalAction='create-approval-confirm';
			var modalSize = 'modal-import';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
		
    }
    function import_member_confirm()
	{
		$('body').on('click','.import-member-confirm',function()
		{
			var	confirmModalMessage = 'Are you sure you want to import this file?';
			var confirmModalAction = 'import-member-submit';
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
			var member_id = $(this).data('member_id');
			var modalName= 'ADJUSTMENT ';
			var modalClass='member-adjustment';
			var modalLink='/member/member_adjustment/'+member_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='member-adjustment-confirm';
			var modalSize = 'modal-md';
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
			if(document.getElementById('company_id_adjustment').value=="0")
			{
				globals.global_tostr('COMPANY');
			}
			else if(document.getElementById('coverage_plan_id_adjustment').value=="0")
			{
				globals.global_tostr('COVERAGE PLAN');
			}
			else if(document.getElementById('deployment_id_adjustment').value=="0")
			{
				globals.global_tostr('DEPLOYMENT');
			}
			else if(document.getElementById('employee_number_adjustment').value=="")
			{
				globals.global_tostr('EMPLOYEE NUMBER');
			}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to proceed with this adjustment?';
				var confirmModalAction = 'member-adjustment-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);


				adjustmentData.append("company_id_adjustment", 		document.getElementById('company_id_adjustment').value);
	            adjustmentData.append("coverage_plan_id_adjustment",document.getElementById('coverage_plan_id_adjustment').value);
	            adjustmentData.append("deployment_id_adjustment", 	document.getElementById('deployment_id_adjustment').value);
	            adjustmentData.append("employee_number_adjustment", document.getElementById('employee_number_adjustment').value);
	            adjustmentData.append("member_id_adjustment", 		document.getElementById('member_id_adjustment').value);
				
			}
		
		});
		

	}
	function member_adjustment_submit()
	{
		$('body').on('click','.member-adjustment-submit',function() 
		{

			globals.global_submit('member-adjustment','/member/member_adjustment/submit',adjustmentData);
        });
	}
}

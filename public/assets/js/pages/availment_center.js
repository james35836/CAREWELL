var availment_center 	= new availment_center();



function availment_center()
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
			
            create_approval();
            create_approval_get_info();
            create_approval_confirm();
            create_approval_submit();
            availment_transaction_details();
            approval_details();
        });

	}
	this.get_total = function($this)
	{
		var amount = 0;
		var philhealth = 0;
		var patient = 0;
		var carewell = 0;
		$this.find('.gross-amount').each(function() 
		{
			amount += Number($(this).val());
		});
		$this.find('.philhealth').each(function() 
		{
			philhealth += Number($(this).val());
		});
		$this.find('.charge-patient').each(function() 
		{
			patient += Number($(this).val());
		});
		$this.find('.charge-carewell').each(function() 
		{
			carewell += Number($(this).val());
		});
		
		$this.find('input.total_gross_amount').val(amount);
		$this.find('input.total_philhealth').val(philhealth);
		$this.find('input.total_charge_patient').val(patient);
		$this.find('input.total_charge_carewell').val(carewell);

	}
	
	function create_approval()
	{
		$("body").on('click','.create-approval',function() 
		{
			var modalName= 'CREATE APPROVAL';
			var modalClass='approval';
			var modalLink='/availment/create_approval';
			var modalActionName='CREATE APPROVAL';
			var modalAction='create-approval-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	}
    function create_approval_get_info()
	{
		$('body').on('change','.get-member-info',function() 
		{
			var member_id 	= $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/availment/get_member_info',
				method: "post",
				data: {member_id:member_id},
                success: function(data)
				{
					$('.member_id').val(data.member_id);
					$('.member_name').val(data.member_name);
					$('.member_universal_id').val(data.member_universal_id);
					$('.member_carewell_id').val(data.member_carewell_id);
					$('.member_birthdate').val(data.member_birthdate);
					$('.member_age').val(data.member_age);
					$('.company_name').val(data.company_name);
					$('.get-availment-info').html(data.availment_list);
					$('.member_list').html(data.member_list);
					$('.availment-transaction-details').data('member_id',data.member_id);
					$('.availment-transaction-details').removeAttr("disabled");
					
				}
			});
			
		});
		

		$('body').on('change','.get-provider-info',function() 
		{
			var provider_id 	= $(this).val();
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/get/provider_info',
				data:{provider_id: provider_id},
				method: "POST",
	            success: function(data)
				{
					$('.doctorList').html(data.first);
					$('.payeeList').html(data.second);
					$('.rateRvs').val(data.third);
				}
			});
		});

		$('body').on('change','.get-availment-info',function() 
		{

			var availment_id 	= $(this).val();
			var member_id		= $('select.member_id').val();
			if(member_id==0||member_id=="")
			{
				globals.global_tostr('MEMBER');
			}
			else
			{
				$.ajax({
					headers: {
					      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},

					url:'/get/availment_info',
					data:{availment_id:availment_id,member_id:member_id},
					method: "POST",

		            success: function(data)
					{
						$('.procedureList').html(data);
					}
				});
			}
			
		});

		$('body').on('change','.doctorList',function() 
		{
			var doctor_id 	= $(this).val();
			globals.get_information('/get/doctor_specialty',doctor_id,'.doctor-specialty','html');
		});

		

    }
    function create_approval_confirm()
	{
		$('body').on('click','.create-approval-confirm',function() 
		{
			$("select.final_diagnosis_id").each(function(i, sel)
            {
            	var selectedFinal = $(sel).val();
            	if(selectedFinal!=0)
            	{
            		finalDiagnosisData.push(selectedFinal);
            	}
            });
            $("select.payeeList").each(function(i, sel)
            {
            	var selectedPayee = $(sel).val();
            	if(selectedPayee!=0)
            	{
            		payeeData.push(selectedPayee);
            	}
            });
            

			if(document.getElementById('member_id').value==0)
			{
				globals.global_tostr('MEMBER');
			}	
			else if(document.getElementById('provider_id').value==0)
			{
				globals.global_tostr('PROVIDER');
			}
			else if(document.getElementById('availment_id').value==0)
			{
				globals.global_tostr('AVAILMENT');
			}
		    else if(globals.checking_null_validation(document.getElementById('approval_complaint').value,"COMPLAINT")=="")
			{}
			else if(document.getElementById('initial_diagnosis_id').value==0)
			{
				globals.global_tostr('INITIAL DIAGNOSIS');
			}	
			else if(finalDiagnosisData==null||finalDiagnosisData=="")
			{
				globals.global_tostr('FINAL DIAGNOSIS');
			}
			else if(payeeData==null||payeeData=="")
			{
				globals.global_tostr('PAYEE');
			}
			
			else 
			{
				var	confirmModalMessage = 'Are you sure you want to add this approval?';
				var confirmModalAction = 'create-approval-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);

				ajaxData = $(".approval-submit-form").serialize();
			}


			
			
		});
	}
	function create_approval_submit()
	{
		$('body').on('click','.create-approval-submit',function() 
	    {
	    	$('.confirm-modal').remove();
            $(".approval-modal-body").html("<div class='approval-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.approval-ajax-loader').show();
	        $.ajax({
	          	headers: {
	              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        	},
		        url:'/availment/create_approval/submit',
		        method: "POST",
		        data: ajaxData,
		        dataType:"text",
		        success: function(data)
		        {
		            setTimeout(function()
					{
						$('.approval-ajax-loader').hide();
						$('.approval-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
						$('.approval-modal-body').html(data);
						$('.approval-modal-footer').html(successButton);
					}, 1000);
		           
		        }
	        });
	     });
	}
	function availment_transaction_details()
	{
		$("body").on('click','.availment-transaction-details',function()
		{
			var member_id = $(this).data('member_id');
			var modalName= 'TRANSACTION DETAILS';
			var modalClass='approval-transaction';
			var modalLink='/member/transaction_details/'+member_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='create-approval-confirm';
			var modalSize = 'modal-md';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
		
	
	}
	function approval_details()
	{
		$("body").on('click','.view-approval-details',function()
		{
			var approval_id = $(this).data('approval_id');
			var modalName= 'APPROVAL DETAILS';
			var modalClass='approval-details';
			var modalLink='/availment/approval_details/'+approval_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='create-approval-confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	} 
}

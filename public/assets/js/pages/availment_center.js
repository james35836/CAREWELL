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
        	approval_details();

        	update_approval_confirm();
        	update_approval_submit();

        	create_new_provider();
        	create_new_provider_confirm();
        	create_new_provider_submit();


        	add_approval_details();
        	add_approval_details_confirm();
        	add_approval_details_submit();

        	remove_approval_details_confirm();
            remove_approval_details_submit();
        });
	}

	this.get_total = function($this)
	{
		var amount 		= 0;
		var philhealth 	= 0;
		var patient 	= 0;
		var carewell 	= 0;
		var grand_total = 0;
		$this.find('.gross-amount').each(function() 
		{
			if(!$(this).closest('tr').find('.procedure_disapproved').is(':checked'))
			{
				amount += Number($(this).val());
			}
		});
		$this.find('.philhealth').each(function() 
		{
			if(!$(this).closest('tr').find('.procedure_disapproved').is(':checked'))
			{
				philhealth += Number($(this).val());
			}
		});
		$this.find('.charge-patient').each(function() 
		{
			if(!$(this).closest('tr').find('.procedure_disapproved').is(':checked'))
			{
				patient += Number($(this).val());
			}
		});
		$this.find('.charge-carewell').each(function() 
		{
			if(!$(this).closest('tr').find('.procedure_disapproved').is(':checked'))
			{
				carewell += Number($(this).val());
			}
		});
		
		$this.find('input.total_gross_amount').val(amount);
		$this.find('input.total_philhealth').val(philhealth);
		$this.find('input.total_charge_patient').val(patient);
		$this.find('input.total_charge_carewell').val(carewell);


		$('input.total_charge_carewell').each(function()
		{
			grand_total += Number($(this).val());
		});
		$('#grand_total').html(grand_total);
	}

	this.check_procedure_amount = function(carewell,member_id,procedure,availment_id)
	{
		var ajaxCallData 	= new FormData();
		var carewell_amount = carewell;
		var procedure_id    = procedure;
		var member_id 		= member_id;
		var availment_id 	= availment_id;


    	ajaxCallData.append('carewell_amount',		carewell_amount);
    	ajaxCallData.append('procedure_id',			procedure_id);
    	ajaxCallData.append('member_id',			member_id);
    	ajaxCallData.append('availment_id',		    availment_id);
		globals.global_ajax_call_submit('/get/check_procedure_amount',ajaxCallData,availment_center,'check_procedure');
    }
	this.show_data_here = function(data,functionReference)
	{
		switch (functionReference) 
		{
		    case 0:
		        day = "Sunday";
		        break;
		    case 1:
		        day = "Monday";
		        break;
		}
		if(functionReference=="provider")
		{
			if(data.view!="none")
			{
				$('#changeProviderInfo').html(data.view);

			}
			$('.doctorList').html(data.first);
			$('.doctor-payee').html(data.first);
			$('.rateRvs').val(data.second);
			$('.other-payee').val(data.third);
			$('.specializationList').html(data.specialization);
			$('.doctorProcedureList').html(data.doctorprocedure);
		}
		else if(functionReference=="check_procedure")
		{
			if(data.ref=="sumobra")
			{
				toastr.error('CURRENT BALANCE : '+data.current_balance+' Member has insufficient balance for this procedure <br>or<br> have reached his/her coverage limit.', 'Something went wrong!', {timeOut: 5000});                                                           
			}
		    if(data.ref=="reached_limit")
		    {
		    	toastr.error('Member has reached the limit for this procedure <br>or<br> have reached his/her coverage limit.', 'Something went wrong!', {timeOut: 5000});                                                           
		    }
			
		}
		else if(functionReference=="availment")
		{
			if(data.view!="none")
			{
				$('#changeAvailmentInfo').html(data.view);
			}
			$('.procedureList').html(data.procedure_list);
		}
		else if(functionReference=="member")
		{
			if(data.ref == 'not_yet_paid')
			{
				$('select#member_id').append('<option selected="selected"></option>');
				toastr.error('This member are not qualified for any availment.', 'Something went wrong!', {timeOut: 3000})
			    $('.member_id').val('');
				$('select#member_id').append('<option selected="selected"></option>');
				$('.member_name').val('');
				$('.member_universal_id').val('');
				$('.member_carewell_id').val('');
				$('.member_birthdate').val('');
				$('.member_age').val('');
				$('.company_name').val('');
				$('.member_employee_number').val('');
				$('.getAvailmentInfo').html('SELECT AVAILMENT');
				$('.member_list').html(data.member_list);
				$('.availment-transaction-details').data('member_id','');
				$('.availment-transaction-details').attr("disabled", "true");
			}
			else if(data.ref == 'not_updated')
			{
				$('select#member_id').append('<option selected="selected"></option>');
				toastr.error('Member payment is not yet updated. Please Check member payment.', 'Something went wrong!', {timeOut: 4000})
			    $('.member_id').val('');
				$('select#member_id').append('<option selected="selected"></option>');
				$('.member_name').val('');
				$('.member_universal_id').val('');
				$('.member_carewell_id').val('');
				$('.member_birthdate').val('');
				$('.member_age').val('');
				$('.member_employee_number').val(data.member_employee_number);
				$('.company_name').val('');
				$('.getAvailmentInfo').html('SELECT AVAILMENT');
				$('.member_list').html(data.member_list);
				$('.transaction-details').data('member_id','');
				$('.transaction-details').attr("disabled", "true");
			}
			else
			{
				$('.member_id').val(data.member_id);
				$('select#member_id').append('<option value="'+data.member_id+'" selected="selected">'+data.member_name+'</option>');
				$('.member_name').val(data.member_name);
				$('.member_universal_id').val(data.member_universal_id);
				$('.member_carewell_id').val(data.member_carewell_id);
				$('.member_birthdate').val(data.member_birthdate);
				$('.member_age').val(data.member_age);
				$('.member_employee_number').val(data.member_employee_number);
				$('.company_name').val(data.company_name);
				$('.getAvailmentInfo').html(data.availment_list);
				$('.member_list').html(data.member_list);
				$('.transaction-details').data('member_id',data.member_id);
				$('.transaction-details').removeAttr("disabled");
		    }
		}
	}
	function create_new_provider()
	{
		$("body").on('click','.create-new-provider',function() 
		{
			
			if($(this).data('warning')=="show")
			{
				var warning     = $(this).data('warning');
			}
			else
			{
				var warning     = "hidden";
			}
			var modalName 		= 'CREATE NEW PROVIDER';
			var modalClass 		= 'approval-new-provider';
			var modalLink 		= '/availment/create_new_provider/'+warning;
			var modalActionName = 'CREATE NEW PROVIDER';
			var modalAction 	= 'create-new-provider-confirm';
			var modalSize 		= 'modal-md';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	}
    function create_new_provider_confirm()
    {
     	$('body').on('click','.create-new-provider-confirm',function() 
		{
			
            if(document.getElementById('provider_name').value==0)
			{
				globals.global_tostr('NAME');
			}	
			else if(document.getElementById('provider_rvs').value==0)
			{
				globals.global_tostr('RVS');
			}
			else 
			{
				$('input[name="doctor_full_name[]"]').each(function(i, doctor)
            	{
            		if($(doctor).val()!="")
            		{
            			doctorProviderData.push(this.value);
            		}
            	});
            	if(doctorProviderData==null||doctorProviderData=="")
				{
					toastr.error('Please add DOCTOR at least one.', 'Something went wrong!', {timeOut: 3000})
				}
				else
				{
					var	confirmModalMessage = 'Are you sure you want to add this provider?';
					var confirmModalAction = 'create-new-provider-submit';
					globals.confirm_modals(confirmModalMessage,confirmModalAction);

					providerData.append("provider_name", 			document.getElementById('provider_name').value);
					providerData.append("provider_rvs", 			document.getElementById('provider_rvs').value);
		            for (var i = 0; i < doctorProviderData.length; i++) 
					{
					    providerData.append('doctorProviderData[]', doctorProviderData[i]);
					}
				}
			}
		});

     }
     function create_new_provider_submit()
     {
     	$('body').on('click','.create-new-provider-submit',function() 
		{
			var successButton	= '<button type="button" class="btn btn-default pull-right reload-btn" data-dismiss="modal">RELOAD</button><button type="button" class="btn btn-default pull-left" data-dismiss="modal">CLOSE</button>';
            var submitLink 		= '/availment/create_new_provider/submit';
			var modalName  		= 'approval-new-provider';
			var submitData    	= providerData;
			$('.confirm-modal').remove();
	        $("."+modalName+"-modal-body").html("<div class='"+modalName+"-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
	        $("."+modalName+"-ajax-loader").show();
	        
	        $.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:submitLink,
				method: "POST",
            	data: submitData,
            	contentType:false,
            	cache:false,
            	processData:false,
            	success: function(data)
				{
					setTimeout(function()
					{
						$('.'+modalName+'-ajax-loader').hide();
						$('.'+modalName+'-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
						$('.'+modalName+'-modal-body').html(data.message);
						$('.'+modalName+'-modal-footer').html(successButton);

						$('#provider_id').append('<option value="'+data.provider_id+'" selected="selected">'+data.provider_name+'</option>');
						$('.other-payee').val(data.provider_name);
						$('.other-payee').val(data.provider_name);
						$('.doctorList').html(data.doctor_list);
						$('.doctor-payee').html(data.doctor_list);
					}, 1000);
				}
			});
		});
    }
	function create_approval()
	{
		$("body").on('click','.create-approval',function() 
		{
			var modalName 		= 'CREATE APPROVAL';
			var modalClass 		= 'approval';
			var modalLink 		= '/availment/create_approval';
			var modalActionName = 'CREATE APPROVAL';
			var modalAction 	= 'create-approval-confirm';
			var modalSize 		= 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	}
    function create_approval_get_info()
	{
		$('body').on('change','.get-member-info',function() 
		{
			var ajaxCallData = new FormData();
        	ajaxCallData.append('member_id',		$(this).val());
			globals.global_ajax_call_submit('/availment/get_member_info',ajaxCallData,availment_center,'member');
			
		});
		$('body').on('change','select.getProviderInfo',function() 
		{
			if($(this).data('warning')=="show")
			{
				var	confirmModalMessage = 'You are required to change all the information in payee and physician, please reload if you do not want to continue!<br><br>Do you want to proceed?';
				var confirmModalAction = 'getProviderInfo';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
			}
			else
			{
				var ajaxCallData = new FormData();
            	ajaxCallData.append('provider_id',		$(this).val());
            	ajaxCallData.append('warning',			$(this).data('warning'));
				globals.global_ajax_call_submit('/get/provider_info',ajaxCallData,availment_center,'provider');
			}
		});
		$('body').on('click','button.getProviderInfo',function() 
		{
			$('.confirm-modal').remove();
			var ajaxCallData 	= new FormData();
        	ajaxCallData.append('provider_id',		$('#provider_id').val());
        	ajaxCallData.append('warning',			'show');
			globals.global_ajax_call_submit('/get/provider_info',ajaxCallData,availment_center,'provider');
		});

		$('body').on('change','select.getAvailmentInfo',function() 
		{

			if($(this).val()==4)
			{
				$(this).closest('.modal').find('div#minorOps').remove();
			}
			else
			{
				if($(this).data('warning')=="show")
				{
					var	confirmModalMessage = 'You are required to change all the information in description, please reload if you do not want to continue!<br><br>Do you want to proceed?';
					var confirmModalAction = 'getAvailmentInfo';
					globals.confirm_modals(confirmModalMessage,confirmModalAction);
				}
				else
				{
					var ajaxCallData 	= new FormData();
		        	ajaxCallData.append('availment_id',		$(this).val());
		        	ajaxCallData.append('member_id',		$('#member_id').val());
		        	ajaxCallData.append('warning',			$(this).data('warning'));
					globals.global_ajax_call_submit('/get/availment_info',ajaxCallData,availment_center,'availment');
				}
			}
			
		});
		$('body').on('click','button.getAvailmentInfo',function() 
		{
			$('.confirm-modal').remove();
			var ajaxCallData 	= new FormData();
        	ajaxCallData.append('availment_id',		$('#availment_id').val());
        	ajaxCallData.append('member_id',		$('#member_id').val());
        	ajaxCallData.append('warning',			'show');
			globals.global_ajax_call_submit('/get/availment_info',ajaxCallData,availment_center,'availment');
		});
	}
	
    function create_approval_confirm()
	{
		$('body').on('click','.create-approval-confirm',function() 
		{
			var validator 			= [];
			validator 		= globals.validators('form.approval-submit-form .required');
			
			if(validator.length!=0)
			{
				toastr.error('All form with red border is required.', 'Something went wrong!', {timeOut: 3000})
			}
			else 
			{
				var	confirmModalMessage = 'Are you sure you want to add this approval?';
				var confirmModalAction = 'create-approval-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
				ajaxData = $("form.approval-submit-form").serialize();
			}
		});
	}
	function create_approval_submit()
	{
		$('body').on('click','.create-approval-submit',function() 
		{
			globals.global_serialize_submit('approval','/availment/create_approval/submit',ajaxData);
        });
	}
	
	function approval_details()
	{
		$("body").on('click','.view-approval-details',function()
		{
			var approval_id  		= $(this).data('approval_id');
			var modalName 			= 'APPROVAL DETAILS';
			var modalClass 		    = 'approval-details';
			var modalLink 			= '/availment/approval_details/'+approval_id;
			var modalActionName 	= 'SAVE CHANGES';
			var modalAction 		= 'update-approval-confirm';
			if($(this).data('size')=='md')
			{
				var modalSize        = 'modal-md';
			}
			else
			{
				var modalSize        = 'modal-lg';
			}
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	} 

	function update_approval_confirm()
	{
		$('body').on('click','.update-approval-confirm',function() 
		{
            if(document.getElementById('provider_id').value==0)
			{
				globals.global_tostr('PROVIDER');
			}
			else if(document.getElementById('availment_id').value==0)
			{
				globals.global_tostr('AVAILMENT');
			}
		    else 
			{
				var	confirmModalMessage = 'Are you sure you want to update this approval?';
				var confirmModalAction = 'update-approval-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
				ajaxData = $("form.approval-update-form").serialize();
			}
		});
	}

	function update_approval_submit()
	{
		$('body').on('click','.update-approval-submit',function() 
    	{
    		globals.global_serialize_submit('approval-details','/availment/update_approval/submit',ajaxData);
	    });

	}


	function add_approval_details()
	{
		$("body").on('click','.add-approval-details',function()
		{
			var id  				= $(this).data('approval_id');
			var ref                	= $(this).data('ref');
			var modalName 			= 'ADD APPROVAL DETAILS';
			var modalClass 			= 'availment-add-details';
			var modalLink 			= '/availment/add_approval_details/'+ref+'/'+id;
			var modalActionName 	= 'ADD PROCEDURE';
			var modalAction 		= 'add-approval-details-confirm';
			var modalSize           = 'modal-md';
			
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	}
  	function add_approval_details_confirm()
  	{
  		$('body').on('click','.add-approval-details-confirm',function() 
		{
            var newProcedureData     = [];
            var  ref                 = $('#ref').val();
            var  title               = $('#title').val();
            var  approval_id         = $('#approval_id').val();

            $('select.newProcedureList').each(function(i, sel)
            {
	            var selectedProcedure = $(sel).val();
	            if(selectedProcedure!=0)
	            {
	            	newProcedureData.push(selectedProcedure);
	            }
            });
        	if(newProcedureData==null||newProcedureData=="")
        	{
        		toastr.error('Please add Procedure.', 'Something went wrong!', {timeOut: 3000});
        		
        	}
        	else
        	{
        		var	confirmModalMessage = 'Are you sure you want to add this '+title+'?';
		     	var confirmModalAction 	= 'add-approval-details-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
				newSerializedApprovalData = $('form.add-availment-details-form').serialize();
			}
		});
  	}
  	function add_approval_details_submit()
  	{
  		$('body').on('click','.add-approval-details-submit',function() 
		{
			globals.global_serialize_submit('availment-add-details','/availment/add_approval_details/submit',newSerializedApprovalData);
        });
  	}
  	function remove_approval_details_confirm()
  	{
  		$('body').on('click','.remove-approval-details-confirm',function() 
		{
			var ref = $(this).data('ref');
			var id  = $(this).data('id');
            thisElement.element = $(this); 
			if($('.remove-approval-details-confirm[data-ref="'+ref+'"]').length <=1)
			{
				toastr.error('you cannot remove all '+ref+'.', 'Something went wrong!', {timeOut: 3000});
			}
			else
			{
				var	confirmModalMessage = 'Are you sure you want to remove this ' +ref;
				var confirmModalAction 	= 'remove-approval-details-submit';
				globals.confirm_modals(confirmModalMessage,confirmModalAction);
				ajaxData.tdCloser  = $(this).closest('tr');

				removeApprovalData.append("id", 	$(this).data('id'));
				removeApprovalData.append("ref", ref);
			}
		});
  	}
    function remove_approval_details_submit()
    {
     	var $this = thisElement.element;
     	if($this)
     	{
     		
     	}
     	$('body').on('click','.remove-approval-details-submit',function() 
		{
			globals.global_single_submit('/availment/remove_approval_details/submit',removeApprovalData,ajaxData.tdCloser);
		});
     }

}

var member_center 	= new member_center();
var formData   		= new FormData();
var ajaxData 		= [];
var value           = 0;
var message         = "";

var modals 			= '<div  class="modal fade modal-top confirm-modal" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">'
						  +'<div class="confirm-modal-dialog modal-dialog modal-sm">'
						    +'<div class="modal-content">'
						      +'<div class="modal-header">'
						        +'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
						        +'<span aria-hidden="true">&times;</span></button>'
						        +'<h4 class="modal-title confirm-modal-title"></h4>'
						      +'</div>'
						      
						      +'<div class="modal-body modal-body-sm">'
						        +'<input type="hidden" class="link"/>'
						      +'</div>'
						      +'<div class="modal-footer">'
						        +'<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>'
						        +'<button type="button" class="btn btn-primary confirm-submit">Save</button>'
						      +'</div>'
						    +'</div>'
						  +'</div>'
						+'</div>';

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
			checking_null_validation(value,message);
            export_template();
            import_member();
            create_member();
            create_member_confirm();
            create_member_submit();
            import_member_confirm();
			import_member_submit();
			view_member_details();
			view_member_transaction_details();
			view_member_approval_details();
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
			return "2";
		}
    }
	function create_member()
	{
		$(document).on('click','.create-member',function()
		{
			$('.member-modal').modal('show');
			$('.modal-dialog').removeClass().addClass('modal-dialog modal-lg');
			$('.member-ajax-loader').show();
			$('.member-modal-body-content').hide();
			$('.member-modal-title').html('CREATE MEMBER');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/member/create_member',
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
		$(document).on('change','.select_company',function()
		{
			var company_id = $(this).val();
			
			document.getElementById("availment_plan_id").disabled = false;
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type:'POST',
				url:'/get/company_coverage_plan',
				data:{company_id:company_id},
				dataType:'text',
				success:function(data)
				{
					$('.coverage-plan-show').html(data);
				}
			});
			
		});
		$(document).on('change','.coverage-plan-show',function()
		{
			var company_id = $('.select_company').val();
			
			document.getElementById("jobsite_id").disabled = false;
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				type:'POST',
				url:'/get/company_jobsite',
				data:{company_id:company_id},
				dataType:'text',
				success:function(data)
				{
					$('.jobsite-show').html(data);
				}
			});
			
		});
	}
	function create_member_confirm()
	{
		$(document).on('click','.create-member-confirm',function()
		{
			
			if(checking_null_validation(document.getElementById('member_first_name').value,"FIRST NAME")=="")
			{}
		    else if(checking_null_validation(document.getElementById('member_middle_name').value,"MIDDLE NAME")=="")
			{}
			else if(checking_null_validation(document.getElementById('member_last_name').value,"LAST NAME")=="")
			{}
			else if(document.getElementById('member_gender').value=="SELECT GENDER")
			{
				toastr.error('Please select GENDER.', 'Something went wrong!', {timeOut: 3000})
			}
		    else if(document.getElementById('member_marital_status').value=="SELECT STATUS")
			{
				toastr.error('Please select STATUS.', 'Something went wrong!', {timeOut: 3000})
			}
		    else if(checking_null_validation(document.getElementById('member_monther_maiden_name').value,"MOTHER MAIDEN NAME")=="")
			{}
			else if(checking_null_validation(document.getElementById('member_birthdate').value,"BIRTHDATE")=="")
			{}
			else if(checking_null_validation(document.getElementById('member_contact_number').value,"CONTACT NUMBER")=="")
			{}
			else if(checking_null_validation(document.getElementById('member_email_address').value,"EMAIL ADDRESS")=="")
			{}
			else if(checking_null_validation(document.getElementById('member_permanet_address').value,"PERMANENT ADDRESS")=="")
			{}
		    else if(checking_null_validation(document.getElementById('member_present_address').value,"PRESENT ADDRESS")=="")
			{}
			else if(checking_null_validation(document.getElementById('member_company_employee_number').value,"EMPLOYEE NUMBER")=="")
			{}
			else if(document.getElementById('company_id').value=="SELECT COMPANY")
			{
				toastr.error('Please select COMPANY.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(document.getElementById('availment_plan_id').value=="COVERAGE PLAN")
			{
				toastr.error('Please select PLAN.', 'Something went wrong!', {timeOut: 3000})
			}
			else if(document.getElementById('jobsite_id').value=="DEPLOYMENT")
			{
				toastr.error('Please select DEPLOYMENT.', 'Something went wrong!', {timeOut: 3000})
			}
		
			else
			{
				$('.confirm-modal').remove();
				$('.append-modal').append(modals);
	            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
				$('.confirm-modal-title').html('Are you sure you want to add this MEMBER?');
				$('.confirm-submit').addClass('create-member-submit'); 
				$('.confirm-modal').modal('show');
				
				ajaxData = $(".member-company-form,.member-dependent-form,.member-information-form,.member-government-form").serialize(); 
	   		}
		});

	}
    function create_member_submit()
    { 	
    	$(document).on('click','.create-member-submit',function() 
	    {
	    	$('.confirm-modal').modal('hide');
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
						$('.modal-dialog').removeClass('modal-lg');
						$('.modal-dialog').addClass('modal-sm');
					    $(".member-modal-body").html(data);
					    $(".member-modal-footer").html("<button type='button' class='btn btn-default pull-left medical-btn-close' style='text-align:center' data-dismiss='modal'>Close</button>");
					}, 1000);
		           
		        }
	        });
	     });

    }
	function view_member_details()
	{
		$(document).on('click','.view-member-details',function()
		{
			$('.member-modal').modal('show');
			$('.member-modal-dialog').removeClass('modal-sm modal-md').addClass('modal-dialog modal-lg');
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
	function view_member_transaction_details()
	{
		$(document).on('click','.transaction-details',function()
		{
			var member_id = $(this).data('transaction_member_id');
			$('.member-action-modal').modal('show');
			$('.member-action-modal-dialog').removeClass('modal-lg modal-sm').addClass('modal-md');
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
	function view_member_approval_details()
	{
		$(document).on('click','.view-member-approval-details',function()
		{
			$('.member-action2-modal').modal('show');
			$('.member-action2-ajax-loader').show();
			$('.member-action2-modal-body-content').hide();
			$('.member-action2-modal-title').html('APPROVAL DETAILS');
			$(".member-action2-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-import' data-dismiss='modal'>Close</button><button type='button' class='btn btn-primary pull-right' >Save Changes</button>");
			var approval_id = $(this).data('approval_id');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:'/medical/approval_details/'+approval_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.member-action2-ajax-loader').hide();
						$('.member-action2-modal-body-content').show();
						$('.member-action2-modal-body-content').html(data);
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
	function export_template()
	{

		$(document).on('change','.import-number-select',function()
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
		$(document).on('change','.import-member-company-select',function()
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
		$(document).on('click','.import-member',function() 
		{
			$('.member-modal').modal('show');
			$('.member-ajax-loader').show();
			$('.member-modal-body-content').hide();
			$('.modal-dialog').removeClass().addClass('modal-dialog modal-import');
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
    function import_member_confirm()
	{
		$(document).on('click','.import-member-confirm',function() 
		{
			$('.confirm-modal').remove();
			$('.append-modal').append(modals);
            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
			$('.confirm-modal-title').html('Are you sure you want to import this file?');
			$('.confirm-modal').modal('show');
			$('.confirm-submit').addClass('import-member-submit');
			ajaxData = $(".member-submit-form,.approval-submit-form,.procedure-availed-submit-form,.procedure-doctor-submit-form").serialize();
		});
	}
	
	function import_member_submit()
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

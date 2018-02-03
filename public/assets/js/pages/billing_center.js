var billing_center 	= new billing_center();
var formData   		= new FormData();

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
            trigger();
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
	function trigger()
	{
		$(document).on('click','.btn-close-billing',function()
		{
			$('.billing-modal').modal('hide');
			$(".billing-modal-body").html("<p style='text-align:center'>RELOAD THE PAGE</p>");
			
		});
	} 
	
	function create_cal()
	{
		
        $(document).on('click','.create-cal',function() 
		{
			$('.billing-modal').modal('show');
			$('.modal-dialog').removeClass().addClass('modal-dialog modal-lg');
			$('.billing-ajax-loader').show();
			$('.billing-modal-body-content').hide();
			$('.billing-modal-title').html('CREATE PLAN');
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
						$('.billing-ajax-loader').hide();
						$('.billing-modal-body-content').show();
						$('.billing-modal-body-content').html(data);
                    }, 1000);
				}
			});

		});
    }
    function create_cal_confirm()
	{
		$(document).on('click','.create-cal-confirm',function() 
		{
			$('.confirm-modal').remove();
			$('.append-modal').append(modals);
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
            
        });
	}
	
	function create_cal_submit()
	{
		$(document).on('click','.create-cal-submit',function() 
		{

			$('.confirm-modal').modal('hide');
            $(".billing-modal-body").html("<div class='billing-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
            $('.billing-ajax-loader').show();
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
						$('.modal-dialog').removeClass().addClass('modal-dialog modal-sm');
					    $(".billing-modal-body").html(data);
					    $(".billing-modal-footer").html("<button type='button' class='btn btn-default pull-left btn-close-billing' style='text-align:center' data-dismiss='modal'>Close</button>");
					}, 1000);
				}
			});
		});
	}
	function cal_view_details()
	{
		$(document).on('click','.cal-view-details',function() 
		{
			$('.billing-modal').modal('show');
			$('.modal-dialog').removeClass().addClass('modal-dialog modal-lg');
			$('.billing-ajax-loader').show();
			$('.billing-modal-body-content').hide();
			$('.billing-modal-title').html('CAL DETAILS');
			var cal_id = $(this).data('cal_id');
			var company_id = $(this).data('company_id');
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/billing/member/view/'+cal_id+'/'+company_id,
				method: "get",
                success: function(data)
				{
					setTimeout(function()
					{
						$('.billing-ajax-loader').hide();
						$('.billing-modal-body-content').show();
						$('.billing-modal-body-content').html(data);
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
		$(document).on('click','.import-cal-members',function() 
		{
			$('.billing-action-modal').modal('show');
			$('.modal-dialog').removeClass().addClass('modal-dialog modal-import');
			$('.billing-action-ajax-loader').show();
			$('.billing-action-modal-body-content').hide();
			$('.billing-action-modal-title').html('IMPORT CAL MEMBERS');
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
						$('.billing-action-ajax-loader').hide();
						$('.billing-action-modal-body-content').show();
						$('.billing-action-modal-body-content').html(data);
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
			$('.append-modal').append(modals);
            $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
			$('.confirm-modal-title').html('Are you sure you want to import this FILE?');
			$('.confirm-submit').addClass('import-cal-member-submit');
			$('.confirm-modal').modal('show');

			
			formData.append("company_id", 			$(this).data('cal_company_id'));
			formData.append("cal_id", 				$(this).data('cal_cal_id'));
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
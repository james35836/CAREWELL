var reports_payment	= new reports_payment();


function reports_payment()
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
			member_payment_report();
			member_payment_report_filter();
			//try
			search_member_cal();

		});

	}
	function member_payment_report()
	{

		$("body").on('click','.member-report',function()
		{
			var ref		     = $(this).data('ref');
			var member_id 		= $(this).data('member_id');
			var modalName       = $(this).data('title');
			var modalClass      = 'reports-plan';
			var modalLink       = '/reports/payment_report/'+member_id;
			var modalActionName = 'none';
			var modalAction     = 'monthly-excel-report';
			var modalSize       = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
    	}

     function member_payment_report_filter()
	{
		$('body').on('change','#yearFilter',function()
		{
			var ref				= $(this).data('ref');
			var table = 						$('#showPaymentReport');
			searchData.append("val_key", 		$(this).val());
			searchData.append("member_id", 		$(this).data('member_id'));

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/reports/member_cal/date_filter/'+ref,
				method: "POST",
		        	data: searchData,
		        	contentType:false,
	            	cache:false,
	            	processData:false,
				success: function(data)
				{
					table.html(data);
				}
			});
		});
	}

	//try
	function search_member_cal()
	{
		$('#search_member_cal').keyup(function()
		{
			var data = new FormData();

			data.append('search_member_cal', $(this).val());

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/reports/member_cal/get_report',
				method: "POST",
		        	data: data,
		        	contentType:false,
	            	cache:false,
	            	processData:false,

				success: function(data)
				{
					table.html(data);
				}
			});
		});


	}
	//try

	function download_cal_template()
	{
		$('body').find('.monthly-excel-report').attr('href','/reports/member_cal/month_detail/excel_report');
		$(document).on('change','.download-cal-select',function()
		{
			var company_id = $(this).val();
			$('.download-link').attr('href', '/member/download_template/'+company_id);
		});
	}
}

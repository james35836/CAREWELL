var settings_reports	= new settings_reports();


function settings_reports()
{
	this.calculateSum = function(SumClass)
	 {
	    var sum = 0;
	  // iterate through each td based on class and add the values
	  $("."+SumClass).each(function() {
	      var value = $(this).text();
	      // add only if the value is number
	      if(!isNaN(value) && value.length != 0) {
	          sum += parseFloat(value);
	      }
	     });
	   $("#"+SumClass).html(sum);
	}

	init();

	function init()
	{
		ready_document();

	}

	function ready_document()
	{
		$(document).ready(function()
		{
			member_report();
			searching();
			//try
			search_member_cal();

		});

	}
	function member_report()
	{

		// $("body").on('click','.member-report',function()
		// {
		// 	var ref				= $(this).data('ref');
		// 	var member_id 		= $(this).data('member_id');
		// 	var modalName       = $(this).data('title');
		// 	var modalClass      = 'reports-plan';
		// 	var modalLink       = '/reports/member_cal/'+ref+'/'+member_id;
		// 	var modalActionName = 'EXPORT TO EXCEL';
		// 	var modalAction     = 'monthly-excel-report';
		// 	var modalSize       = 'modal-lg';
		// 	globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
  //       });
    }

    function searching()
	{
		$('body').on('change','#datepicker-filtering',function()
		{
			//alert(document.getElementById('datepicker').val());
			var date = $(this).val();
			var ref	 = $(this).data('ref');

			var table = 					$(this).closest('div.tab-pane').find('#showTable');
			searchData.append("date", 		$(this).val());
			searchData.append("ref", 		$(this).data('ref'));

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/page/date_filter',
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
		// $('#search_member_cal').keyup(function()
		// {
		// 	var data = new FormData();

		// 	data.append('search_member_cal', $(this).val());

		// 	$.ajax({
		// 		headers: {
		// 		      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		// 		},
		// 		url:'/reports/member_cal/get_report',
		// 		method: "POST",
		//         data: data,
		//         contentType:false,
	 //            cache:false,
	 //            processData:false,

		// 		success: function(data)
		// 		{
		// 			table.html(data);
		// 		}
		// 	});
		// });


	}
	//try

	function download_cal_template()
	{
		// $('body').find('.monthly-excel-report').attr('href','/reports/member_cal/month_detail/excel_report');
		// $(document).on('change','.download-cal-select',function()
		// {
		// 	var company_id = $(this).val();
		// 	$('.download-link').attr('href', '/member/download_template/'+company_id);
		// });
	}
}

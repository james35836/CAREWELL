var settings_reports	= new settings_reports();

function settings_reports()
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
			member_monthly_report();

		});

	}
	function member_monthly_report()
	{

		$("body").on('click','.member-monthly-report',function()
		{
			var member_id 		= $(this).data('member_id');
			var modalName       = 'MONTHLY REPORT';
			var modalClass      = 'reports-plan';
			var modalLink       = '/reports/member_cal/month_detail/'+member_id;
			var modalActionName = 'CREATE PLAN';
			var modalAction     = 'create-reports-plan-confirm';
			var modalSize       = '';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
    }
}

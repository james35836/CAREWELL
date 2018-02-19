var dashboardv2 	= new dashboardv2();


function dashboardv2()
{
	
	init();

	function init()
	{
		$(document).ready(function()
		{
			document_ready();
		});

	}

	function document_ready()
	{
		dashboard_modals();
        latest_approval();

        	
		

	}
	

	function latest_approval()
	{
		$("body").on('click','.latest-approval',function()
		{
			var approval_id = $(this).data('approval_id');
			var modalName= 'APPROVAL DETAILS';
			var modalClass='approval';
			var modalLink='/availment/approval_details/'+approval_id;
			var modalActionName='SAVE CHANGES';
			var modalAction='confirm';
			var modalSize = 'modal-lg';
			globals.global_modals(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize);
        });
	}
	
	function dashboard_modals()
	{
		
        $(document).on('click','.latest-approvala',function() 
		{
			

			$("body").append('<div class="modal fade modal-top global-modal" role="dialog"><div class="modal-dialog modal-lg"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title global-modal-title"></h4></div><div class="modal-body global-modal-body"><div class="global-ajax-loader" style="display:none;text-align: center; padding:50px;"><img src="/assets/loader/loading.gif"/></div><div class="row box-holder global-modal-body-content"></div></div><div class="modal-footer global-modal-footer modals-mo"><button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button><button type="button" class="btn btn-primary create-global-confirm">Create Company</button></div></div></div></div>');
			$('.global-modal').addClass('dashboard');
			$('.modal-dialog').removeClass().addClass('modal-dialog modal-lg');
			$('.dashboard').modal('show');
		});
		$(document).on('click','.modals-mo',function() 
		{
			$("body").append('<div class="modal fade myModals" id="myModal" role="dialog"><div class="modal-dialog"><!-- Modal content--><div class="modal-content"><div class="modal-header modals-natin"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title">Modal Header</h4></div><div class="modal-body"><p class="modals-mo">Some text in the modal.</p></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div>');
			$('.myModals > .modal-dialog').removeClass().addClass('modal-dialog modal-md');
			$('.myModals').modal('show');
		});
		$(document).on('click','.modals-natin',function() 
		{
			$("body").append('<div class="modal fade myModals" id="myModal" role="dialog"><div class="modal-dialog"><!-- Modal content--><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal">&times;</button><h4 class="modal-title modals-natin">Modal Header</h4></div><div class="modal-body"><p class="modals-mo">Some text in the modal.</p></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></div></div></div></div>');
			$('.modal-dialog').removeClass().addClass('modal-dialog modal-sm');
			$('.myModals').modal('show');
		});
    }
    
}
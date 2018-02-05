var globals = new globals();

var globalModals = '<div class="modal fade modal-top global-modal">'+
		          '<div class="modal-dialog global-modal-dialog">'+
		            '<div class="modal-content global-modal-content">'+
		              '<div class="modal-header global-modal-header">'+
		                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">'+
		                  '<span aria-hidden="true">&times;</span></button>'+
		                '<h4 class="modal-title global-modal-title">Default Modal</h4>'+
		              '</div>'+
		              '<div class="modal-body global-modal-body">'+
		                '<div class="global-ajax-loader" style="display:none;text-align: center; padding:50px;">'+
		                '<img src="/assets/loader/loading.gif"/>'+
		                '</div>'+
		                '<div class="row box-holder global-modal-body-content">'+
		                '</div>'+
		              '</div>'+
		              '<div class="modal-footer global-modal-footer">'+
		                '<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>'+
		                '<button type="button" class="btn btn-primary global-footer-button">Save changes</button>'+
		              '</div>'+
		            '</div>'+
		          '</div>'+
		        '</div>';

function globals()
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
			pop_modals();
			loader();
			open_tabs();
			logout_modals();
			global_submit();
		});
    }
	function logout_modals()
	{
		$(document).on('click','.close-md',function() 
		{
			
            $('#modal-default-md').modal('hide');
            
		});
	}
	function open_tabs()
	{
		$(document).ready(function(){
		    $(".nav-tabs a").click(function(){
		        $(this).tab('show');
		    });
		});
	}
	
	function loader(size)
	{
		if(size=='sm')
		{
			$(".modal-body-sm").html("<div class='ajax-loader-sm' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div>");
		}
		else if(size=='md')
		{
			$(".modal-body-md").html("<div class='ajax-loader-md' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div>");
		}
		else if(size=='lg')
		{
			$(".modal-body-lg").html("<div class='ajax-loader-lg' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div>");
		}
	}
	
	function pop_modals()
	{
		$(document).on('click','.pop-up-sm',function() 
		{
            var modalName 	= 	$(this).data('modalname');
            var link 		= 	$(this).data('link');
					            $('#modal-default-sm').modal();
					            $('.sm-title').html(modalName);
					            loader('sm');
						        $('.ajax-loader-sm').show();
			$.ajax({
					type:'get',
					url:link,
					dataType:'text',
					success: function(data)
							{
								setTimeout(function()
								{
								    $(".modal-body-sm").html(data);
			    					$('.ajax-loader-sm').css('display','none');
								}, 1000);
							}
					});
		});
		$(document).on('click','.pop-up-md',function() 
		{
            var modalName 	= 	$(this).data('modalname');
            var link 		= 	$(this).data('link');
					            $('#modal-default-md').modal('show');
					            $('.md-title').html(modalName);
					            loader('md');
					            $('.ajax-loader-md').show();
            $.ajax({
					type:'get',
					url:link,
					dataType:'text',
					success: function(data)
							{
								setTimeout(function()
								{
								    $(".modal-body-md").html(data);
								    $('.ajax-loader-md').css('display','none');
								}, 1000);
							}
					});
			
		});
		$(document).on('click','.pop-up-lg',function() 
		{
            var modalName 	= 	$(this).data('modalname');
            var link 		= 	$(this).data('link');
            var clickable 	= 	$(this).data('clickable');
            					$('#modal-default-lg').modal('show');
            					$('.confirm-modal-lg').addClass(clickable);
						        loader('lg');
						        $('.lg-title').html(modalName);
						        $('.ajax-loader-lg').show();
						            
			$.ajax({
					type:'get',
					url:link,
					dataType:'text',
					success: function(data)
							{
								setTimeout(function()
								{
								    $(".modal-body-lg").html(data);
			    					$('.ajax-loader-lg').css('display','none');
								}, 1000);
							}
					});
		});
		$(document).on('click','.pop-up-import-member',function() 
		{
			var modalName 	= 	$(this).data('modalname');
            var link 		= 	$(this).data('link');
					            $('.import-member-modal').modal('show');
					            $('.confirm-modal-import').addClass('import-member');
					            $('.import-title').html(modalName);
					            $(".menu-content").hide();
					            $('.ajax-loader-import').show();
								setTimeout(function()
								{
								    $(".menu-content").show();
									$('.ajax-loader-import').hide();
								}, 1000);
							
					
		});
	}
	function global_submit()
	{

	}
	
}

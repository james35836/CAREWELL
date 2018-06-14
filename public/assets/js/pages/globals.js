var globals 		= new globals();
var formData   		= new FormData();
var doctorData		= new FormData();
var doctorFileData  = new FormData();
var adjustmentData	= new FormData();
var memberFileData	= new FormData();
var companyData     = new FormData();
var providerData 	= new FormData();


var providerFileData= new FormData();
var calData 		= new FormData();
var calCloseData	= new FormData();
var calFileData 	= new FormData();


var payableData 	= new FormData();

var userProfileData = new FormData();
var passwordData 	= new FormData();
var userData 		= new FormData();

var archivedData 	= new FormData();
var restoreData 	= new FormData();

var filterData 		= new FormData();
var searchData 		= new FormData();


var coverageData    = new FormData();
var memberData 		= new FormData();

var billingMemberData 	= new FormData();
var calPendingData    	= new FormData();
var approvalprocedureData = new FormData();

var removeApprovalData = new FormData();

var coverageItemData	= [];
var doctorProviderData	= [];
var specialData 		= [];
var availmentData 		= [];
var procedureData		= []; 
var chargesData			= [];


var thisElement         = [];
var finalDiagnosisData	= [];

var payeeData			= [];
var serializeData 	= [];
var newSerializedApprovalData = [];
var ajaxData 		= [];
var value			= "0";
var message			= "";
var approvalData	= [];

var check_null 		= [];

var benefitsData	= [];
var contractData	= [];
var contactData 	= [];
var coveragePlanData= [];
var deploymentData	= [];
var data            = "";
var link            = "";

var successButton	= '<button type="button" class="btn btn-default pull-right reload-btn" data-dismiss="modal">RELOAD</button><button type="button" class="btn btn-default pull-left" data-dismiss="modal">CLOSE</button>';

var confirmModals 			= '<div  class="modal fade modal-top confirm-modal" id="" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">'
						  +'<div class="confirm-modal-dialog modal-dialog modal-sm">'
						    +'<div class="modal-content confirm-modal-content">'
						      +'<div class="modal-header">'
						        +'<button type="button" class="close" data-dismiss="modal" aria-label="Close">'
						        +'<span aria-hidden="true">&times;</span></button>'
						        +'<h4 class="modal-title confirm-modal-title"></h4>'
						      +'</div>'
						      
						      +'<div class="modal-body modal-body-sm confirm-modal-body">'
						        +'<input type="hidden" class="link"/>'
						      +'</div>'
						      +'<div class="modal-footer confirm-modal-footer">'
						        +'<button type="button" class="close-btn btn btn-default pull-left" data-dismiss="modal">Cancel</button>'
						        +'<button type="button" class="btn btn-primary confirm-submit">Yes</button>'
						      +'</div>'
						    +'</div>'
						  +'</div>'
						+'</div>';

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
		                '<button type="button" class=" close-btn btn btn-default pull-left" data-dismiss="modal">Close</button>'+
		                '<button type="button" class="btn btn-primary global-footer-button">Save changes</button>'+
		              '</div>'+
		            '</div>'+
		          '</div>'+
		        '</div>';
var dataOptionModals = '<div class="row">'+
							'<div class="row form-holder ">'+
								'<div class="col-md-12 form-content">'+
									'<input type="number" id="new-option-name" class="form-control new-option-name">'+
								'</div>'+
							'</div>'+
						'</div>';

function globals()
{
	this.global_modals = function(modalName,modalClass,modalLink,modalActionName,modalAction,modalSize)
	{
  
		$('.'+modalClass+'-modal').remove();
        $(".append-modal").append(globalModals);
		$('.global-modal').removeClass().addClass('modal fade modal-top '+modalClass+'-modal');
		$('.global-modal-dialog').removeClass().addClass(''+modalClass+'-modal-dialog modal-dialog '+modalSize);
		$('.global-modal-content').removeClass().addClass('modal-content');
		$('.global-modal-header').removeClass().addClass('modal-header');
		$('.global-modal-title').html(modalName);
		$('.global-modal-title').removeClass().addClass('modal-title');
		$('.global-modal-body').removeClass().addClass('modal-body '+modalClass+'-modal-body');
		$('.'+modalClass+'-modal').modal('show');
		$('.global-ajax-loader').show();
    	$('.global-modal-body-content').hide();
    	$('.global-modal-footer').hide();
          
        	$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},

				url:modalLink,
				method: "get",
	            success: function(data)
	            {
					setTimeout(function()
					{  
						$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader '+modalClass+'-ajax-loader');
						$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(data);
						if(modalSize=="modal-import")
						{
							$('.global-modal-footer').show().html(successButton);
                    	}
						else
						{
						    $footer = $('.global-modal-footer').show().removeClass().addClass('modal-footer '+modalClass+'-modal-footer');
							if(modalActionName=="none")
							{
								$footer.html('<button type="button" class="close-btn btn btn-default pull-left" data-dismiss="modal">CLOSE</button>').show();
							}
							else
							{
								$footer.find('.global-footer-button').html(modalActionName).removeClass().addClass('btn btn-primary confirm-btn '+modalAction+'');	
							    if(modalActionName=="SAVE CHANGES")
								{
									// $('button.'+modalAction).attr('disabled','true');
								}
							}
                    	}

                    	if(modalActionName=="SAVE CHANGES")
                    	{
                    		$('.'+modalClass+'-modal').find('button').attr('disabled','true');
                    		$('.'+modalClass+'-modal').find('button.top-element').removeAttr('disabled');
                    		$('.'+modalClass+'-modal').find('button.close').removeAttr('disabled');
                    		$('.'+modalClass+'-modal').find('button.close-btn').removeAttr('disabled');
                    	}
					}, 700);
				}
			});
    }

	this.confirm_modals = function(confirmModalMessage,confirmModalAction)
	{
		$('.confirm-modal').remove();
		$('.append-modal').append(confirmModals);
        $('.confirm-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
		$('.confirm-modal-title').html(confirmModalMessage);
		$('.confirm-submit').addClass(confirmModalAction);
		$('.confirm-modal').modal('show');
	}
	
	this.checking_null_validation = function(value,message)
	{
		if(value=="0")
		{
			return "null";
		}
		else if(value=="")
		{
			toastr.error(message+' cannot be null.', 'Something went wrong!', {timeOut: 3000})
			return "";
		}
	}
	this.global_tostr  = function (message)
	{
		toastr.error('Please add/select '+message+' at least one.', 'Something went wrong!', {timeOut: 3000})
	}
	this.get_information = function(link,value,showId,val)
	{
		$.ajax({
			headers: {
			      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},

			url:link,
			data:{value: value},
			method: "POST",
            	success: function(data)
			{
				if(val=='val')
				{
					$(showId).val(data);
				}
				else
				{
					$(showId).html(data);
				}
			}
		});
	}
	this.global_ajax_call_submit = function(submitLink,submitData,moduleName,functionReference)
	{
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
				moduleName.show_data_here(data,functionReference);
			}
		});
	}
	
	this.get_dual_information = function(link,value,showId,showId2)
	{
		$.ajax({
			headers: {
			      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},

			url:link,
			data:{value: value},
			method: "POST",

            success: function(data)
			{
				$(showId).html(data.first);
				$(showId2).html(data.second);
			}
		});
	}
	
	this.global_submit = function(modalName,submitLink,submitData)
	{
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
					$('.'+modalName+'-modal-body').html(data);
					$('.'+modalName+'-modal-footer').html(successButton);
				}, 1000);
			}
		});
	}
	this.global_serialize_submit = function(modalName,submitLink,submitData)
	{
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
        	dataType:"text",
        	success: function(data)
			{
				setTimeout(function()
				{
					$('.'+modalName+'-ajax-loader').hide();
					$('.'+modalName+'-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
					$('.'+modalName+'-modal-body').html(data);
					$('.'+modalName+'-modal-footer').html(successButton);
				}, 1000);
			}
		});
     }
	this.global_single_submit = function (modalLink,modalData,tdCloser)
	{
		$(".confirm-modal-body").html("<div class='confirm-ajax-loader' style='display:none;text-align: center; padding:50px;'><img src='/assets/loader/loading.gif'/></div");
    	$(".confirm-ajax-loader").show();
    	$('.confirm-modal-title').html("MESSAGE");
    	$(".confirm-modal-footer").html('');

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:modalLink,
				method: "POST",
		        data: modalData,
		        contentType:false,
	            cache:false,
	            processData:false,
				success: function(data)
                	{
					setTimeout(function()
					{
						
						tdCloser.remove();
						
						$(".confirm-modal-body").html(data);
						$(".confirm-modal-footer").html(successButton);
                        
					}, 800);
				}
			});
	}
	this.global_submit_serialized = function(modalName,submitLink,submitData)
	{
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
            	dataType:"text",
            	success: function(data)
			{
				setTimeout(function()
				{
					$('.'+modalName+'-ajax-loader').hide();
					$('.'+modalName+'-modal-dialog').removeClass().addClass('modal-sm modal-dialog')
					$('.'+modalName+'-modal-body').html(data);
					$('.'+modalName+'-modal-footer').html(successButton);
				}, 1000);
			}
		});
	}
	this.global_archived_data = function(archived_param,string_param)
	{
		$(".confirm-modal-body").html('<h1 style="text-align:center;"><i class="fa fa-spinner fa-pulse fa-fw"></i></h1>');
        	$(".confirm-ajax-loader").show();
        	$('.confirm-modal-title').html("Message");
        	$.ajax({
			headers: {
			      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:'/archived/submit',
			method: "POST",
        	data: archived_param,
        	contentType:false,
        	cache:false,
        	processData:false,
			success: function(data)
            	{
				setTimeout(function()
				{
					$(".confirm-ajax-loader").remove();
					string_param.remove();
					
					$(".confirm-modal-body").html(data);
					$(".confirm-modal-footer").html(successButton);
                    
				}, 800);
			}
		});
	}
	this.global_restore_data = function(restore_param,string_param)
	{
		$(".confirm-modal-body").html('<h1 style="text-align:center;"><i class="fa fa-spinner fa-pulse fa-fw"></i></h1>');
        	$(".confirm-ajax-loader").show();
        	$('.confirm-modal-title').html("Message");
        	$.ajax({
			headers: {
			      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			url:'/restore/submit',
			method: "POST",
	        	data: restore_param,
	        	contentType:false,
            	cache:false,
            	processData:false,
			success: function(data)
            	{
				setTimeout(function()
				{
					$(".confirm-ajax-loader").remove();
					string_param.remove();
					
					$(".confirm-modal-body").html(data);
					$(".confirm-modal-footer").html(successButton);
                    
				}, 800);
			}
		});
	}
	this.option_modal  = function(modalClass,modalAction,modalRef)
	{
		$('.'+modalClass).remove();
        $(".append-modal").append(globalModals);
		$('.global-modal').removeClass().addClass('modal fade modal-top '+modalClass);
		$('.global-modal-dialog').removeClass().addClass('modal-dialog modal-sm');
		$('.global-modal-content').removeClass().addClass('modal-content');
		$('.global-modal-header').removeClass().addClass('modal-header');
		$('.global-modal-title').html('NEW OPTION');
		$('.global-modal-title').removeClass().addClass('modal-title second');
		$('.global-modal-body').removeClass().addClass('modal-body');
		$('.'+modalClass).modal('show');
		$('.global-ajax-loader').show();
    	$('.global-modal-body-content').hide();
    	$('.global-modal-footer').hide();
    	setTimeout(function()
		{

			$('.global-ajax-loader').hide().removeClass().addClass('.modal-loader');
			if(modalRef=='string')
			{
				$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(dataOptionModals).find('.new-option-name').attr('type','text');
			}
			else
			{
				$('.global-modal-body-content').show().removeClass().addClass('row box-holder  modal-body-content').html(dataOptionModals);
			}
			$('.global-modal-footer').show().removeClass().addClass('modal-footer');
        		$('.global-footer-button').html('ADD OPTION').removeClass().addClass('btn btn-primary '+modalAction);
        	}, 1000);
	}
	this.global_input_email = function(inputs)
	{
		var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
		var is_email=re.test(inputs.val());
		if(is_email)
		{
			// inputs.removeClass("invalid").addClass("valid");
			return "success";
		}
		else
		{
			// inputs.removeClass("valid").addClass("invalid");
			return "error";
		}
	}
	this.toLocation = function(url) 
     {
        	var a = document.createElement('a');
        	a.href = url;
        	return a;
     };

	this.checkArrayValue = function(value,arr)
	{
	   	var status = 'Not exist';
	 
	   	for(var i=0; i<arr.length; i++)
	   	{
		   	var name = arr[i];
		   	if(name == value)
		   	{
			    	status = 'Exist';
			    	break;
		   	}
		}
	 	return status;
 	}
 	this.checkArrayValues = function(array_name)
 	{
 		var array = [];
 		var check = "";
 		array_name.each(function(i, pro)
          {
            	var selected = $(pro).val();
            	if(selected!="0")
            	{
            		check = globals.checkArrayValue(selected,array);
            		if(check=="Exist")
	       		{
	       			return false;
	       		}
	       		else
	       		{
	       			array.push(selected);
	       		}
            	}
          });
          return check;
 	}
 	
			
			
	
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
		check_all_checkbox();
		add_select_option();
		reload_page();

		archived_data();
    	restore_data();

    	add_remove_element();

    	table_sorter();
    	table_action_add_remove();
   

    	filtering();
    	searching();

    	event_run_paginate();
    	enable_element();

        	
    }
	function enable_element()
	{
    	$('body').on('click','button.enable-element',function()
    	{
    		$(this).closest('div.modal-body').find('input,select,textarea').removeAttr('readonly');
    		$(this).closest('div.modal-body').find('select').removeAttr('disabled');
    		$(this).closest('div.modal-body').find('button').removeAttr('disabled');
    		$(this).closest('div.modal').find('button.confirm-btn').removeAttr('disabled');


    		$(this).closest('div.modal').find('input.total_gross_amount').attr('readonly',true);
    		$(this).closest('div.modal').find('input.total_philhealth').attr('readonly',true);
    		$(this).closest('div.modal').find('input.total_charge_patient').attr('readonly',true);
    		$(this).closest('div.modal').find('input.total_charge_carewell').attr('readonly',true);
    	



    	});
	}
    function event_run_paginate()
	{
    	$('body').on('click', '.pagination a', function(e) 
    	{
        	e.preventDefault();
        	var href= $(this).data('href');
        	var url = paginate_ajax.toLocation(href);
        	var domain = url.protocol + "//" + url.hostname;
        
        	var load_data = $(this).closest('.load-data');
        
        	load_data.find('tr').css('opacity', '0.2');
        
        	if (window.location.href.indexOf("https") != -1)
        	{
            	var url = $(this).attr('href').replace("http", "https");
        	}
        	else
        	{
            	var url = $(this).attr('href');
        	}

        	load_data.each(function() 
        	{
            	$.each(this.attributes, function() 
            	{
                	if(this.specified && this.name != "class" && this.name != "style") 
                	{
                    	url = href.replace(domain,'');
                	}
            	});
        	});
        	getArticles(url, load_data);
    	});
	}

    	function getArticles(url, load_data) 
    	{
        	target = load_data.data("target");
        	console.log(target);
        	load_data.load(url+" div."+target, function()
        	{
            	if (typeof loading_done == 'function')
            	{
                
            	}
        	})
    	}
    	function filtering()
	{
		$('body').on('change','.filtering',function()
		{

			var table = 						$(this).closest('div.tab-pane').find('#showTable');
			filterData.append("val_id", 		$(this).val());
			filterData.append("val_name", 		$(this).data('name'));
			filterData.append("val_archived", 	$(this).data('archived'));

			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/page/filtering',
				method: "POST",
		        	data: filterData,
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
	function searching()
	{
		$('body').on('click','.searching',function()
		{
			var table = 						$(this).closest('div.tab-pane').find('#showTable');
			searchData.append("val_key", 		$(this).closest('div').find('input.search-key').val());
			searchData.append("val_name", 		$(this).data('name'));
			searchData.append("val_archived", 	$(this).data('archived'));
			$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/page/searching',
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
	
	function archived_data()
	{
		$('body').on('click','.archived',function()
		{
			var	confirmModalMessage = 'Are you sure you want to archived '+$(this).data('name')+'?';
			var confirmModalAction = 'archived-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);

			archivedData.append("archived_id", 		$(this).data('id'));
			archivedData.append("archived_name", 	$(this).data('name'));
			ajaxData.tdCloser  	= $(this).closest('tr');
			ajaxData.name 		= $(this).data('name');
		});
		$('body').on('click','.archived-submit',function() 
		{
			$(".confirm-modal-body").html('<h1 style="text-align:center;"><i class="fa fa-spinner fa-pulse fa-fw"></i></h1>');
	          $(".confirm-ajax-loader").show();
	        	$('.confirm-modal-title').html("MESSAGE");
	        	$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/archived/submit',
				method: "POST",
		        	data: archivedData,
		        	contentType:false,
	            	cache:false,
	            	processData:false,
				success: function(data)
	            	{
					setTimeout(function()
					{
						$(".confirm-ajax-loader").remove();
						ajaxData.tdCloser.remove();
						$(".confirm-modal-body").html('<center><b><span class="color-red"> '+ ajaxData.name +' ARCHIVED '+data+'!</span></b></center>');
						$(".confirm-modal-footer").html(successButton);
	                    
					}, 800);
				}
			});
		});
	}
	function restore_data()
	{
		$('body').on('click','.restore',function()
		{
			var	confirmModalMessage = 'Are you sure you want to proceed to restore?';
			var confirmModalAction = 'restore-submit';
			globals.confirm_modals(confirmModalMessage,confirmModalAction);

			restoreData.append("restore_id", 	$(this).data('id'));;
			restoreData.append("restore_name", 	$(this).data('name'));
			ajaxData.tdCloser  	= $(this).closest('tr');
			ajaxData.name 		= $(this).data('name');
		});
		$('body').on('click','.restore-submit',function() 
		{
			$(".confirm-modal-body").html('<h1 style="text-align:center;"><i class="fa fa-spinner fa-pulse fa-fw"></i></h1>');
	        	$(".confirm-ajax-loader").show();
	        	$('.confirm-modal-title').html("MESSAGE");
	        	$.ajax({
				headers: {
				      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				url:'/restore/submit',
				method: "POST",
		        	data: restoreData,
		       	contentType:false,
	            	cache:false,
	            	processData:false,
				success: function(data)
	            	{
					setTimeout(function()
					{
						$(".confirm-ajax-loader").remove();
						ajaxData.tdCloser.remove();
						
						$(".confirm-modal-body").html('<center><b><span class="color-red"> '+ ajaxData.name +' RESTORE '+data+'!</span></b></center>');
						$(".confirm-modal-footer").html(successButton);
	                    
					}, 800);
				}
			});
		});
	}
	
	function reload_page()
	{
    	$('body').on('click','.reload-btn',function()
    	{
    		location.reload();
    	});
	}
	function check_all_checkbox()
	{
		$('body').on('click','.checkAllCheckbox',function (e) 
		{
		    $(this).closest('table').find('td input:checkbox').prop('checked', this.checked);
		});
		$('body').on('click','input.parent',function (e) 
		{
		    $(this).closest('div.parent').find('div.child input:checkbox').prop('checked', this.checked);
		});
		$('body').on('click','input.child',function (e) 
		{
		    $(this).closest('div.parent').find('input.parent').prop('checked', this.checked);
		});


	}
	function add_select_option()
	{
		$('body').on("click",".add-new-option",function()
		{
			ajaxData.newOption = $(this).closest('td').find('select');
			globals.option_modal('add-option1','add-option-submit');
		});
		$('body').on('click','.add-option',function () 
		{
			ajaxData.newOption = $(this).closest('div').find('select');
			var modalRef       = $(this).data('ref');
			globals.option_modal('add-option1','add-option-submit',modalRef);
		});
		$('body').on('click','.add-option-submit',function () 
		{
			var newopt 	= $('.new-option-name').val();
            	var newData = ajaxData.newOption;
            	$('.add-option1').remove();
            	if (newopt == '') 
            	{
                	toastr.error('Add option first before submit.', 'Something went wrong!', {timeOut: 3000})
                	return;
            	}
            	else
            	{
            		newData.append('<option selected="selected">'+newopt+'</option>');
        			$('.add-option-modal').remove();
        		}
        	});
	}
	
	function table_sorter()
	{
		$('body').on('click','th.live-search',function()
		{
			var table = $(this).parents('table').eq(0)
		    	var rows = table.find('tr:gt(0)').toArray().sort(comparer($(this).index()))
		    	this.asc = !this.asc
		    	if (!this.asc){rows = rows.reverse()}
		    	for (var i = 0; i < rows.length; i++){table.append(rows[i])}
		});
		function comparer(index) 
		{
		    return function(a, b) 
		    {
		        var valA = getCellValue(a, index), valB = getCellValue(b, index)
		        return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
		    }
		}
		function getCellValue(row, index)
		{ 
			return $(row).children('td').eq(index).text() 
		}
	}
	function table_action_add_remove()
	{
		$('body').on("click",".add-row", function()
		{
			var j      = $(this).data('number');
			var nj     = j+1;
			var $table = $(this).closest('table');
			var number = $table.find('tr:last').find('button.remove-row').data('number');
			if($(this).data('ref')=='first')
			{
				$nrow  = $table.find('tr:eq(1)').clone().appendTo($table);
				$nrow.find('#approval_doctor_id').val(0);
				$nrow.find('#procedure_approval_id').val(0);
				$nrow.find('#doctor_approval_payee_id').val(0);
				$nrow.find('#payee_approval_payee_id').val(0);
			}
			else
			{
				$nrow  = $table.find('tr:eq(2)').clone().appendTo($table);
			}
			
			$nrow.find('button.remove-row').attr('data-number', number+1);
			$nrow.find('.countThis').val('0 ITEMS');
		});
		$('body').on("click",".remove-row", function()
		{
			var $table  = $(this).closest('table');
			var count   = $table.find('tr.table-row').length;
			var $tr 	= $(this).closest('tr');
			var number  = $(this).data('number');
			if(count==1)
			{
				toastr.error('You cannot remove all rows.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				$(this).closest("tr").remove();
			}
		});
	}
	
	function add_remove_element()
	{
		$('body').on("click",".add-element", function()
		{
			var $div  = $(this).closest('div.form-element');
			var $this = $(this);
			$nelement = $div.find('div.my-element:first').removeClass('my-select').clone().appendTo($div);
			
		});
		$('body').on("click",".remove-element", function()
		{
			var $div = $(this).closest('div.form-element');
			var count  = $div.find('div.my-element').length;
			if(count==1)
			{
				toastr.error('You cannot remove all element.', 'Something went wrong!', {timeOut: 3000})
			}
			else
			{
				$(this).closest("div.my-element").remove();
			}
		});
	}
	
	
}

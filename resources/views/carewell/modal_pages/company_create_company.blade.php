<script>
//iCheck for checkbox and radio inputs
$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
checkboxClass: 'icheckbox_minimal-blue',
radioClass   : 'iradio_minimal-blue'
})
//append
$(document).ready(function() {
	
	$('body').on("click",".add-contact", function()
	{
		$('.contact-form-element:first').clone().appendTo('.contact-number-form');
	});
	$('body').on("click",".remove-contact", function()
	{
		if($('.contact-form-element').length==1)
		{
			toastr.error('You cannot remove all rows.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest(".contact-form-element").remove();
		}
	});
	$('body').on("click",".add-deployment", function()
	{
		$('.deployment-form-element:first').clone().appendTo('.deployment-number-form');
	});
	$('body').on("click",".remove-deployment", function()
	{
		if($('.deployment-form-element').length==1)
		{
			toastr.error('You cannot remove all rows.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest(".deployment-form-element").remove();
		}
	});
	$('body').on("click",".add-coverage", function()
	{
		$('.coverage-plan-element:first').clone().appendTo('.coverage-plan-form');
	});
	$('body').on("click",".remove-coverage", function()
	{
		if($('.coverage-plan-element').length==1)
		{
			toastr.error('You cannot remove all rows.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest(".coverage-plan-element").remove();
		}
	});
	$('body').on("click",".add-Benifit", function()
	{
		$('.Benifit-element:first').clone().appendTo('.Benifit-form');
	});
	$('body').on("click",".remove-Benifit", function()
	{
		if($('.Benifit-element').length==1)
		{
			toastr.error('You cannot remove all rows.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest(".Benifit-element").remove();
		}
	});
	$('body').on("click",".add-contract", function()
	{
		$('.contract-element:first').clone().appendTo('.contract-form');
	});
	$('body').on("click",".remove-contract", function()
	{
		if($('.contract-element').length==1)
		{
			toastr.error('You cannot remove all rows.', 'Something went wrong!', {timeOut: 3000})
		}
		else
		{
			$(this).closest(".contract-element").remove();
		}
	});

	
});
</script>
<div class="row box-globals">
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Company Name</label>
		</div>
		<div class="col-md-10 form-content">
			<input type="text" id="company_name"  class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Email Address</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="company_email_address" class="form-control"/>
		</div>
		<div class="col-md-2 form-content">
			<label>Contact Person</label>
		</div>
		<div class="col-md-4 form-content">
			<input type="text" id="company_contact_person" class="form-control"/>
		</div>
	</div>
	<div class="form-holder">
		<div class="col-md-2 form-content">
			<label>Company Address</label>
		</div>
		<div class="col-md-10 form-content">
			<textarea class="form-control" rows="5" cols="10"></textarea>
		</div>
		
	</div>
	<div class="form-holder ">
		<div class="col-md-2 form-content">
			<label>Contact Number</label>
		</div>
		<div class="col-md-10 contact-number-form">
			<div class=" form-content contact-form-element">
				<div class="input-group">
					<input type="text" id="contract_number" class="contract_number form-control"/>
					<span class="input-group-btn">
						<button class="btn btn-primary add-contact" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
						<button class="btn btn-danger remove-contact" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
					</span>
				</div>
			</div>
			
		</div>
	</div>
	
	
</div>
<div class="row box-globals" >
	<!-- Custom Tabs -->
	<div class="nav-tabs-custom">
		<ul class="nav nav-tabs">
			<li class="active my-tab"><a data-toggle="tab" href="#contract">CONTRACT DETAILS</a></li>
			<li class="my-tab"><a data-toggle="tab" href="#deployment">DEPLOYMENT</a></li>
		</ul>
		<div class="tab-content" >
			<div id="contract" class="row tab-pane fade in active table-min-height" >
				<div class="form-holder">
					<div class="col-md-3 form-content">
						<label>Contract Number</label>
					</div>
					<div class="col-md-3 form-content">
						<input type="text" id="contract_number" class="form-control" disabled/>
					</div>
					<div class="col-md-3 form-content">
						<label>Mode of Payment</label>
					</div>
					<div class="col-md-3 form-content">
						<select id="contract_mode_of_payment" class="form-control">
							<option disabled>MODE OF PAYMENT</option>
							@foreach($_payment_mode as $payment_mode)
							<option value="{{$payment_mode->payment_mode_id}}">{{$payment_mode->payment_mode_name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-holder ">
					<div class="col-md-2 form-content">
						<label>Contract Image</label>
					</div>
					<div class="col-md-10 contract-form">
						<div class=" form-content contract-element">
							<div class="input-group">
								<input type="file" name="contract_image" id="contract_image" class="form-control convoFile"/>
								<span class="input-group-btn">
									<button class="btn btn-primary add-contract" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
									<button class="btn btn-danger remove-contract" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-holder ">
					<div class="col-md-2 form-content">
						<label>Schedule of Benifit</label>
					</div>
					<div class="col-md-10 Benifit-form">
						<div class=" form-content Benifit-element">
							<div class="input-group">
								<input type="file" id="contract_schedule_of_benifits_image" class="form-control"/>
								<span class="input-group-btn">
									<button class="btn btn-primary add-Benifit" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
									<button class="btn btn-danger remove-Benifit" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="form-holder ">
					<div class="col-md-2 form-content">
						<label>Coverage Plan</label>
					</div>
					<div class="col-md-10 coverage-plan-form">
						<div class=" form-content coverage-plan-element">
							
							<div class="input-group">
								<select class="form-control" name="coverage_plan" id="coverage_plan">
									<option>SELECT COVERAGE</option>
									@foreach($_coverage_plan as $coverage_plan)
									<option value="{{$coverage_plan->coverage_plan_id}}">{{$coverage_plan->coverage_name}}</option>
									@endforeach
								</select>
								<span class="input-group-btn">
									<button class="btn btn-primary add-coverage" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
									<button class="btn btn-danger remove-coverage" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="deployment" class="row tab-pane fade table-min-height" >
				<div class="form-holder ">
					<div class="col-md-2 form-content">
						<label>DEPLOYMENT</label>
					</div>
					<div class="col-md-10 deployment-number-form">
						<div class=" form-content deployment-form-element">
							<div class="input-group">
								<input type="text" id="contract_number" class="contract_number form-control"/>
								<span class="input-group-btn">
									<button class="btn btn-primary add-deployment" type="button" tabindex="-1"><span class="fa fa-plus-circle" aria-hidden="true"></span> </button>
									<button class="btn btn-danger remove-deployment" type="button" tabindex="-1"><span class="fa fa-minus-circle" aria-hidden="true"></span> </button>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
</div>